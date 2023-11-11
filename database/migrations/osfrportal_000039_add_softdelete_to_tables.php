<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private $arrTables = [
        'paddresses',
        'pappointment',
        'sfrcerts',
        'pdialplan',
        'sfrdocgroups',
        'sfrdocs',
        'sfrdoctypes',
        'pempapp',
        'pemployeetab',
        'pempunit',
        'sfrfiles',
        'linkgroups',
        'lgrelation',
        'links',
        'logspcauth',
        'orioncards',
        'orionentrypoints',
        'ppersons',
        'pemployeeabsence',
        'pemployeecontacts',
        'pemployeedekret',
        'pemployeevacation',
        'ppersorion',
        'rel_sfrdocs_files',
        'sfrsigratures',
        'punits',
        'sfrusers',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->arrTables as $tableToAddColumn) {
            if (Schema::hasTable($tableToAddColumn)) {
                Schema::table($tableToAddColumn, function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->arrTables as $tableToAddColumn) {
            if (Schema::hasTable($tableToAddColumn)) {
                Schema::table($tableToAddColumn, function (Blueprint $table) {
                    $table->dropSoftDeletes();
                });
            }
        }
    }
};