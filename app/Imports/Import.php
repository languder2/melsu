<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Import implements ToArray, WithHeadingRow
{

    private $data = [];

    public function array(array $array)
    {
        $this->data = $array;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function headingRow(): int
    {
        return 3;
    }
}
