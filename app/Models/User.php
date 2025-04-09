<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

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

    public function FormRules(): array
    {
        return [
//            'test'              => 'required',
            'id'                => "nullable|required_without:new_password",
            'name'              => "required|required|unique:users,name,{$this->id},id,deleted_at,NULL",
            'role'              => 'required',
            'email'             => "email|required|unique:users,email,{$this->id},id,deleted_at,NULL",
            'lastname'          => 'required',
            'firstname'         => 'required',
            'middlename'        => '',
            'new_password'      => 'nullable|same:retry_password',
            'retry_password'    => '',
        ];

    }

    public function FormMessage():array
    {
        return [
            'name.required'         => 'Заполните обязательные поля',
            'email.unique'          => 'Email должен быть уникальным',
            'name.unique'           => 'Login должен быть уникальным',
            'some'                  => "Пароль и повторение не совпадают",
            'id.required_without'   => "Для новых пользователей пароль обязателен к указанию",
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

}
