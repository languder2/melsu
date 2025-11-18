<?php

namespace App\Models\Sections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use SoftDeletes;

    protected $table = 'faq';

    protected $fillable = [
        'id',
        'question',
        'answer',
        'show',
        'relation_id',
        'relation_type',
        'order',
    ];

    public static function FormRules($id): array
    {
        return [
            'question'      => 'required',
            'answer'        => 'required',
            'show'          => 'boolean',
            'order' => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'question' => 'Укажите вопрос',
            'answer' => 'Заполните ответ',
        ];
    }

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function getOrderAttribute(?int $order): ?int
    {
        return ($order < 10000) ? $order :  null ;
    }

    public function setOrderAttribute($order): void
    {
        $this->attributes['order'] = $order ?? 10000;
    }

    public static function processing($object,$list):void
    {

        foreach ($list as $id=>$form) {
            if(!$form['question']) continue;
            $faq = self::find($id) ?? new FAQ();
            $faq->fill($form);
            $faq->show= array_key_exists('show',$form);
            $faq->relation()->associate($object);
            $faq->save();
        }
    }

}
