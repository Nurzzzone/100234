<?php

namespace App\Imports;

use App\Crosses\OneSCross;
use App\Crosses\PartnerCross;
use App\Models\Cross;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DeleteCrossImport implements ToCollection, WithChunkReading, ShouldQueue
{
    use Importable;

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $firstArticles = $rows->pluck('0')->all();
        $secondArticles = $rows->pluck('1')->all();

        Cross::pairs($firstArticles, $secondArticles)->delete(); //Прямые кроссы
        Cross::pairs($secondArticles, $firstArticles)->delete(); //Обратные кроссы

    }

    public function chunkSize(): int
    {
        return 100;
    }

}
