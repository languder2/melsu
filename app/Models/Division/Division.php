<?php

namespace App\Models\Division;

use App\Enums\ContactType;
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
        'alt_name',
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
            'alt_name'          => "",
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

    public function contacts(): MorphMany
    {
        $query = $this->morphMany(Contact::class, 'relation');
        return $query->orderBy('type')->orderBy('sort');
    }

    public function phones(): MorphMany
    {
        return $this->morphMany(Contact::class, 'relation')
            ->where('type',ContactType::Phone)
            ->orderBy('sort');
    }
    public function emails(): MorphMany
    {
        return $this->morphMany(Contact::class, 'relation')
            ->where('type',ContactType::Email)
            ->orderBy('sort');
    }
    public function addresses(): MorphMany
    {
        return $this->morphMany(Contact::class, 'relation')
            ->where('type',ContactType::Address)
            ->orderBy('sort');
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
        $code = $this->alias ?? $this->id;

        return match($this->type){
            default                     => route('public:division:show',        $code),
            DivisionType::Faculty       => route('public:education:faculty',    $code),
            DivisionType::Department    => route('public:education:department', $code),
            DivisionType::Lab           => route('public:education:lab',        $code),
            DivisionType::Branch        => route('public:education:branch',     $code),
        };
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


}

