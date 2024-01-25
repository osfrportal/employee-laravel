<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('pemployeedekret')) {
            Schema::table('pemployeedekret', function (Blueprint $table) {
                $table->id();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('pemployeedekret')) {
            Schema::table('pemployeedekret', function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }
    }
};
