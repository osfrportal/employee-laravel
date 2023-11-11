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
        Schema::create('sfrinfosystems_roles', function (Blueprint $table) {
            $table->comment('Таблица ролей информационных систем ОСФР по Липецкой области');
            $table->uuid('iroleid')->primary()->comment('id роли');
            $table->string('irole_name')->nullable(false);
            $table->jsonb('irole_data')->nullable();
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
        Schema::dropIfExists('sfrinfosystems_roles');
    }
};