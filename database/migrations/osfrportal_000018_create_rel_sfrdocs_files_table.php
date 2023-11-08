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
        Schema::create('rel_sfrdocs_files', function (Blueprint $table) {
            $table->comment('Таблица отношений документов и файлов');
            $table->id();
            $table->timestamps();
            $table->uuid('docid')->comment('id документа');
            $table->uuid('fileid')->comment('id файла');
            $table->foreign('docid')->references('docid')->on('sfrdocs');
            $table->foreign('fileid')->references('fileid')->on('sfrfiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_sfrdocs_files');
    }
};