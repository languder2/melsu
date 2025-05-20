<?php

namespace App\Imports;

use App\Models\Import\FinanceReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnLimit;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Import implements toModel, WithChunkReading, WithLimit, WithColumnLimit
{
    public ?string $sheet = null;

    /**
    * @param Collection $rows
    */
    public function chunkSize(): int
    {
        return 2000;
    }

    public function endColumn(): string
    {
        return 'C';
    }

    public function limit(): int
    {
        return 2000;
    }

    public function model(array $row)
    {
        return new FinanceReport([
            'name'      => trim($row[1]),
            'amount'    => $row[2],
            'row'       => (int)$row[0],
            'sheet'     => $this->sheet,
        ]);
    }
}

