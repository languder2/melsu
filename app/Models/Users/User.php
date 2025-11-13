<?php

namespace App\Models\Users;

use App\Enums\UserRoles;
use App\Models\Division\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed $lastname
 * @property mixed $firstname
 * @property mixed $middlename
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'role',
        'lastname',
        'firstname',
        'middlename',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'role'              => UserRoles::class
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
        });
    }


    public function isAdmin(): bool
    {
        return $this->role->level() >= UserRoles::Admin->level();
    }
    public function isSuperAdmin(): bool
    {
        return $this->role->level() >= UserRoles::Super->level();
    }
    public function isEditor(): bool
    {
        return $this->role->level() >= UserRoles::Editor->level();
    }

    public function validateRules(): array
    {
        return [
//            'test'              => 'required',
            'id'                => "nullable",
            'role'              => '',
            'email'             => "email|required|unique:users,email,{$this->id},id,deleted_at,NULL",
            'lastname'          => 'required',
            'firstname'         => 'required',
            'middlename'        => '',
            'new_password'      => 'nullable|same:retry_password',
            'retry_password'    => '',
        ];

    }
    public function validateMessages():array
    {
        return [
            'name.required'         => 'Заполните обязательные поля',
            'email.unique'          => 'Email должен быть уникальным',
            'name.unique'           => 'Login должен быть уникальным',
            'some'                  => "Пароль и повторение не совпадают",
        ];
    }
    public function getFullNameAttribute(): string
    {
        return "{$this->lastname} {$this->firstname} {$this->middlename}";
    }
    public function getContactNameAttribute(): string
    {
        return "{$this->firstname} {$this->middlename}";
    }

    public function divisions(): MorphToMany
    {
        return $this->morphedByMany(
            Division::class,
            'relation',
            'user_access',
            'user_id',
            'relation_id'
        );
    }

    protected static function roleOrders(): Builder
    {
        return self::orderByRaw("FIELD(role, 'super', 'admin', 'editor', 'user')");
    }

    protected static function cabinetList(): string
    {
        return route('users.cabinet.list');
    }
    protected static function cabinetSetFilter(): string
    {
        return route('users.cabinet.set-filter');
    }
    protected function getSaveAttribute(): string
    {
        return route('users.cabinet.save', $this);
    }
    protected function getFormAttribute(): string
    {
        return route('users.cabinet.form', $this);
    }
    protected function getDeleteAttribute(): string
    {
        return route('users.cabinet.delete', $this);
    }

    protected function getFioAttribute(): string
    {
        return trim($this->firstname . ' ' . $this->middlename . ' ' . $this->lastname);
    }



}
