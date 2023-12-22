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
        if (Schema::hasTable('sfrdocs')) {
            Schema::table('sfrdocs', function (Blueprint $table) {
                $table->date('doc_date_end')->nullable();
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
        if (Schema::hasTable('sfrdocs')) {
            Schema::table('sfrdocs', function (Blueprint $table) {
                $table->dropColumn('doc_date_end');
            });
        }
    }
};
