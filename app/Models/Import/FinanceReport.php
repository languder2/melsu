<?php

namespace App\Models\Import;

use Illuminate\Database\Eloquent\Model;
class FinanceReport extends Model
{
    protected $table = 'finance_report';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'amount',
        'sheet',
        'row',
    ];
}
