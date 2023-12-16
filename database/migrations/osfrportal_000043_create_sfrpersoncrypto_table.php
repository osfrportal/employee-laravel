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
        Schema::create('sfrpersoncrypto', function (Blueprint $table) {
            $table->comment('Таблица криптосредств пользователей');
            $table->uuid('cryptouuid')->primary();
            $table->jsonb('cryptodata');
            $table->integer('cryptotype');
            $table->string('cryptoapid', 25)->nullable();
            $table->uuid('pid')->nullable();
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
        Schema::dropIfExists('sfrpersoncrypto');
    }
};
