<?php

namespace App\Models\Info;

use AllowDynamicProperties;
use App\Enums\Info\Types;
use App\Models\Documents\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

#[AllowDynamicProperties] class Info extends Model
{
    use SoftDeletes;

    public const string Path = 'info/documents';

    protected $table = 'info';

    protected $fillable = [
        'type',
        'code',
        'content',
        'sort',
    ];

    protected $casts = [
        "type"  => Types::class,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->id = now()->format('Uv');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($division) {
            $division->subs()->delete();
        });
    }

    public function fill(array $attributes): self
    {
        if(array_key_exists('sort', $attributes))
            $attributes['sort'] = (int)$attributes['sort'];

        parent::fill($attributes);
        return $this;
    }
    public function save(array $options = []): void
    {
        if(!$this->exists)
            $this->id = null;

        parent::save($options);
    }
    public function relation():MorphTo
    {
        return $this->morphTo();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function subs(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id');
    }

    public function getRecords($type,$code): Collection
    {
        return self::orderBy('sort','desc')
            ->where('code',$code)
            ->where('type',$type)
            ->get()
            ->keyBy('id')
            ;
    }
    public function getFields($type,$code): Collection
    {
        return self::orderBy('sort','desc')
            ->where('code',$code)
            ->where('type',$type)
            ->get()->keyBy('id');
    }
    public function getField($type,$code): Info
    {
        return $this->getFields($type,$code)->first() ?? new self(['type' => $type, 'code' => $code]);
    }
    public function getProperty($code): ?object
    {
        if(!is_object($code))
            $code = $this->getCode($code);

        if(!$code)
            return null;

        $property = $this->getField($this::Type, $code);

        return (object)[
            'type'          => $this::Type->name,
            'prop'          => $code->name,
            'value'         => $property->content ?? __('info.empty'),
            'id'            => $property->exists ? $property->id : null,
        ];
    }
    public function getProperties(string $code): ?array
    {
        $code = $this->getCode($code);

        if(!$code)
            return null;

        return [
            'label' => $code->getName(),
            'prop'  => $code->name,
            'list'  => $this->getContent($this::Type, $code)
        ];
    }
    public function getContent($type,$code): Collection
    {
        return $this->getFields($type,$code)->keyBy('id')
            ->map(function ($item) {
                return (object)[
                    'id'        => $item->id,
                    'type'      => $item->type,
                    'code'      => $item->code,
                    'content'   => $item->content,
                    'link'      => "link#{$item->id}"
                ];
            });
    }

    public function getRelationInfo($code): ?Info
    {
        return $this->subs->where('code',$code)->first()
            ?? $this->subs()->create(['type' => $this::Type, 'code' => $code]);
    }
    public function getRelationArgs($code): object
    {
        return $this->subs->where('code',$code)->map(function ($item) use ($code) {
            return (object)[
                "id" => $item->id,
                "content"   => $item->content ?? __('info.empty'),
                "prop"      => $code->name,
            ];
        })->first()
            ?? (object)[
                "id"        => null,
                "content"   => __('info.empty'),
                "prop"      => $code->name,
            ];

    }
    public function getSubByCode($code): ?Info
    {
        return $this->subs->where('code',$code)->first()
            ?? new Info([
                'code' => $code,
                'type' => $this->type,
            ]);
    }

    public function getCode(?string $code = null)
    {
        foreach($this->codes as $case)
            if($case->name === $code)
                return $case;

        return null;
    }
    public function document():MorphOne
    {
        return $this->morphOne(Document::class,'relation');
    }
    public function getDocument():Document
    {
        return $this->document ?? (new Document())->relation()->associate($this);
    }

    public function documents():MorphMany
    {
        return $this->morphMany(Document::class,'relation');
    }

    public function getTemplate(?string $code= null, $type = 'records') : array
    {
        $code = $this->getCode($code);

        $infoDocs = InfoDocuments::find($this->id) ?? new InfoDocuments(['types' => $this::Type, 'code' => $this->code]);

        return [
            'label'             => $code->getName(),
            'prop'              => $code->name,
            'type'              => $type,
            'list'              =>
                match ($type){
                    'records'   => $this->getList($code),
                    'documents' => $infoDocs->getDocuments($code),
                },
        ];
    }
    public function getList($code) : Collection
    {
        return $this->orderBy('sort','desc')
            ->where('code',$code)
            ->where('type',$this::Type)
            ->get()->keyBy('id');
    }

    public function getDocuments($code) : Collection
    {
        return $this
            ->orderBy('sort','desc')
            ->orderBy('content','asc')
            ->where('code',$code)
            ->where('type',$this::Type)
            ->get()
            ->keyBy('id')
            ->where(fn($item) => $item->document && $item->document->filename)
            ;
    }

    public function getInfos($code, $content = null): Collection
    {
        $query = $this->where('code',$code);

        if($content)
            $query->where('content',$content);

        return $query->get();
    }
    public function getInfo($code, $content = null): ?Info
    {
        return $this->getInfos($code, $content)->first();
    }

    public function getPropAttribute(): ?string
    {
        return $this->code->name ?? null;
    }
    /* Links */
    public function getDeleteAttribute(): string
    {
        return url(route('info:delete',[$this->id]));
    }
    public function getFormAttribute(): string
    {
        return url(route('info:form',[
            'type'  => is_string($this->type) ? $this->type : $this->type->name,
            'code'  => is_string($this->code) ? $this->code : $this->code->name,
            'info'  => $this->exists ? $this->id : null,
        ]));
    }
    public function getFormFounderAttribute(): string
    {
        return url(route('info:form:founder',[$this->id]));
    }

    public function getContentAttribute($content): ?string
    {
        return empty($content) ? __('info.empty') : $content;
    }

    public function getSubsValue($code): ?string
    {
        $record = $this->subs->where('code',$code)->first();

        return $record ? $record->content : null;

    }

    public function linkAdd():string
    {
        return '#';
    }

}
