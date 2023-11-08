<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_sfrinfosystems_persons', function (Blueprint $table) {
            $table->comment('Таблица отношений работников ОСФР по Липецкой области к информационным системам');
            $table->id();
            $table->timestamps();
            $table->uuid('pid')->comment('pid работника');
            $table->uuid('isysid')->comment('id информационной системы');
            $table->foreign('pid')->references('pid')->on('ppersons');
            $table->foreign('isysid')->references('isysid')->on('sfrinfosystems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_sfrinfosystems_persons');
    }
};