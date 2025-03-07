<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ContactType;

class Contact extends Model
{
    use softDeletes;
    protected $table = 'contacts';

    protected $fillable = [
        'content',
        'type',
        'is_show',
        'sort',
    ];

    public static function FormRules($id): array
    {
        return [
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

}
