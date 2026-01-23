<?php

namespace App\Models\Division;

use App\Enums\DivisionType;
use App\Enums\EducationLevel;
use App\Models\Education\Speciality;
use App\Models\Gallery\Image;
use App\Models\Global\Options;
use App\Models\Menu\Menu;
use App\Models\Page\Content as PageContent;
use App\Models\Partners\Partner;
use App\Models\Services\Log;
use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;
use App\Models\Upbringing\Upbringing;
use App\Traits\Documents\hasDocuments;
use App\Traits\hasCareers;
use App\Traits\hasContacts;
use App\Traits\hasContents;
use App\Traits\hasDivisionMenu;
use App\Traits\hasEvents;
use App\Traits\hasGoals;
use App\Traits\hasGraduations;
use App\Traits\hasImage;
use App\Traits\hasLinks;
use App\Traits\hasMeta;
use App\Traits\hasNews;
use App\Traits\hasOptions;
use App\Traits\hasPartners;
use App\Traits\hasScience;
use App\Traits\hasSubordination;
use App\Traits\hasUsers;
use App\Traits\resolveRouteBinding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * @property ?DivisionType $type
 */
class Division extends Model
{
    use
        SoftDeletes, resolveRouteBinding, hasSubordination, hasContents,
        hasLinks, hasMeta,
        hasNews, hasEvents,
        hasPartners, hasGoals, hasCareers, hasScience, hasGraduations,
        hasUsers,
        hasDocuments,
        hasImage,
        hasContacts,
        hasDivisionMenu, hasOptions
    ;

    protected array $links = [
        'test'  => 'division.cabinet.form',
    ];

    protected array $linksGroups = [
        'cabinet_'  => 'divisions.cabinet.',
        'public_'   => 'divisions.public.',
    ];


    protected $table = 'divisions';

    protected $fillable = [
        'id',
        'uuid',
        'acronym',
        'name',
        'alt_name',
        'type',
        'parent_id',
        'coordinator_id',
        'description',
        'code',
        'sort',
        'is_show',
        'is_approved',
    ];

    protected $visible = [
        'id',
        'acronym',
        'name',
        'code',
        'parent_id',
        'coordinator_id',
        'is_show',
        'is_approved'
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

        static::saved(function ($division) {
            Log::add($division);
            $division->saveCacheCabinetItem();
        });
    }

