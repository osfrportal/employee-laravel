<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('pemployeeaddata')) {
            Schema::create('pemployeeaddata', function (Blueprint $table) {
                $table->comment('Соответствие id работника и guid домена');
                $table->id();
                $table->uuid('pid');
                $table->uuid('adguid');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('pid')->references('pid')->on('ppersons');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pemployeeaddata');
    }
};
