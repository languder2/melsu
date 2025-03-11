<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ContactType;

class Contact extends Model
{
    use softDeletes;
    protected $table = 'contacts';

    protected $fillable = [
        'id',
        'title',
        'content',
        'type',
        'is_show',
        'sort',
    ];

    public static function FormRules($id): array
    {
        return [
            'title'     => "",
            'content'   => 'required',
            'type'      => "required",
            'show'      => '',
            'sort'      => 'nullable|numeric',
        ];
    }

    public static function FormMessage(): array
    {
        return [
            'content'   => 'Укажите значение',
            'type'      => "Укажите тип",
        ];
    }
    protected $casts = [
        'is_show'   => 'boolean',
        'type'      => ContactType::class,
    ];

    public function relation():MorphTo
    {
        return $this->morphTo();
    }

    public static function processing($record,$forms)
    {
        foreach ($forms as $id=>$form) {
            $form['is_show'] = array_key_exists('is_show',$form);
            unset($form['id']);

            $contact = Contact::find($id);
            if(!$contact)
                $contact  = new Contact($form);

            $contact->fill($form);

            $contact->relation()->associate($record);

            $contact->save();
        }
    }

}
