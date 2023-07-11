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
        Schema::create('sfrconfig', function (Blueprint $table) {
            $table->comment('Таблица конфигурационных параметров');
            $table->uuid('configid')->primary();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->string('description')->nullable();
            $table->boolean('crypted')->default(false);
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
        Schema::dropIfExists('sfrconfig');
    }
};
