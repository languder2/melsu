<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'page_contents';

    protected $fillable = [
        'title',
        'show_title',
        'content',
        'show',
        'order',
    ];

}
