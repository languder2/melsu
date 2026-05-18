<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FinanceSheet implements FromCollection, WithDefaultStyles, ShouldAutoSize, WithColumnWidths, WithTitle, WithStyles
{
    protected Collection $accounts;
    protected string $type;
    protected string $title;
    protected array $columnWidths = [
        'psb'   => [
            'A' => 22,
            'B' => 4,
            'C' => 10,
            'G' => 3,
            'H' => 12,
            'I' => 1,
            'J' => 1,
            'K' => 2,
        ],
        'sber'   => [
            'A' => 22,
            'E' => 10,
            'F' => 4,
        ],
        'other'   => [
            'A' => 22,
            'B' => 4,
            'C' => 10,
            'G' => 3,
            'H' => 12,
            'I' => 1,
            'J' => 1,
            'K' => 2,
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

    public function defaultStyles(Style $defaultStyle):array
    {
        return [
            'numberFormat' => [
                'formatCode' => NumberFormat::FORMAT_TEXT
            ]
        ];
    }

    public function columnWidths(): array
    {
        return $this->columnWidths[$this->type] ?? [];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function styles(Worksheet $sheet): array
    {
        if ($this->type === 'totals') {
            $sheet->getStyle('5')->getFont()->setBold(true);
            $sheet->getStyle('8')->getFont()->setBold(true);
        }
        return [];
    }
}
