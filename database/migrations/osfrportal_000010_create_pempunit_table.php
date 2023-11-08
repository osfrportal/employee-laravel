<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pempunit')) {
            Schema::create('pempunit', function (Blueprint $table) {
                $table->comment('Соответствие id подразделения и id работника.');
                $table->id();
                $table->uuid('pid');
                $table->uuid('unitid');
                $table->timestamps();
                $table->foreign('pid')->references('pid')->on('ppersons');
                $table->foreign('unitid')->references('unitid')->on('punits');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pempunit');
    }
};
