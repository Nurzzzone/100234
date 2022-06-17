<?php

namespace App\Exports;

use App\Models\BusinessRegion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PriceListExport implements FromCollection, WithHeadings, WithEvents, WithDefaultStyles, WithStyles, WithColumnWidths, ShouldAutoSize, WithDrawings
{
    private const CELL_URL = 'B1';
    private const CELL_DATE = 'B2';
    private const CELL_REGION = 'B4';
    private const ROW_HEADINGS = 1;

    /** @var Collection */
    private static $collection;

    /** @var Collection */
    private static $stores;

    /** @var Collection */
    private static $defaultStoreCells;

    /** @var BusinessRegion */
    private static $region;

    public function __construct(Collection $products, Collection $stores, Model $region)
    {
        static::$collection = $products;
        static::$stores = $stores;
        static::$region = $region;
        static::$defaultStoreCells = static::$stores->map(function () {
            return '';
        });
    }

    public function collection(): Collection
    {
        return static::$collection->map(function ($item) {
            return array_merge([
                $item->manufacturerName,
                $item->productBrand,
                $item->productCode,
                $item->productArticle,
                $item->productName,
                $item->productBarcode,
                $item->productApplicability,
                $item->productPrice,
                $item->minQuantity,
            ], $this->getProductRemainQuantity($item));
        });
    }

    protected function getProductRemainQuantity($item): array
    {
        if (!request('withRemains')) {
            return [];
        }

        $quantity = $item->productRemains->flatten()->pluck('quantity', 'store');

        $default = clone static::$defaultStoreCells;

        return $default->replace($quantity)->toArray();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $sheet->setAutoFilter($sheet->calculateWorksheetDataDimension());
                $sheet->insertNewRowBefore(1, 9);

                $sheet->setCellValue(self::CELL_DATE, sprintf('Цены от: %s', now()->format('d-m-Y')));
                $sheet->setCellValue(self::CELL_URL, config('app.url'));

                if (request('withClientStores')) {
                    $sheet->setCellValue(self::CELL_REGION, static::$region->address);
                }
            },
        ];
    }

    public function headings(): array
    {
        return array_merge([
            'Производитель',
            'Бренд',
            'Код товара',
            'Артикул',
            'Наименование',
            'Штрихкод',
            'Применяемость',
            'Цена, KZT',
            'Мин. партия'
        ], static::$stores->toArray());
    }

    public function defaultStyles(Style $defaultStyle): array
    {
        return [
            'font' => [
                'name' => 'Arial',
                'size' => 11,
            ]
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            self::ROW_HEADINGS => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => Color::COLOR_RED],
                ],
                'font' => [
                    'color' => ['argb' => Color::COLOR_WHITE],
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'outline' => [
                        'borderStyle' => Border::BORDER_THIN
                    ]
                ],
            ],
            self::CELL_URL => [
                'font' => [
                    'size' => 12
                ]
            ],
            self::CELL_DATE => [
                'font' => [
                    'size' => 12
                ]
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 40,
            'F' => 40,
            'G' => 40,
            'H' => 20,
            'I' => 20
        ];
    }

    public function drawings()
    {
        return (new Drawing())
            ->setName('Adkulan logo')
            ->setDescription('Adkulan logo')
            ->setPath(app_path('Exports/assets/logo.png'))
            ->setHeight(90)
            ->setOffsetX(50)
            ->setOffsetY(-147);
    }
}
