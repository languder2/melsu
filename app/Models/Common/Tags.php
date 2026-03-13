<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';

    protected $fillable = ['id','name','type'];

    public $timestamps = false;
}
