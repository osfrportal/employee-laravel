<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      if (!Schema::hasTable('pemployeedekret')) {
        Schema::create('pemployeedekret', function (Blueprint $table) {
            $table->uuid('pid');
            $table->timestamp('dekretstart');
            $table->timestamp('dekretend');
            $table->foreign('pid')->references('pid')->on('ppersons');
            $table->timestamps();
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('pemployeedekret');
    }
};
