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
class SFRVipnetToXLSXExport implements FromCollection, Responsable, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    private $fileName = 'persons-phones-businessmail.xlsx';
    private $writerType = Excel::XLSX;


    private $sfrpersons;

    public function __construct()
    {
        $this->sfrpersons = SfrPerson::all();
        $this->fileName = sprintf('%s_Выгрузка_работников_с_vipnet.xlsx', Carbon::now()->format('Ymd_His'));
    }
    public function headings(): array
    {
        return [
            'Имя сетевого узла',
            'Имя пользователя',
            'Назначение абонентского пункта',
            'Должность',
            'Подразделение',
            'ФИО работника',
            'Телефон (городской)',
            'Телефон (КСПД)',
            'Email',

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
                    $contactPhone_external = sprintf('(%s) %s', $contact_data->areacode, $contact_data->phone_external);
                    $contactPhone_internal = sprintf('(58) %s', $contact_data->phone_internal);
                }
                $personArr = [
                    'Имя сетевого узла',
                    'Имя пользователя',
                    'Назначение абонентского пункта',
                    $sfrperson->getAppointment(),
                    $sfrperson->getUnit(),
                    $sfrperson->getFullName(),
                    $contactPhone_external,
                    $contactPhone_internal,
                    $contact_data->email_ext,
                ];
                $personsCollection->push($personArr);
            }
        }
        return $personsCollection;
    }
}
