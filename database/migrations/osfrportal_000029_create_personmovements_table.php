<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('personmovements')) {
            Schema::create('personmovements', function (Blueprint $table) {
                $table->comment('Кадровые перемещения работников');
                $table->uuid('movid')->primary();
                $table->uuid('pid');
                $table->jsonb('movementdata');
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('pid')->references('pid')->on('ppersons');
            });
            DB::statement('CREATE INDEX idx_personmovements_movementdata ON personmovements USING gin(movementdata);');
        }
    }

    public function down()
    {
        Schema::dropIfExists('personmovements');
    }
};