<?php
namespace Osfrportal\OsfrportalLaravel\Exports;

use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Carbon\Carbon;
class SFRPhonesToXLSXExport implements FromCollection, Responsable, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    private $fileName = 'phones.xlsx';
    private $writerType = Excel::XLSX;


    private $sfrpersons;

    public function __construct()
    {
        $this->sfrpersons = SfrPerson::all();
        $this->fileName = sprintf('%s_Выгрузка_работников.xlsx', Carbon::now()->format('Ymd_His'));
    }
    public function headings(): array
    {
        return [
            'Фамилия',
            'Имя',
            'Отчество',
            'Д.р.',
            'Телефон',
            'Должность',
            'СНИЛС',
            'Подразделение',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 14], 'fill' => [
                'fillType'   => Fill::FILL_SOLID,
            ]],
        ];
    }

    public function collection()
    {
        $personsCollection = collect();
        foreach ($this->sfrpersons->all() as $sfrperson) {
            if (($sfrperson->getUnit() !== "") && ($sfrperson->getAppointment() !== "")) {
                if (!is_null($sfrperson->getPersonContactData())) {
                    $contact_data = SFRPhoneContactData::from($sfrperson->getPersonContactData());
                    $contactPhone = sprintf('(%s) %s', $contact_data->areacode, $contact_data->phone_external);;
                }
                $personArr = [$sfrperson->psurname, $sfrperson->pname, $sfrperson->pmiddlename, $sfrperson->getBirthDate(), $contactPhone, $sfrperson->getAppointment(), $sfrperson->getSNILS(), $sfrperson->getUnit()];
                $personsCollection->push($personArr);
            }
        }
        return $personsCollection;
    }
}
