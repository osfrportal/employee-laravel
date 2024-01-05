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
        Schema::create('sfrstoragejournalcheck', function (Blueprint $table) {
            $table->comment('Журнал ежегодных проверок');
            $table->id();
            $table->uuid('storuuid')->comment('ИД носителя информации');
            $table->uuid('pid')->comment('UUID работника, проводившего ежегодную проверку');
            $table->date('checkdate')->comment('Дата проверки');
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
        Schema::dropIfExists('sfrstoragejournalcheck');
    }
};
