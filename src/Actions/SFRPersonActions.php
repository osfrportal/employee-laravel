<?php
namespace Osfrportal\OsfrportalLaravel\Actions;


use Osfrportal\OsfrportalLaravel\Models\SfrPerson;




/**
 * Класс для работы с профилем работника
 * @param string $personid UUID работника.
 */
class SFRPersonActions
{
    protected $personid;

    public function __construct(string $personid = '')
    {
        $this->personid = $personid;
    }

    /**
     * Полный профиль работника со всеми отношениями.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function SFRPersonFullData()
    {
        $with_relations = [
            //'PersonDekret',
            //'PersonVacation',
            //'PersonTabNum',
            //'PersonDocs',
            //'PersonAppointment',
            //'PersonUnit',
            //'PersonAD',
            //'PersonContacts',
            //'PersonDecree',
            //'PersonMovements',
        ];
        $person_data = SfrPerson::where('pid', $this->personid)->with($with_relations)->first();
        return $person_data;
    }

}
