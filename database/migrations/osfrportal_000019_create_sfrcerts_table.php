<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sfrcerts', function (Blueprint $table) {
            $table->comment('Таблица сертификатов УКЭП и УНЭП выпущенных СФР');
            $table->uuid('certuuid')->primary();
            $table->string('certserial', 255)->nullable();
            $table->dateTime('certvalidfrom');
            $table->dateTime('certvalidto');
            $table->jsonb('certdata');
            $table->integer('certtype');
            $table->uuid('pid')->nullable();
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
        Schema::dropIfExists('sfrcerts');
    }
};
