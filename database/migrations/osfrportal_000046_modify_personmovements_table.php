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
        if (Schema::hasTable('personmovements')) {
            Schema::table('personmovements', function (Blueprint $table) {
                $table->integer('movementtype');
                $table->date('movementeventdate');
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
        if (Schema::hasTable('personmovements')) {
            Schema::table('personmovements', function (Blueprint $table) {
                $table->dropColumn('movementtype');
                $table->dropColumn('movementeventdate');
            });
        }
    }
};
