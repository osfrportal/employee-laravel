<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('orionentrypoints')) {
            Schema::create('orionentrypoints', function (Blueprint $table) {
                $table->comment('Точки доступа ОрионПРО');
                $table->id();
                $table->integer('entrypointid')->unique();
                $table->jsonb('tentrypointdata')->comment('TEntryPointData');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('orionentrypoints');
    }
};
