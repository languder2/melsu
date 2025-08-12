<?php

namespace App\Models\Documents;

use App\Models\Global\Options;
use App\Models\Services\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
//        $this->id = now()->format('Uv');
    }

    public function save(array $options = []): void
    {
        if(!$this->exists)
            $this->id = null;

        parent::save($options);
    }
    public function fill(array $attributes):self
    {
        if(!empty($attributes)){
            $attributes['is_show']      = (int) array_key_exists('is_show', $attributes);
            $attributes['sort']         = $attributes['sort'] ?? 1000;
        }
        return parent::fill($attributes);
    }

    public function relation():MorphTo
    {
        return $this->MorphTo();
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



        if(array_key_exists('form',$form) && $form['form'])
            $item->getSpecialityForm()->fill(['property' => $form['form']])->save();

        if(array_key_exists('type',$form) && $form['type'])
            $item->getType()->fill(['property' => $form['type']])->save();
    }

    public function options():MorphOne
    {
        return $this->morphOne( Options::class, 'relation');
    }

    public function getOption($option):Options
    {
        return $this->options()->where('code',$option)->first()
            ?? (new Options(['code' => $option]))->relation()->associate($this);
    }

    public function getType():Options
    {
        return $this->getOption('type');
    }
    public function getTypeAttribute():?string
    {
        return $this->getType()->property;
    }
    public function getCodeAttribute():?string
    {
        return $this->getOption('code')->property ?? null;
    }
    public function getYearAttribute():?string
    {
        return $this->getOption('year')->property ?? null;
    }
    public function getSpecialityForm():Options
    {
        return $this->getOption('form');
    }
    public function getSpecialityFormAttribute():?string
    {
        return $this->getSpecialityForm()->property;
    }
    public function getDeleteAttribute(): string
    {
        return route('documents:delete', $this);
    }
    public function getRelationFormAttribute(): string
    {
        return route('division:admin:documents:form', [$this->relation ?? null, $this->category ?? null, $this ]);
    }
    public function getRelationSaveAttribute(): string
    {
        return route('division:admin:documents:save', [$this->relation, $this ]);
    }
    public function getRelationDeleteAttribute(): string
    {
        return route('division:admin:documents:delete', [$this->relation, $this ]);
    }

}
