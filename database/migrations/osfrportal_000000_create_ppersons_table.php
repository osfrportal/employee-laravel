<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      if (!Schema::hasTable('ppersons')) {
        Schema::create('ppersons', function (Blueprint $table) {
            $table->uuid('pid')->primary();
            $table->string('psurname',50)->nullable();
            $table->string('pname',50)->nullable();
            $table->string('pmiddlename',50)->nullable();
            $table->date('pbirthdate')->nullable();
            $table->string('pinn',15)->nullable();
            $table->string('psnils',50)->nullable();
            $table->timestamp('pcreatedon');
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('ppersons');
    }
};
