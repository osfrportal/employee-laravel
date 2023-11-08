<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('ppersorion')) {
            Schema::create('ppersorion', function (Blueprint $table) {
                $table->comment('Соответствие id работника и id персоны в ОрионПРО');
                $table->id();
                $table->uuid('pid')->nullable();
                $table->integer('orionpersid')->unique();
                $table->jsonb('tpersondata')->comment('TPersonData');
                $table->timestamps();
                $table->foreign('pid')->references('pid')->on('ppersons');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('ppersorion');
    }
};
