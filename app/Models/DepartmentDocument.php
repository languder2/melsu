<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentDocument extends Model
{
    use SoftDeletes;

    protected $table        = 'department_documents';
    protected $fillable     = [
        'id',
        'name',
        'file',
        'extension',
        'department',
        'sort',
        'deleted_at'
    ];
}
