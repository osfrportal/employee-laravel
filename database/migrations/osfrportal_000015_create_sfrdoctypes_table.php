<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('sfrdoctypes')) {
            Schema::create('sfrdoctypes', function (Blueprint $table) {
                $table->comment('Типы документов');
                $table->uuid('typeid')->unique();
                $table->string('type_name');
                $table->jsonb('type_data');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sfrdoctypes');
    }
};
