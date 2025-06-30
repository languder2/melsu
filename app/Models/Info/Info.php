<?php

namespace App\Models\Info;

use AllowDynamicProperties;
use App\Enums\Info\InfoType;
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
        "type"  => InfoType::class,
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
    public function getField($type,$code): Info
    {
        return $this->getFields($type,$code)->first() ?? new Info(['type' => $type, 'code' => $code]);
    }
    public function getContent($type,$code): Collection
    {
        return $this->getFields($type,$code)->pluck('content','id')->collect();
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

    public function document():MorphOne
    {
        return $this->morphOne(Document::class,'relation');
    }

    public function getDocuments($type,$code):Collection
    {
        return $this->getFields($type,$code)->map(function($item) {
            return (object)[
                    "id" => $item->id,
                    "content" => $item->content,
                    "title" => $item->document->title ?? "-",
                    "link" => $item->document->link ?? "-",
            ];
        });
    }




}
