<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FinanceBook implements WithMultipleSheets
{
    protected Collection $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        return $this->data->map(fn($item) => new FinanceSheet($item->accounts, $item->type,  $item->name))->toArray();
    }
}
