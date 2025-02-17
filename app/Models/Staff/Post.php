<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;
    protected $table = 'staff_posts';

    protected $fillable = [
        'post',
        'employment',
        'dismissal',
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

}
