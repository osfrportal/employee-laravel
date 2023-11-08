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
        Schema::create('sfrinfosystems', function (Blueprint $table) {
            $table->comment('Таблица информационных систем ОСФР по Липецкой области');
            $table->uuid('isysid')->primary()->comment('id информационной системы');
            $table->uuid('parent_isysid')->nullable()->comment('id родительской информационной системы');
            $table->string('isys_name')->nullable(false);
            $table->jsonb('isys_data')->nullable()->comment('Расширенные свойства ИС');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sfrinfosystems');
    }
};