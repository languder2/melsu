<?php

namespace App\Models\Department;

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
        'parent_id',
        'coordinator_id',
        'show'
    ];

    public static function FormRules($id): array
    {
        return [
//            'test'              => "required",
            'name'              => "required",
            'code'              => "nullable|unique:departments,code,{$id},id,deleted_at,NULL",
            'order'             => '',
            'parent_id'         => '',
            'sections'          => '',
            'chief'             => '',
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
            $response->where('type','staff');

        $response->where('show',1);

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
                'name'      => 'preview',
            ])->save();

        return $image;
    }




}
