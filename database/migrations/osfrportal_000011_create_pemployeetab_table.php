<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pemployeetab')) {
            Schema::create('pemployeetab', function (Blueprint $table) {
                $table->comment('Табельные номера работника.');
                $table->id();
                $table->uuid('pid');
                $table->string('etabnumber',255);
                $table->timestamps();
                $table->foreign('pid')->references('pid')->on('ppersons');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pemployeetab');
    }
};
