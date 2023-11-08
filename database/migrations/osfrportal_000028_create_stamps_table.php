<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('stamps')) {
            Schema::create('stamps', function (Blueprint $table) {
                $table->comment('Перечень металлических печатей');
                $table->uuid('stampid')->primary();
                $table->string('stampnumber', 50)->comment('Номер');
                $table->string('stampdescription')->nullable()->comment('Описание');
                $table->date('stampdestruct_at')->nullable()->comment('Уничтожение');
                $table->string('stampdestructdoc')->nullable()->comment('Реквизиты документа об уничтожении');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        if (!Schema::hasTable('stamps_journal')) {
            Schema::create('stamps_journal', function (Blueprint $table) {
                $table->comment('Журнал приема выдачи металлических печатей');
                $table->uuid('stampjournalid')->primary();
                $table->uuid('stampid')->comment('ID печати');
                $table->uuid('pid')->comment('ID работника');
                $table->date('stampjissue_at')->comment('Выдача');
                $table->date('stampjreturn_at')->nullable()->comment('Возврат');
                $table->string('stampjpapernumber')->nullable()->comment('Номер в бумажном журнале');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('stampid')->references('stampid')->on('stamps');
                $table->foreign('pid')->references('pid')->on('ppersons');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('stamps_journal');
        Schema::dropIfExists('stamps');
    }
};
