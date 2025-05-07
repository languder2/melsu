<?php

namespace App\Models\Division;

use App\Enums\ContactType;
use App\Enums\DivisionType;
use App\Enums\EducationLevel;
use App\Models\Education\Speciality;
use App\Models\Gallery\Image;
use App\Models\Global\Options;
use App\Models\Menu\Menu;
use App\Models\News\RelationNews;
use App\Models\Page\Content as PageContent;
use App\Models\Sections\Contact;
use App\Models\Staff\Affiliation as StaffAffiliation;
use App\Models\Staff\Staff;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property ?DivisionType $type
 */
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
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($division) {
            $division->sections()->delete();
            $division->staffs()->delete();
            $division->images()->delete();
            $division->ico()->delete();
            $division->preview()->delete();
        });
    }

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
    public function resolveRouteBinding($value, $field = null): ?Division
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
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

    public function faculties(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id')
            ->where('type', DivisionType::Faculty)
            ->where('show',true)
            ->orderBy('sort')
            ->orderBy('name')
        ;
    }
    public function departments(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id')
            ->where('type', DivisionType::Department)
            ->where('show',true)
            ->orderBy('sort')
            ->orderBy('name')
        ;
    }
    public function labs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id')
            ->where('type', DivisionType::Lab)
            ->where('show',true)
            ->orderBy('sort')
            ->orderBy('name')
            ;
    }
    public function specialities($all = null): HasMany
    {

        $hasMany = $this->hasMany(Speciality::class, $this->type->getField(),'id');

        if(!$all)
            $hasMany->where('show',true);

        return $hasMany->orderBy('sort')->orderByRaw(EducationLevel::getOrder())
            ->orderBy('spec_code')->orderBy('name');
    }

    public function getFacultyLabsAttribute(): Collection
    {
        $result = collect([]);

        foreach ($this->departments as $department)
            if($department->labs->isNotEmpty())
                $result= $result->merge($department->labs);

        return $result;
    }
    public function getInstituteDepartmentsAttribute(): Collection
    {
        $result = collect([]);

        foreach ($this->faculties as $faculty){
            if($faculty->departments->isNotEmpty())
                $result= $result->merge($faculty->departments);
        }
        return $result;
    }

    public function getInstituteLabsAttribute(): Collection
    {

        $result = collect([]);
        foreach ($this->faculties as $faculty)
            foreach ($faculty->departments as $department)
                if($department->labs->isNotEmpty())
                    $result= $result->merge($department->labs);
        return $result;
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

    public function news(): MorphMany
    {
        return $this->morphMany(RelationNews::class, 'relation')
            ->orderBy('published_at');
    }
    public function publicNews(): MorphMany
    {
        return $this->news()
            ->where('published_at','<=', Carbon::now())
            ->where('is_show',1)
            ->orderBy('is_favorite', 'desc')
            ->orderBy('sort', 'asc')
            ->orderBy('published_at', 'desc')
            ;

    }
    public function NewsLink(?string $op): string
    {
        return match($this->type){
            default => null,
            DivisionType::Institute, DivisionType::Faculty, DivisionType::Department, DivisionType::Branch
            => route('public:education:division', [$this->type->value,$this->code ?? $this->id,'news',$op]),
        };
    }


    public function getTeachingStaffAttribute(): Collection
    {
        $result = collect([]);

        if($this->type === DivisionType::Faculty)
            foreach ($this->departments as $department)
                foreach ($department->staffs as $staff){

                    if(!$result->has($staff->staff_id))
                        $result->put($staff->staff_id,(object)[
                            'full_name' => $staff->card->full_name,
                            'link'      => $staff->card->link,
                            'avatar'    => $staff->avatar,
                            'posts'     => collect([$staff->post]) ,
                        ]);

                    elseif($result[$staff->staff_id]->posts->doesntContain($staff->post))
                        $result[$staff->staff_id]->posts->push($staff->post);
                }
        else
            foreach ($this->staffs as $staff){
                if(!$result->has($staff->card->full_name))
                    $result->put($staff->card->full_name,(object)[
                        'full_name' => $staff->card->full_name,
                        'link'      => $staff->card->link,
                        'avatar'    => $staff->card->avatar,
                        'posts'     => collect([$staff->post]) ,
                    ]);

                elseif($result[$staff->card->full_name]->posts->doesntContain($staff->post))
                    $result[$staff->card->full_name]->posts->push($staff->post);
            }


        return $result->sortBy('full_name');
    }

    public function sections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation')->orderBy('order');
    }

    public function publicSections(): MorphMany
    {
        return $this->morphMany(PageContent::class, 'relation')
            ->where('show',true)->orderBy('order');
    }
    public function getPublicSectionsCountAttribute(): int
    {
        return $this->publicSections()->count();
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

    public function telegrams(): MorphMany
    {
        return $this->morphMany(Contact::class, 'relation')
            ->where('type',ContactType::Telegram)
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
    public function ico(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'ico');
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
        $code = $this->alias ?? $this->code ?? $this->id;

        return match($this->type){
            default                     => route('public:division:show',        $code),
            DivisionType::Faculty, DivisionType::Department, DivisionType::Lab, DivisionType::Branch, DivisionType::Institute
                => route('public:education:division',   [$this->type, $code]),
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

    public function getMenuAttribute(): ?object
    {

        $result = $this->type->getDivisionMenu($this);

        return $result ?? match($this->type){
            default => null,
            DivisionType::Institute     => Menu::GetMenuInstitute($this),
            DivisionType::Faculty       => Menu::GetMenuFaculty($this),
            DivisionType::Department    => Menu::GetMenuDepartment($this),
            DivisionType::Branch        => Menu::GetMenuBranch($this),
        };
    }


}

