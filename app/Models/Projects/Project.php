<?php

namespace App\Models\Projects;

use App\Enums\Projects\ProjectType;
use App\Models\Gallery\Image;
use App\Models\Services\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Project extends Model
{

    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'code',
        'type',
        'cluster_id',
        'is_show',
        'sort',
    ];

    protected $cast = [
        'type'      => ProjectType::class,
    ];

    protected $dates = ['deleted_at'];

    public function FormRules():array
    {
        return [
            'id'            => '',
            'name'          => "required",
            'type'          => "required",
            'cluster_id'    => "",
            'code'          => "nullable|unique:projects,code,{$this->id},id,deleted_at,NULL",
            'sort'          => '',
        ];
    }
    public function FormMessage():array
    {
        return [
            'name.required' => 'Укажите название категории',
            'code.unique'   => "Проект с таким alias'ом уже существует",
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($self) {
            $self->getImage()->delete();
            $self->getContents()->delete();
        });
    }

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
//            $attributes['is_show'] = (int)isset($attributes['is_show']);
            $attributes['sort'] = $attributes['sort'] ?? 1000;
            $attributes['code'] = $attributes['code'] ?
                transliterate(str_replace(' ','-', $attributes['code'])) : null;
        }

        return parent::fill($attributes);
    }

    public function getTypesAttribute(): Collection
    {
        return ProjectType::pluck();
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('code', $value)->first() ??  $this->where('id', $value)->first();
    }

    public function getIdAttribute($value):int
    {
        return $value ?? microtime(true);
    }
    public function getSortAttribute($value):?int
    {
        if($value)
            return $value;

        $sort   = self::latest()->first()->sort ?? 0 + 10 ?? 10;
        return $sort >= 1000 ? 1000 : $sort;
    }
    public function getLinkAttribute(): string
    {
        return route('projects.single', $this->code ?? $this->id);
    }
    public function getAdminAttribute(): string
    {
        return route('projects.admin', $this->id);
    }
    public function getNewAttribute(): string
    {
        return route('projects.form');
    }
    public function getEditAttribute(): string
    {
        return route('projects.form', $this->id);
    }
    public function getDeleteAttribute(): string
    {
        return route('projects.delete', $this->id);
    }
    public function getSaveAttribute(): string
    {
        return route('projects.save', $this->exists ? $this->id : null);
    }

    public function getImage(?string $type = null): MorphOne
    {
        $result= $this->MorphOne(Image::class, 'relation');
        return $type ? $result->where('type', $type) : $result;
    }
    public function getPreviewAttribute(): Image
    {
        return $this->getImage('preview')->first()
            ?? (new Image(['type' => 'preview']))->relation()->associate($this);
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

    public function terms(): Content
    {
        return $this->getContent('terms');
    }
    public function getTermsAttribute(): ?string
    {
        return $this->terms()->content ?? null;
    }

    public function funding(): Content
    {
        return $this->getContent('funding');
    }
    public function getFundingAttribute(): ?string
    {
        return $this->funding()->content ?? null;
    }
    public function description(): Content
    {
        return $this->getContent('description');
    }
    public function getDescriptionAttribute(): ?string
    {
        return $this->description()->content ?? null;
    }
    public function results(): Content
    {
        return $this->getContent('results');
    }
    public function getResultsAttribute(): ?string
    {
        return $this->results()->content ?? null;
    }

    public function prospects(): Content
    {
        return $this->getContent('prospects');
    }
    public function getProspectsAttribute(): ?string
    {
        return $this->prospects()->content ?? null;
    }

    public static function independentProjects(): Collection
    {
        return self::whereNull('cluster_id')->get();
    }

    public function getFormMenuAttribute(): Collection
    {
        return collect([
            [
                'tabs'      => 'form_box',
                'tab'       => 'tab_base',
                'text'      => 'Основа',
                'section'   => 'projects.admin.includes.form-base-section',
                'active'    => true
            ],
            [
                'tabs'      => 'form_box',
                'tab'       => 'tab_contents',
                'text'      => 'Секции контента',
                'section'   => 'projects.admin.includes.form-contents-section',
            ],
        ]);
    }

    public function cluster():BelongsTo
    {
        return $this->belongsTo(Cluster::class, 'cluster_id');
    }

}
