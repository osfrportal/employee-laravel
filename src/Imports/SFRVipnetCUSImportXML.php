<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;

class SFRVipnetCUSImportXML implements ToCollection, WithChunkReading, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function chunkSize(): int
    {
        return 1000;
    }
    public function collection(Collection $collection)
    {
        $collection->each(function ($item) {
            dump($item);
        });
    }

}
