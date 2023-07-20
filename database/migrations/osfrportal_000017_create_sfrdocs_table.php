<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('sfrdocs')) {
            Schema::create('sfrdocs', function (Blueprint $table) {
                $table->comment('Документы');
                $table->uuid('docid')->unique();
                $table->string('doc_name');
                $table->string('doc_number');
                $table->date('doc_date');
                $table->uuid('doc_typeid');
                $table->uuid('doc_groupid');
                $table->jsonb('doc_data');
                $table->timestamps();
                $table->foreign('doc_typeid')->references('typeid')->on('sfrdoctypes');
                $table->foreign('doc_groupid')->references('groupid')->on('sfrdocgroups');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sfrdocs');
    }
};
