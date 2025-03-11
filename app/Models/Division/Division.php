<?php

namespace App\Models\Division;

use App\Enums\DivisionType;
use App\Models\Contact;
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

class Division extends Model
{
    use SoftDeletes;

    protected $table = 'divisions';

    protected $fillable = [
        'id',
        'acronym',
        'name',
        'type',
        'parent_id',
        'coordinator_id',
        'description',
        'code',
        'sort',
        'show',
    ];

    protected $visible = [
        'id',
        'acronym',
        'name',
        'code',
        'parent_id',
        'coordinator_id',
        'show'
    ];
    protected $casts = [
        'type'  => DivisionType::class,
    ];

    public static function FormRules($id): array
    {
        return [
//            'test'              => "required",
            'acronym'           => "",
            'name'              => "required",
            'code'              => "nullable|unique:divisions,code,{$id},id,deleted_at,NULL",
            'type'              => "",
            'sort'             => '',
            'parent_id'         => '',
            'sections'          => '',
            'chief'             => '',
            'documents'         => '',
            'description'       => '',
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

    public function getSortAttribute($sort): int|null
    {
        return ($sort > 0 && $sort < 1000) ? $sort :  null ;
    }

    public function setSortAttribute($sort): void
    {
        $this->attributes['sort'] = $sort ?? 1000;
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

    public function contacts(?string $type = null): MorphMany
    {
        $query = $this->morphMany(Contact::class, 'relation');

        if($type)
            $query->where('type', $type);

        return $query->orderBy('type')->orderBy('sort');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'relation');
    }

    public function preview(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'preview');
    }

    public function getPreviewAttribute()
    {
        return $this->preview()->first() ?? new Image([
            'type'  => 'preview',
            'name'  => $this->name,
        ]);
    }

    public function getLinkAttribute(): string
    {
        return route('public:division:show', [
            'code' => $this->alias ?? $this->id,
        ]);
    }

    public static function search(&$division,$search): void
    {

        $list = self::where('name', 'LIKE', "%$search%")->get();

        $ids = collect([]);

        foreach ($list as $item) {
            $ids->put($item->id,true);
            self::getParents($ids, $item);
        }

        if($division->chief->card->divisions->count())
            self::searchVerifiedID($division->chief->card,$ids);


        foreach ($division->staffs as $staff)
            if($staff->card->divisions->count())
                self::searchVerifiedID($staff->card,$ids);

    }

    private static function getParents(&$ids,$item): void
    {
        if($item->parent_id){
            if(!$ids->has($item->parent_id))
                $ids->put($item->parent_id,false);

            self::getParents($ids, $item->parent);
        }
    }

    private static function searchVerifiedID(&$current,$ids): void
    {
        if($current->subs)
            $current->subs = $current->subs()
                ->whereIn('id',$ids->keys()->toArray())
                ->get();
        else
            $current->divisions = $current->divisions()
                ->whereIn('id',$ids->keys()->toArray())
                ->get();


        $list = $current->divisions ?? $current->subs ?? null;

        foreach ($list as $sub)
            self::searchVerifiedID($sub, $ids);
    }

    protected function getIdentityAttribute(): ?string
    {
        if(!$this->relation_type)
            return null;

        return match($this->relation_type){
            'App\Models\Education\Faculty'     => "faculty:{$this->relation_id}",
            'App\Models\Education\division'  => "division:{$this->relation_id}",
            'App\Models\Education\Lab'         => "lab:{$this->relation_id}",
            default                             => "{$this->relation_type}:{$this->relation_id}",
        };

    }

}

