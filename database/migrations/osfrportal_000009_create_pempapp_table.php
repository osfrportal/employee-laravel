<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pempapp')) {
            Schema::create('pempapp', function (Blueprint $table) {
                $table->comment('Соответствие id должности и id работника');
                $table->id();
                $table->uuid('pid');
                $table->uuid('aid');
                $table->timestamps();
                $table->foreign('pid')->references('pid')->on('ppersons');
                $table->foreign('aid')->references('aid')->on('pappointment');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pempapp');
    }
};
