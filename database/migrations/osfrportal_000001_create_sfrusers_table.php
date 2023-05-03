<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sfrusers', function (Blueprint $table) {
            $table->uuid('userid')->primary();
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->uuid('pid');
            $table->foreign('pid')->references('pid')->on('ppersons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfrusers');
    }
};
