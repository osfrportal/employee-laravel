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
        Schema::create('relation_sfrinfosystems_roles_persons', function (Blueprint $table) {
            $table->comment('Таблица отношений работников ОСФР по Липецкой области к ролям информационных системам');
            $table->id();
            $table->timestamps();
            $table->uuid('pid')->comment('pid работника');
            $table->uuid('iroleid')->comment('id роли информационной системы');
            $table->foreign('pid')->references('pid')->on('ppersons');
            $table->foreign('iroleid')->references('iroleid')->on('sfrinfosystems_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_sfrinfosystems_roles_persons');
    }
};