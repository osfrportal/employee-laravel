<?php

namespace Osfrportal\OsfrportalLaravel\Services;


use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;

class SFRPersonService
{
    protected $tmp_array_select2;

    /**
     * Выдача данных в формате массива для модуля Select2
     * pid и полное фио работника
     * @param string $searchTerm
     * @return array
     */
    public function APIPersonsSearchSelect2(string $searchTerm)
    {
        $columns_to_get = [
            'pid',
            'psurname',
            'pname',
            'pmiddlename',
        ];

        $api_persons_select2_data = SfrPerson::query()
            ->where('psurname', 'ILIKE', "{$searchTerm}%")
            ->whereHas('SfrPersonAppointment')
            ->whereHas('SfrPersonUnit')
            ->orderByDesc('psurname')
            ->orderByDesc('pname')
            ->orderByDesc('pmiddlename')
            ->get($columns_to_get);
        $out = $this->ConvertPersonCollectionSelect2($api_persons_select2_data);

        return $out;
    }

    /**
     * Конвертация полученной коллекции из функции APIPersonsSearchSelect2 в массив для Select2
     * @param Collection $collection
     * @return array
     */
    private function ConvertPersonCollectionSelect2(Collection $collection)
    {
        $this->tmp_array_select2['results'] = [];
        $collection->each(function ($item, $key) {
            $person_data = $item->toArray();

            $tmpvalarr = [
                'id' => $person_data['pid'],
                'text' => sprintf('%s %s %s', $person_data['psurname'], $person_data['pname'], $person_data['pmiddlename']),
            ];
            $this->tmp_array_select2['results'] = Arr::prepend($this->tmp_array_select2['results'], $tmpvalarr);

        });
        return $this->tmp_array_select2;
        //return $this->collection_data;
    }

}
