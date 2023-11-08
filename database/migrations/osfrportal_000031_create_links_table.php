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
        Schema::create('links', function (Blueprint $table) {
            $table->comment('Таблица ссылок на ресурсы СФР');
            $table->id('linkid');
            $table->string('linkname');
            $table->string('linkurl');
            $table->boolean('linkshowinleftmenu')->default('0');
            $table->unsignedSmallInteger('linksortorder')->default('9999');
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
        Schema::dropIfExists('links');
    }
};