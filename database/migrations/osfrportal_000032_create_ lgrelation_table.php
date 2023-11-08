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
        Schema::create('lgrelation', function (Blueprint $table) {
            $table->comment('Таблица отношений ссылок на ресурсы СФР и групп');
            $table->id('lgrelid');
            $table->bigInteger('linkid');
            $table->bigInteger('grlid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lgrelation');
    }
};