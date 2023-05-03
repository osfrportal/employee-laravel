<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['notifiable_id']);
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->uuid('notifiable_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['notifiable_id', 'notifiable_type']);
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->morphs('notifiable');
        });

    }
};
