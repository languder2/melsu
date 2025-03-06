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
        'post',
        'employment',
        'dismissal',
    ];

    public function relation(): MorphTo
    {
        return $this->morphTo();
    }

    public function getYearsAttribute(): string
    {

        if($this->employment)
            $years = Carbon::parse($this->employment)->format('Y');

        if($this->dismissal && $this->employment)
            $years .= ' - ';


        if($this->dismissal)
            $years .= Carbon::parse($this->dismissal)->format('Y');

        return $years;
    }

}
