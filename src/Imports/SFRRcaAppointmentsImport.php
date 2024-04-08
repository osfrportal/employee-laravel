<?php
namespace Osfrportal\OsfrportalLaravel\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Carbon\Carbon;

class SFRRcaAppointmentsImport implements ToCollection, WithValidation, SkipsOnFailure, WithChunkReading
{
    use Importable, SkipsFailures;
    public function rules(): array
    {

        /*
        return [
            'sotrudnikfiziceskoe_licoinn' => 'required|digits:12',
            'period_otsutstviias' => 'required|date',
            'do' => 'required|date',
        ];
        */
        return [];

    }
    public function chunkSize(): int
    {
        return 20;
    }
    public function collection(Collection $collection)
    {
        $collection->each(function ($item) {
            dump($item);
        });
    }

}
