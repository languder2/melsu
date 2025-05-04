<?php

namespace App\Models\Documents;

use App\Models\Services\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use SoftDeletes;

    protected $table        = 'documents';

    protected $fillable     = [
        'title',
        'parent_id',
        'category_id',
        'filename',
        'filetype',
        'is_show',
        'sort',
    ];

    public static function FormRules(): array
    {
        return [
//            'test'          => "required",
            'title'         => 'required',
            'file'          => '',
            'parent_id'     => '',
            'category_id'   => '',
            'is_show'       => '',
            'sort'          => '',
        ];
    }
    public static function FormMessage(): array
    {
        return [
            'title'         => 'Укажите заголовок файла',
            'file'          => 'Загрузите файл',
        ];
    }

    protected $casts        = [
        'is_show'   => 'boolean',
        'sort'      => 'integer',
    ];
    public function relation():MorphTo
    {
        return $this->MorphTo();
    }
    public function getIdAttribute($value):int
    {
        return $value ?? microtime(true);

    }

    public function parent():BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public static function FileSave(array &$form, ?Model $model = null):void
    {
        $folder = "documents/".($model && $model::Path ? $model::Path : 'custom')."/".time();


        $filename = transliterate($form['title']);

        if(strlen($filename)>100)
            $filename = substr($filename, 0, 100);

        $filename .= '.'.$form['file']->getClientOriginalExtension();

        $form['file']->storePubliclyAs($folder,$filename);

        $form['filename'] = "$folder/$filename";
        $form['filetype'] = $form['file']->getClientOriginalExtension();
    }
    public function fill(array $attributes):?self
    {
        if(!empty($attributes)){
            $attributes['is_show']      = array_key_exists('is_show', $attributes);
            $attributes['sort']         = $attributes['sort'] ?? 1000;
        }

        return parent::fill($attributes);
    }
    public function getLinkAttribute():?string
    {
        return $this->filename ? Storage::url($this->filename) : null;
    }
    public function subs():HasMany
    {
        return $this->hasMany(self::class,'parent_id');
    }
    public function publicSubs():HasMany
    {
        return $this->hasMany(self::class,'parent_id')
            ->where('is_show',true)
            ->orderBy('sort')->orderBy('title');
    }

    public static function processingForms(?Model $model, ?array $forms, ?Model $origin = null):void
    {
        if(!$forms || !$model) return;

        foreach ($forms as $key => $form) {
            if(!is_array($form) || empty($form['title'])) continue;

            $form['file'] = request()->file("documents_$key");

            self::processingForm($model, $form, $key, $origin);

        }
    }

    public static function processingForm(?Model $model, array $form, string $item, ?Model $origin = null):void
    {

        $item = self::find($item) ?? new self();

        if($form['file'])
            self::FileSave($form, $model);

        $item->fill($form)->relation()->associate($model)->save();

        $origin ? Log::withOrigin($origin, $item) : Log::add($item);
    }


}
