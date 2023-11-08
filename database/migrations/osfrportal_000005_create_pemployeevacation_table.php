<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pemployeevacation')) {
            Schema::create('pemployeevacation', function (Blueprint $table) {
                $table->uuid('pid');
                $table->date('vacationstart');
                $table->date('vacationend');
                $table->foreign('pid')->references('pid')->on('ppersons');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pemployeevacation');
    }
};
