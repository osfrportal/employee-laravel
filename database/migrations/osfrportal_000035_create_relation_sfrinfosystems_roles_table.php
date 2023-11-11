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
        Schema::create('relation_sfrinfosystems_roles', function (Blueprint $table) {
            $table->comment('Таблица отношений информационных систем ОСФР по Липецкой области к ролям');
            $table->id();
            $table->timestamps();
            $table->uuid('iroleid')->comment('id роли');
            $table->uuid('isysid')->comment('id информационной системы');
            $table->foreign('isysid')->references('isysid')->on('sfrinfosystems');
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
        Schema::dropIfExists('relation_sfrinfosystems_roles');
    }
};