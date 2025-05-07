<?php

namespace App\Models\News;

use App\Models\Gallery\Image;
use App\Models\Services\Content;
use App\Models\Services\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationNews extends Model
{
    use SoftDeletes;

    protected $table = 'relation_news';

    protected $fillable = [
        'title',
        'is_show',
        'is_favorite',
        'sort',
        'published_at',
    ];

    protected $dates = [
        'published_at',
        'deleted_at'
    ];

    public function getIdAttribute($value):int
    {
        return $value ?? microtime(true);

    }
    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['is_show']      = (int) array_key_exists('is_show', $attributes);
            $attributes['is_favorite']  = (int) array_key_exists('is_favorite', $attributes);
            $attributes['sort']         = $attributes['sort'] ?? 1000;
        }

        return parent::fill($attributes);
    }

    public function relation():MorphTo
    {
        return $this->morphTo();
    }
    public function getLinkAttribute():string
    {
        return $this->relation->NewsLink($this->id);
    }

    public function getPreview(): MorphOne
    {
        return $this->MorphOne(Image::class, 'relation')->where('type', 'preview');
    }

    public function getPreviewAttribute(): Image
    {
        return $this->getPreview()->first() ?? (new Image(['type' => 'preview']))->relation()->associate($this);
    }

    public function getContent(?string $type):MorphOne
    {
        return $this->MorphOne(Content::class, 'relation')->where('type', $type);
    }

    public function getContentRecord():Content
    {
        return $this->getContent('content')->first()
            ?? (new Content(['type' => 'content']))->relation()->associate($this);
    }
    public function getContentAttribute():?string
    {
        return $this->getContentRecord()->content;
    }

    public function getShortRecord():Content
    {
        return $this->getContent('short')->first()
            ?? (new Content(['type' => 'short']))->relation()->associate($this);
    }
    public function getShortAttribute(): ?string
    {
        return $this->getShortRecord()->content;
    }

    public static function processingForms(?Model $model, ?array $forms, ?Model $origin = null):void
    {

        if(!$forms || !$model) return;

        foreach ($forms as $key => $form)
            if(is_array($form) && $form['title'])
                self::processingForm($model, $form, $key, $origin);
    }

    public static function processingForm(?Model $model, array $form, string $key, ?Model $origin = null):void
    {

        $item = self::find($key) ?? new self();

        $item->fill($form)->relation()->associate($model)->save();

        $origin ? Log::withOrigin($origin, $item) : Log::add($item);

        if(array_key_exists('short',$form) && $form['short'])
            $item->getShortRecord()->fill(['type'=>'short', 'content' => $form['short']])->save();

        if(array_key_exists('content',$form) && $form['content'])
            $item->getContentRecord()->fill(['type'=>'content', 'content' => $form['content']])->save();

        if(array_key_exists('image', $form) && $form['image']){
            $item->preview->saveImage($form['image']);
        }
        elseif($form['preview']){
            $item->preview->fill(['name' => $item->title]);
            $item->preview->getReferenceID($form['preview']);
        }
        else{
            $item->preview->reference_id = null;
            $item->preview->filename = null;
            $item->preview->filetype = null;
            $item->preview->save();
        }
    }

}
