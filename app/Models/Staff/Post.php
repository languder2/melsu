<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Post extends Model
{

    use SoftDeletes;
    protected $table = 'staff_posts';

    protected $fillable = [
        'uuid',
        'division_id',
        'staff_id',
        'post',
        'full_post',
        'is_head_of_division',
        'is_teacher',
        'is_show',
        'sort',
        'post_weight',
    ];

}
