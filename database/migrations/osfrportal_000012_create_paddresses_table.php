<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('paddresses')) {
            Schema::create('paddresses', function (Blueprint $table) {
                $table->comment('Адреса');
                $table->uuid('addrid')->primary();
                $table->string('paddress', 50);
                $table->string('areacode', 5)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('paddresses');
    }
};