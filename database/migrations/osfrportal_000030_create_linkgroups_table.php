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
        Schema::create('linkgroups', function (Blueprint $table) {
            $table->comment('Таблица групп для ссылок на ресурсы СФР');
            $table->id('grlid');
            $table->string('grlname');
            $table->smallInteger('grlsortorder')->nullable();
            $table->bigInteger('grlparentid')->nullable();
            $table->boolean('grlcollapsed')->default('0');
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
        Schema::dropIfExists('linkgroups');
    }
};