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
        Schema::create('sfrstorage', function (Blueprint $table) {
            $table->comment('Таблица носителей информации');
            $table->uuid('storuuid')->primary();
            $table->string('stornumber')->comment('Учетный номер');
            $table->date('stordate')->comment('Дата постановки на учет');
            $table->integer('stortype')->comment('Тип носителя (USB-FLASH, USB-HDD, CD-ROM, DVD-RW, DVD-R)');
            $table->integer('stormark')->comment('Метка категории носителя');
            $table->string('storserial')->comment('Заводской или входящий номер');
            $table->integer('storvolume')->comment('Емкость носителя в мегабайтах');
            $table->string('storarrivedfrom')->comment('Откуда поступил');
            $table->date('stordestroydate')->comment('Дата документа о снятии с учета');
            $table->string('stordestroydoc')->comment('Номер документа о снятии с учета');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sfrstorage');
    }
};
