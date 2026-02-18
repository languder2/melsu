<?php

namespace App\Models\Staff;

use App\Models\Division\Division;
use App\Models\Employees\Employee;
use App\Models\Gallery\Image;
use App\Models\Global\Options;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class StaffJobHistory extends Model
{
    use SoftDeletes;

    protected $table = 'staff_job_history';

    protected $fillable = [
        'id',
        'staff_id',
        'company',
        'post',
        'employment_year',
        'dismissal_year'


    ];

}
