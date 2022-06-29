<?php

namespace App\Imports;

use App\Models\Cross;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CrossesImport implements ToCollection, WithChunkReading, WithHeadingRow, ShouldQueue
{
    use Importable;

    public $manufacturerColumn;
    public $articleColumn;

    public $substituteManufacturerColumn;
    public $substituteArticleColumn;

    public $nameColumn;
    public $qualityColumn;

    public function __construct(array $columns)
    {
        $this->manufacturerColumn = $columns['manufacturer_column'];
        $this->articleColumn = $columns['article_column'];
        $this->substituteManufacturerColumn = $columns['substitute_manufacturer_column'];
        $this->substituteArticleColumn = $columns['substitute_article_column'];
        $this->nameColumn = $columns['name_column'] ?? null;
        $this->qualityColumn = $columns['quality_column'] ?? null;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $crosses = $rows->map(function ($row) {
            $row = $this->trimArrayKeys($row->toArray());
            //TODO написать регулярки для очистки артикула и бренда
            return [
                'main_brand' => $row[$this->manufacturerColumn],
                'main_article' => $row[$this->articleColumn],
                'repl_brand' => $row[$this->substituteManufacturerColumn],
                'repl_article' =>$row[$this->substituteArticleColumn],
                'quality' => $this->getRowQuality($row),
                'name' => $row[$this->nameColumn] ?? null,
            ];
        });

        Cross::query()->insertOrIgnore($crosses->toArray());
    }

    public function chunkSize(): int
    {
        return 100;
    }

    protected function getRowQuality($row)
    {
        $quality = $row[$this->qualityColumn] ?? null;

        return is_numeric($quality) ? $quality : 3;
    }

    protected function trimArrayKeys($array)
    {
        $keys = array_map('trim', array_keys($array));
        $values = array_map('trim', $array);
        return array_combine($keys, $values);
    }
}
