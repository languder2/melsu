<?php

namespace App\Models\News;

use App\Models\Gallery\Image;
use App\Models\Services\Content;
use App\Models\Services\Log;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
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

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['is_show']      = (bool)$attributes['is_show'];
        }

        return parent::fill($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->getContentRecord()->delete();
            $item->getShortRecord()->delete();
            $item->getPreview()->delete();
        });
    }

    public function validateRules(): array
    {
        return
            [
                'title' => 'required',
                'published_at' => '',
                'is_show'   => '',
                'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:20480',
            ];
    }
    public function validateMessage(): array
    {
        return [
            'title' => 'Укажите заголовок',
        ];
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
        else{
            $item->preview->reference_id = null;
            $item->preview->filename = null;
            $item->preview->filetype = null;
            $item->preview->save();
        }
    }

    public function author():BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function getFormAttribute(): string
    {
        return route('news.cabinet.form',$this);
    }
    public function getSaveAttribute(): string
    {
        return route('news.cabinet.save',$this);
    }
    public function getDeleteAttribute(): string
    {
        return route('news.cabinet.delete',$this);
    }


}
