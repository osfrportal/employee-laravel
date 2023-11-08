<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sfrdocgroups')) {
            Schema::create('sfrdocgroups', function (Blueprint $table) {
                $table->comment('Группы документов');
                $table->uuid('groupid')->unique();
                $table->string('group_name');
                $table->jsonb('group_data')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sfrdocgroups');
    }
};
