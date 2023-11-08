<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
      if (!Schema::hasTable('crls')) {
        Schema::create('crls', function (Blueprint $table) {
            $table->string('revokeserial', 255)->nullable();
            $table->timestamp('revokedate');
            $table->timestamps();
        });
      }
    }

    public function down()
    {
        Schema::dropIfExists('crls');
    }
};
