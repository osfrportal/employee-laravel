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
        Schema::create('sfrchangelog', function (Blueprint $table) {
            $table->comment('Таблица Changelog');
            $table->uuid('id')->primary();
            $table->integer('log_type')->comment('Тип записи');
            $table->text('log_data')->comment('текст изменений');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sfrchangelog');
    }
};
