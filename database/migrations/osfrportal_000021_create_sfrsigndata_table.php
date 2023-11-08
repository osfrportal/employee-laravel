<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('sfrsigratures')) {
            Schema::create('sfrsigratures', function (Blueprint $table) {
                $table->comment('Данные о подписи документов');
                $table->uuid('signid')->unique();
                $table->uuid('sign_docid');
                $table->uuid('sign_fileid');
                $table->uuid('sign_pid');
                $table->integer('sign_type')->comment('Тип подписи - УКЭП, УНЭП');
                $table->text('sign_data')->comment('Подписанные данные');
                $table->timestamps();
                $table->foreign('sign_docid')->references('docid')->on('sfrdocs');
                $table->foreign('sign_fileid')->references('fileid')->on('sfrfiles');
                $table->foreign('sign_pid')->references('pid')->on('ppersons');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sfrsigratures');
    }
};
