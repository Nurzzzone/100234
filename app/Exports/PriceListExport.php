<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PriceListExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * @var Collection
     */
    private static $collection;

    /**
     * @var Collection
     */
    private static $stores;

    public function __construct()
    {
        static::$collection = $this->collectionData();
        static::$stores = $this->stores();
    }

    protected function collectionData()
    {
        return Product::query()
            ->with('productRemains', 'productRemains.productStore')
            ->leftJoin('1c_manufacturers', '1c_products.manufacturer', '1c_manufacturers.guid')
            ->when(request('priceListType') == 0, function(Builder $query) {
                $query->whereIn('1c_manufacturers.guid', request('manufacturers'));
            }, function(Builder $query) {
                $priceGroup = request('priceGroup') == 0? '1c95a9b3-b933-11e1-8447-3c4a92fa410f': '60a63d65-eeeb-11e4-ab38-00155d648080';
                $query->where('1c_products.price_group', $priceGroup);
            })
            ->when(request('withRemains') == 1, function($query) {
                $query->has('productRemains.productStore');
            })
            ->when(request('withClientStores') == 1, function(Builder $query) {
                $query
                    ->leftJoin('1c_products_remains', '1c_products_remains.product', '1c_products.guid')
                    ->leftJoin('1c_stores', '1c_stores.guid', '1c_products_remains.store')
                    ->leftJoin('b2b_clients', 'b2b_clients.business_region', '1c_stores.business_region')
                    ->leftJoin('1c_users', '1c_users.owner', 'b2b_clients.guid')
                    ->where('1c_users.guid', request('user_id'));
            })
            ->leftJoin('1c_marks', '1c_marks.guid', '1c_products.brand')
            ->leftJoin('1c_prices', function (JoinClause $join) {
                $join->on('1c_prices.product', '1c_products.guid')
                    // TODO переписать стоит оптовая
                    ->where('1c_prices.price_type', '62211de3-0e78-11e9-b693-00155d648092');
            })
            ->select([
                '1c_products.GUID',
                '1c_manufacturers.name as manufacturerName',
                '1c_marks.name as productBrand',
                '1c_products.code as productCode',
                '1c_products.article as productArticle',
                '1c_products.name as productName',
                '1c_products.barcode as productBarcode',
                '1c_products.applicability as productApplicability',
                '1c_prices.price as productPrice',
                '1c_products.minorderquantity as minQuantity',
            ])
            ->distinct()
            ->orderBy('1c_products.article')
            ->get();
    }

    public function collection(): Collection
    {
        $result = [];

        foreach(static::$collection->chunk(1000) as $chunk) {
            foreach($chunk as $item) {
                $result[] = array_merge([
                    $item->manufacturerName,
                    $item->productBrand,
                    $item->productCode,
                    $item->productArticle,
                    $item->productName,
                    $item->productBarcode,
                    $item->productApplicability,
                    $item->productPrice,
                    $item->minQuantity,
                ], request('withRemains') == 0? []: $this->getProductRemainQuantity($item));
            }
        }

        return collect($result);
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
        ], request('withRemains') == 0? []: static::$stores->toArray());
    }

    protected function stores()
    {
        return static::$collection
            ->pluck('productRemains')
            ->flatten()
            ->unique('store')
            ->pluck('productStore')
            ->flatten()
            ->pluck('name', 'GUID');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $this->font($sheet);
                $this->cellWidth($sheet);
                $this->modifyHeadings($sheet);
                $this->addFilters($sheet);

                /* !important do this after */
                $this->prependRows($sheet);
                $this->date($sheet);
                $this->url($sheet);
                $this->businessRegion($sheet);
                $this->logo($sheet);
            },
        ];
    }

    protected function font($sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial');
        $sheet->getParent()->getDefaultStyle()->getFont()->setSize(11);
    }

    protected function cellWidth(Sheet $sheet)
    {
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(40);
        $sheet->getColumnDimension('F')->setWidth(40);
        $sheet->getColumnDimension('G')->setWidth(40);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);

        foreach($sheet->getRowIterator()->current()->getCellIterator() as $cell) {
            if (! in_array($cell->getColumn(), ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'])) {
                $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
            }
        }
    }

    protected function modifyHeadings($sheet)
    {
        $headingCells = $sheet->getRowIterator()->current()->getCellIterator();

        foreach ($headingCells as $headingCell) {
            $headingCell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID);
            $headingCell->getStyle()->getFill()->getStartColor()->setARGB('FFFF0000');
            $headingCell->getStyle()->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
            $headingCell->getStyle()->getFont()->setBold(true);
            $headingCell->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $headingCell->getStyle()->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $headingCell->getStyle()->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $headingCell->getStyle()->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
            $headingCell->getStyle()->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
        }
    }

    protected function addFilters($sheet)
    {
        $sheet->setAutoFilter($sheet->calculateWorksheetDataDimension());
    }

    protected function prependRows($sheet)
    {
        $sheet->insertNewRowBefore(1, 9);
    }

    protected function date($sheet)
    {
        $sheet->setCellValue('B2', sprintf('Цены от: %s', now()->format('d-m-Y')));
        $sheet->getStyle('B2')->getFont()->setSize(12);
    }

    protected function url($sheet)
    {
        $sheet->setCellValue('B1', config('app.url'));
        $sheet->getCell('B1')->getHyperlink()->setUrl(config('app.url'));
        $sheet->getStyle('B1')->getFont()->setSize(12);
    }

    protected function logo($sheet)
    {
        $drawing = new Drawing();
        $drawing->setName('Adkulan logo');
        $drawing->setDescription('Adkulan logo');
        $drawing->setPath(app_path('Exports/assets/logo.png'));
        $drawing->setHeight(90);
        $drawing->setOffsetX(50);
        $drawing->setOffsetY(50);
        $drawing->setWorksheet($sheet->getDelegate());
    }

    protected function businessRegion(Sheet $sheet)
    {
        if (request('withClientStores') == 1) {
            $business_region = DB::connection('adkulan_dev')
                ->table('1c_business_regions')
                ->leftJoin('b2b_clients', 'b2b_clients.business_region', '1c_business_regions.guid')
                ->leftJoin('1c_users', '1c_users.owner', 'b2b_clients.guid')
                ->where('1c_users.guid', request('user_id'))
                ->first(['1c_business_regions.address']);

            $sheet->setCellValue('B4', $business_region->address);
        }
    }

    protected function getProductRemainQuantity($item)
    {
        return static::$stores->reduce(function ($carry, $_, $id) use ($item) {
            $carry[] = optional($item->productRemains->firstWhere('store', $id))->quantity ?? '';

            return $carry;
        });
    }
}
