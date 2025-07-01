<?php

namespace App\Models\Info;

use AllowDynamicProperties;
use App\Enums\Info\Types;
use App\Models\Documents\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

#[AllowDynamicProperties] class Info extends Model
{
    use SoftDeletes;

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

    public function fill(array $attributes):void
    {

        parent::fill($attributes);
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
    public function subs():MorphMany
    {
        return $this->morphMany(self::class, 'relation');
    }

    public function getFields($type,$code): Collection
    {
        return self::orderBy('sort','desc')
            ->where('code',$code)
            ->where('type',$type)
            ->get()->keyBy('id');
    }
    public function getField($type,$code): ?Info
    {
        return $this->getFields($type,$code)->first();
    }
    public function getProperty(string $code): ?object
    {
        $code = $this->getCode($code);

        if(!$code)
            return null;

        return (object)[
            'prop'          => $code->name,
            'value'         => $this->getField($this::Type, $code)->content ?? __('info.empty'),
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
    public function documents():MorphMany
    {
        return $this->morphMany(Document::class,'relation');
    }

    public function getTemplate(?string $code= null, $type = 'records') : array
    {
        $code = $this->getCode($code);

        return [
            'label'             => $code->getName(),
            'prop'              => $code->name,
            'list'              =>
                match ($type){
                    'records'   => $this->getList($code),
                    'documents' => $this->getDocuments($code),
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
        return $this->orderBy('sort','desc')
            ->where('code',$code)
            ->where('type',$this::Type)
            ->get()
            ->keyBy('id')
            ->where(fn($item) => $item->document && $item->document->filename)
            ;
    }


}
