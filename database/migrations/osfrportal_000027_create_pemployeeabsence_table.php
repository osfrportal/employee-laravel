<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pemployeeabsence')) {
            Schema::create('pemployeeabsence', function (Blueprint $table) {
                $table->comment('Отсутствия работников');
                $table->uuid('pid');
                $table->date('absencestart');
                $table->date('absenceend');
                $table->foreign('pid')->references('pid')->on('ppersons');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pemployeeabsence');
    }
};