    public function validateRules(): array
    {
        return [
            'acronym'           => "",
            'name'              => "required",
            'uuid'              => "",
            'alt_name'          => "",
            'code'              => "nullable|unique:divisions,code,{$this->id},id,deleted_at,NULL",
            'type'              => "",
            'sort'             => '',
            'parent_id'         => "different:$this->id",
            'sections'          => '',
            'chief'             => '',
            'description'       => '',
            'image'             => '',
            'preview'           => '',
            'is_show'           => '',
            'is_approved'       => '',
        ];
    }
    public function validateMessage(): array
    {
        return [
            'name.required'             => 'Укажите название',
            'name.unique'               => 'Название уже занято',
            'parent_id'                 => 'Родительское подразделение не может быть текущим',
        ];
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
            'description'       => '',
            'image'             => '',
            'preview'           => '',
            'show'              => '',
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

    public function faculties(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id')
            ->where('type', DivisionType::Faculty)
            ->where('is_show',true)
            ->orderBy('sort')
            ->orderBy('name')
            ;
    }
    public function departments(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id')
            ->where('type', DivisionType::Department)
            ->where('is_show',true)
            ->orderBy('sort')
            ->orderBy('name')
            ;
    }
    public function labs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id')
            ->where('type', DivisionType::Lab)
            ->where('is_show',true)
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
    public function publicSpecialities(): HasMany
    {
        return $this->hasMany(Speciality::class, $this->type->getField(),'id')
            ->orderBy('sort')->orderByRaw(EducationLevel::getOrder())
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

    public function getChief(): MorphOne
    {
        return $this->MorphOne(Affiliation::class, 'relation')->where('type','chief');
    }

    public function getChiefAttribute(): Affiliation
    {
        $staff = (new Affiliation())->fill(['type'=>'chief'])->relation()->associate($this);

        return $this->getChief ?? $staff;
    }

    public function staffs($all= false): MorphMany
    {

        $response = $this->morphMany(Affiliation::class, 'relation')->orderBy('order');

        if(!$all)
            $response->where('type','staff');

        $response->where('show',1);


        return $response;
    }
    public function staffsAll(): MorphMany
    {
        return $this->morphMany(Affiliation::class, 'relation')
            ->orderBy('order')
            ->where('show',1)
            ;
    }

    public function allStaff(): MorphMany
    {
        return $this->morphMany(Affiliation::class, 'relation')
            ->where('type','staff')
            ->orderBy('order')
            ->orderBy('full_name')

            ;
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
            ->where('show',true)
            ->orderBy('order');
    }
    public function getPublicSectionsCountAttribute(): int
    {
        return $this->publicSections()->count();
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

    public function getIDCollection(&$list = []): ?array
    {
        $list[] = $this->id;

        if($this->subs->count())
            foreach ($this->subs as $sub)
                $sub->getIDCollection($list);

        return $list;
    }

    public function upbringingSections()
    {
        return $this->morphMany(Upbringing::class, 'relation');
    }
    public function partnerSections()
    {
        return $this->morphMany(Partner::class, 'relation');
    }

    /* Links */
    public function getAddSpecialityAttribute():?string
    {
        $route = route('speciality:admin:form');

        return match($this->type){
            default => null,
            DivisionType::Faculty       => "{$route}?faculty={$this->id}",
            DivisionType::Department    => "{$route}?faculty={$this->parent->id}&department={$this->id}",
        };
    }

    public function getAdminAttribute():?string
    {
        return match ($this->type) {
            DivisionType::Branch        => route('branches:admin'),
            DivisionType::Institute     => route('admin:institutes:list'),
            DivisionType::Faculty       => route('admin:faculty:list'),
            DivisionType::Department    => route('admin:department:list'),
            DivisionType::Lab           => route('admin:lab:list'),
            default                     => route('admin:division:list'),
        };
    }
    public function getEditAttribute():?string
    {
        return route('division:admin:form',$this);
    }
    public function getDeleteAttribute():?string
    {
        return route('divisions.delete',$this);
    }
    public function getToggleShowAttribute():?string
    {
        return route('division:toggle-show',$this);
    }

    public function getCabinetListAttribute(): string
    {
        return route('divisions.cabinet.list');
    }

    public function getCabinetFormAttribute(): string
    {
        return route('division.cabinet.form', $this);
    }

    public function getCabinetSaveAttribute(): string
    {
        return route('division.cabinet.save', $this);
    }

    /* end Links*/


    /* collections */

    public static function getBranches():Collection
    {
        return self::where('type',DivisionType::Branch)->get();
    }

    public static function getInstitutes():Collection
    {
        return self::where('type',DivisionType::Institute)->get();
    }
    public static function getFaculties():Collection
    {
        return self::where('type',DivisionType::Faculty)->get();
    }
    public static function getDepartments():Collection
    {
        return self::where('type',DivisionType::Department)->get();
    }

    /* end  collections */
    /* Staff Links*/
    public function getStaffsAdminListAttribute():?string
    {
        return route('division:admin:staffs:list',$this);
    }
    public function getStaffAddAttribute():?string
    {
        return route('division:admin:staffs:form',[$this, 'staff']);
    }
    /* end Staff Links*/

    public static function educationDepartments(): Collection
    {
        return self::where('type',DivisionType::Department)->get();
    }

    public function getHistoryFormAttribute(): string
    {
        return route('division.history.form', $this);
    }
    public function getHistorySaveAttribute(): string
    {
        return route('division.history.save', $this);
    }

    public function getAchievementsFormAttribute(): string
    {
        return route('division.achievements.form', $this);
    }
    public function getAchievementsSaveAttribute(): string
    {
        return route('division.achievements.save', $this);
    }

    public function getGalleryFormAttribute(): string
    {
        return route('division.gallery.form', $this);
    }
    public function getGallerySaveAttribute(): string
    {
        return route('division.gallery.save', $this);
    }

    public function getDeanOfficeLinkAttribute(): ?string
    {
        return route('division.education.dean-office',[
            $this->type->value,
            $this->id
        ]);
    }

    public function getTeachingStaffLinkAttribute(): ?string
    {
        return route('division.education.teaching-staff',[
            $this->type->value,
            $this->id
        ]);
    }
    public function getDepartmentsLinkAttribute(): ?string
    {
        return route('division.education.departments',[
            $this->type->value,
            $this->id
        ]);
    }

    public function getSpecialitiesLinkAttribute(): ?string
    {
        return route('division.education.specialities',[
            $this->type->value,
            $this->id
        ]);
    }
    public function getPartnersLinkAttribute(): ?string
    {
        return route('division.education.partners',[
            $this->type->value,
            $this->id
        ]);
    }
    public function getSciencesLinkAttribute(): ?string
    {
        return route('division.education.sciences',[
            $this->type->value,
            $this->id
        ]);
    }

    public static function cabinetAddForm(): string
    {
        return route('division.cabinet.form');
    }

    public function saveCacheCabinetItem(): void
    {
        Cache::forever(
            "division-cabinet-item-$this->id",
            view('divisions.cabinet.item', ['division' => $this])->render()
        );
        Cache::forever(
            "admin.division-cabinet-item-$this->id",
            view('divisions.cabinet.item', ['division' => $this, 'isAdmin' => true])->render()
        );
    }
    public function getCacheCabinetItem(): ?string
    {
        return auth()->user()->isAdmin()
            ? Cache::get("admin.division-cabinet-item-$this->id")
            : Cache::get("division-cabinet-item-$this->id");
    }
    public function hasCacheCabinetItem(): bool
    {
        return auth()->user()->isAdmin()
            ? Cache::has("admin.division-cabinet-item-$this->id")
            : Cache::has("division-cabinet-item-$this->id");
    }


}

