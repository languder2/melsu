<?php

namespace App\Models\Documents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
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
    public function parent():BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public static function FileSave(array &$form):void
    {
        $folder = "documents/custom/".time();

        $filename = transliterate($form['title']);

        if(strlen($filename)>150)
            $filename = substr($filename, 0, 150);

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

}
