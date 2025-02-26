<?php

namespace App\Models\Department;

use App\Models\Department\Section as DepartmentSection;
use App\Models\Department\Staff as DepartmentStaff;
use App\Models\Gallery\Image;
use App\Models\Staff\Staff;
use App\Models\Staff\Affiliation as StaffAffiliation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Page\Content as PageContent;
use App\Models\Global\Options;
class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';

    protected $fillable = [
        'id',
        'name',
        'group_id',
        'parent_id',
        'coordinator_id',
        'code',
        'order',
        'show',
    ];

    protected $visible = [
        'id',
        'name',
        'code',
        'group_id',
        'parent_id',
        'coordinator_id',
        'show'
    ];

    public static function FormRules($id): array
    {
        return [
            'name'              => "required|unique:departments,name,{$id},id,deleted_at,NULL",
            'code'              => "nullable|unique:departments,code,{$id},id,deleted_at,NULL",
            'order'             => '',
            'group_id'          => '',
            'parent_id'         => '',
            'coordinator_id'    => '',
            'sections'          => '',
            'chief'             => '',
            'chief_post'        => '',
            'chief_post_alt'    => '',
            'documents'         => '',
            'image'             => '',
            'preview'           => '',
            'show'              => '',
            'staffs'            => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name.required' => 'Укажите название',
            'name.unique' => 'Название уже занято',
        ];
    }

    public function getOrderAttribute($order): int|null
    {
        return ($order < 10000) ? $order :  null ;
    }

    public function setOrderAttribute($order): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }


    public function options(): MorphMany
    {
        return $this->morphMany(Options::class, 'relation');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id','id');
    }

    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'Coordinator_id','id');
    }

    public function chief(): MorphOne
    {
        return $this->MorphOne(StaffAffiliation::class, 'relation')->where('type','chief');
    }

    public function staffs($all= false): MorphMany
    {

        $response = $this->morphMany(StaffAffiliation::class, 'relation')->orderBy('order');

        if(!$all)
            $response = $response->where('type','staff');

        return $response;
    }

    public function sections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation');
    }

    public function getLinkAttribute(): string
    {
        return route('public:department:show', [
            'code' => $this->alias ?? $this->id,
        ]);
    }

    public function preview(): MorphOne
    {
        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'preview');

        if(!$image->count())
            $image->create([
                'type'      => 'preview',
                'name'      => $this->name,
            ])->save();

        return $image;
    }



}
