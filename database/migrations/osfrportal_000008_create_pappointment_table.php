<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      if (!Schema::hasTable('pappointment')) {
        Schema::create('pappointment', function (Blueprint $table) {
            $table->uuid('aid')->primary();
            $table->string('aname',255);
            $table->string('acode',10)->nullable();
            $table->smallInteger('asortorder')->default(9999);
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('pappointment');
    }
};
