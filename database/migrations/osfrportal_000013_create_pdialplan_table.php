<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('pdialplan')) {
            Schema::create('pdialplan', function (Blueprint $table) {
                $table->comment('DialPlan соответствие начального и конечного номера из диапазона адресу');
                $table->uuid('dpid');
                $table->unsignedSmallInteger('dpnumstart');
                $table->unsignedSmallInteger('dpnumend');
                $table->uuid('addrid');
                $table->timestamps();
                $table->foreign('addrid')->references('addrid')->on('paddresses');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pdialplan');
    }
};
