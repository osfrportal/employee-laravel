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
        if (Schema::hasTable('sfrlogs')) {
            $sql_statement = sprintf('ALTER TABLE %s ALTER context TYPE JSON USING context::json;','sfrlogs');
            //DB::statement($sql_statement);
            Schema::table('sfrlogs', function (Blueprint $table) {
                $table->json('context')->nullable()->change();
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
        if (Schema::hasTable('sfrlogs')) {
            Schema::table('sfrlogs', function (Blueprint $table) {
                $table->longText('context')->nullable()->change();
            });
        }
    }
};
