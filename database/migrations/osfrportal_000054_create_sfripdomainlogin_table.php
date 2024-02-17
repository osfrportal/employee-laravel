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
        Schema::create('sfripdomainlogin', function (Blueprint $table) {
            $table->comment('Логи входа пользователей на ПК');
            $table->id();
            $table->ipAddress('ipaddr')->comment('IP пользователя');
            $table->string('domainlogin', 25)->comment('Доменный логин пользователя');
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
        Schema::dropIfExists('sfripdomainlogin');
    }
};
