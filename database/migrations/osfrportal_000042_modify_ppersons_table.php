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
        if (Schema::hasTable('ppersons')) {
            Schema::table('ppersons', function (Blueprint $table) {
                $table->date('pworkstart')->nullable();
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
        if (Schema::hasTable('ppersons')) {
            Schema::table('ppersons', function (Blueprint $table) {
                $table->dropColumn('pworkstart');
            });
        }
    }
};
