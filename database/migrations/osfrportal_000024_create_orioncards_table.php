<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('orioncards')) {
            Schema::create('orioncards', function (Blueprint $table) {
                $table->comment('карты доступа и пароли в ОрионПРО');
                $table->id();
                $table->integer('keyid')->unique();
                $table->integer('orionpersid');
                $table->integer('accesslevelid');
                $table->jsonb('tkeydata')->comment('TKeyData');
                $table->timestamps();
                $table->foreign('orionpersid')->references('orionpersid')->on('ppersorion');
                $table->foreign('accesslevelid')->references('levelid')->on('orionaccesslevel');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('orioncards');
    }
};
