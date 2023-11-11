<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      if (!Schema::hasTable('punits')) {
        Schema::create('punits', function (Blueprint $table) {
            $table->uuid('unitid')->primary();
            $table->string('unitname',255);
            $table->string('unitnameshort',255)->nullable();
            $table->string('unitcode',10);
            $table->uuid('unitparentid')->nullable();
            $table->smallInteger('unitsortorder')->default(9999);
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('punits');
    }
};
