<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      if (!Schema::hasTable('pemployeecontacts')) {
        Schema::create('pemployeecontacts', function (Blueprint $table) {
            $table->uuid('contactid')->primary();
            $table->uuid('pid');
            $table->jsonb('contactdata');
            $table->foreign('pid')->references('pid')->on('ppersons');
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('pemployeecontacts');
    }
};
