<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('orionaccesslevel')) {
            Schema::create('orionaccesslevel', function (Blueprint $table) {
                $table->comment('Уровни доступа ОрионПРО');
                $table->id();
                $table->integer('levelid')->unique();
                $table->jsonb('taccessleveldata')->comment('TAccessLevelData');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('orionaccesslevel');
    }
};
