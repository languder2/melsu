<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FinanceSheet implements FromCollection, WithColumnFormatting, ShouldAutoSize, WithColumnWidths, WithTitle
{
    protected Collection $accounts;
    protected string $type;
    protected string $title;
    protected array $columnWidths = [
        'psb'   => [
            'A' => 22,
            'B' => 4,
            'C' => 10,
            'G' => 1,
            'H' => 12,
            'I' => 1,
            'J' => 1,
            'K' => 2,
        ],
        'sbr'   => [
            'A' => 22,
            'E' => 10,
            'F' => 2,
        ],
    ];
    protected array $columnFormats = [
        'psb'   => [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
        ],
        'sbr'   => [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
        ],
        'errors'   => [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
        ],
    ];

    public function __construct($accounts, $type, $title)
    {
        $this->accounts = $accounts;
        $this->type     = $type;
        $this->title    = $title;
    }

    public function collection(): Collection
    {
        return collect($this->accounts);
    }

    public function columnFormats(): array
    {
        return $this->columnFormats[$this->type] ?? [];
    }


    public function columnWidths(): array
    {
        return $this->columnWidths[$this->type] ?? [];
    }

    public function title(): string
    {
        return $this->title;
    }
}
