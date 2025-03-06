<?php

namespace App\Models\Education;

use App\Models\Gallery\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lab extends Model
{
    use SoftDeletes;

    protected $table = 'education_labs';

    protected $fillable = [
        'name',
        'code',
        'identity_id',
        'description',
        'show',
        'sort',
    ];

    public static function FormRules($id): array
    {
        return [
            'name'              => 'required',
            'code'              => "required|unique:education_labs,code,{$id},id,deleted_at,NULL",
            'description'       => '',
            'sort'              => 'nullable|numeric',
            'show'              => '',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'name'              => 'Укажите заголовок',
            'code.required'     => 'Код должен быть указан',
            'code.unique'       => 'Код должен быть уникальным',
            'sort'              => 'Порядок вывода должен быть числом от 1 до 10000',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function getSortAttribute(?int $value): int|null
    {
        return ($value < 10000) ? $value : null;
    }

    public function setSortAttribute(?int $value): void
    {
        $this->attributes['sort'] = $order ?? 10000;
    }

    public function preview(): MorphOne
    {
        $image = $this->MorphOne(Image::class, 'relation')->where('type', 'preview');

        if(!$image->count())
            $image->create([
                'type'      => 'preview',
                'name'      => 'preview',
            ])->save();

        return $image;
    }


}
