<?php

namespace App\Models\Projects;

use App\Models\Gallery\Image;
use App\Models\Services\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Cluster extends Model
{

    use SoftDeletes;

    protected $table = 'project_clusters';

    protected $fillable = [
        'name',
        'code',
        'description',
        'is_show',
        'sort',
    ];

    protected $cast = [

    ];

    protected $dates = ['deleted_at'];

    public function FormRules():array
    {
        return [
            'id'            => '',
            'name'          => "required",
            'code'          => "nullable|unique:project_clusters,code,{$this->id},id,deleted_at,NULL",
            'sort'          => '',
        ];
    }
    public function FormMessage():array
    {
        return [
            'name.required' => 'Укажите название категории',
            'code.unique'   => "Кластер с таким alias'ом уже существует",
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($self) {
            $self->getImage()->delete();
            $self->getContents()->delete();
            $self->projects()->delete();
        });
    }

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['sort'] = $attributes['sort'] ?? 1000;
            $attributes['code'] = $attributes['code'] ?
                transliterate(str_replace(' ','-', $attributes['code'])) : null;
        }

        return parent::fill($attributes);
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
    }

    public function getIdAttribute($value):int
    {
        return $value ?? now()->format('Uv');
    }
    public function getSortAttribute($value):?int
    {
        if($value)
            return $value;

        $sort   = self::latest()->first()->sort ?? 0;
        return $sort >= 1000 ? null : $sort+10;
    }
    public function getLinkAttribute(): string
    {
        return route('cluster.single', $this->code ?? $this->id);
    }
    public function getAdminAttribute(): string
    {
        return route('clusters.admin', $this->id);
    }
    public function getNewAttribute(): string
    {
        return route('clusters.form');
    }
    public function getEditAttribute(): string
    {
        return route('clusters.form', $this->id);
    }
    public function getDeleteAttribute(): string
    {
        return route('clusters.delete', $this->id);
    }
    public function getSaveAttribute(): string
    {
        return route('clusters.save', $this->exists ? $this->id : null);
    }
    public function getAddProjectAttribute(): string
    {
        return route('projects.form', [null, "cluster_id" => $this->id]);
    }

    public function getImage(?string $type = null): MorphOne
    {
        $result= $this->MorphOne(Image::class, 'relation');
        return $type ? $result->where('type', $type) : $result;
    }
//    public function getNameAttribute($value): ?string
//    {
//        return html_entity_decode($value);
//    }
    public function getPreviewAttribute(): Image
    {
        return $this->getImage('preview')->first()
            ?? (new Image(['type' => 'preview']))->relation()->associate($this);
    }
    public function getIcoAttribute(): Image
    {
        return $this->getImage('ico')->first()
            ?? (new Image(['type' => 'ico', 'name' => 'ico to the cluster'. __('common.arrowR') . $this->name ]))->relation()->associate($this);
    }
    public function getContents(?string $type = null): MorphOne
    {
        $result= $this->MorphOne(Content::class, 'relation');
        return $type ? $result->where('type', $type) : $result;
    }
    public function getContentsCount(): int
    {
        return $this->getContents()->whereNotNull('content')->count();
    }
    public function getContent($type): Content
    {
        return $this->getContents($type)->first()
            ?? (new Content(['type' => $type]))->relation()->associate($this);
    }
    public function getShortAttribute(): ?string
    {
        return $this->getContent('short')->content ?? null;
    }
    public function full(): Content
    {
        return $this->getContent('full');
    }
    public function getFullAttribute(): ?string
    {
        return $this->full()->content ?? null;
    }

    public function relevance(): Content
    {
        return $this->getContent('relevance');
    }
    public function getRelevanceAttribute(): ?string
    {
        return $this->relevance()->content ?? null;
    }

    public function goals(): Content
    {
        return $this->getContent('goals');
    }
    public function getGoalsAttribute(): ?string
    {
        return $this->goals()->content ?? null;
    }

    public function structure(): Content
    {
        return $this->getContent('structure');
    }
    public function getStructureAttribute(): ?string
    {
        return $this->structure()->content ?? null;
    }
    public function suggestions(): Content
    {
        return $this->getContent('suggestions');
    }
    public function getSuggestionsAttribute(): ?string
    {
        return $this->suggestions()->content ?? null;
    }
    public function availableResources(): Content
    {
        return $this->getContent('available_resources');
    }
    public function getAvailableResourcesAttribute(): ?string
    {
        return $this->availableResources()->content ?? null;
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'cluster_id');
    }

    public function adminProjects(): Collection
    {
        return $this->projects()->orderBy('name')->get();
    }

    public function publicProjects(): Collection
    {
        return $this->projects()->where('is_show',true)
            ->orderBy('sort')->orderBy('name')
            ->get();
    }

    public function getFormMenuAttribute(): Collection
    {
        return collect([
            [
                'tabs'      => 'form_box',
                'tab'       => 'tab_base',
                'text'      => 'Основа',
                'section'   => 'projects.clusters.admin.includes.form-base-section',
                'active'    => true
            ],
            [
                'tabs'      => 'form_box',
                'tab'       => 'tab_contents',
                'text'      => 'Секции контента',
//                'section'   => 'components.form.sections.contents',
                'section'   => 'projects.clusters.admin.includes.form-contents-section',
            ],
            [
                'tabs'      => 'form_box',
                'tab'       => 'tab_contacts',
                'text'      => 'Контакты',
                'section'   => 'components.form.sections.contacts',
                'disabled'  => !$this->exists
            ],
//            [
//                'tabs'      => 'form_box',
//                'tab'       => 'tab_staffs',
//                'text'      => 'Сотрудники',
////                'section'   => 'components.form.sections.staffs',
//                'section'   => '',
//                'disabled'  => !$this->exists
//            ],
            [
                'tabs'      => 'form_box',
                'tab'       => 'tab_documents',
                'text'      => 'Документы',
                'section'   => '',
                'disabled'  => !$this->exists
            ],
            [
                'tabs'      => 'form_box',
                'tab'       => 'tab_links',
                'text'      => 'Ссылки',
                'section'   => '',
                'disabled'  => !$this->exists
            ],
        ]);
    }

}
