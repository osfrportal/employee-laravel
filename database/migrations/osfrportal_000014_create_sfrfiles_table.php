<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('sfrfiles')) {
            Schema::create('sfrfiles', function (Blueprint $table) {
                $table->comment('Загруженные файлы');
                $table->uuid('fileid')->unique();
                $table->string('file_name');
                $table->string('file_description');
                $table->string('file_gosthash')->nullable();
                $table->string('file_disk')->nullable();
                $table->boolean('file_enabled')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sfrfiles');
    }
};
