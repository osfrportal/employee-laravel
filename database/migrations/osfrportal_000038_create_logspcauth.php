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
        if (!Schema::hasTable('logspcauth')) {
            Schema::create('logspcauth', function (Blueprint $table) {
                $table->uuid('lpcid')->primary();
                $table->ipAddress('ipaddr');
                $table->string('domainlogin', 25);
                $table->timestamp('created_at')->useCurrent();
            });
            //DB::statement('ALTER TABLE logspcauth ALTER COLUMN lpcid SET DEFAULT uuid_generate_v4();');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logspcauth');
    }
};