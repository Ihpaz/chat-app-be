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
        Schema::table('user_chat_rooms', function (Blueprint $table) {
            $table->boolean('is_rejected')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_chat_rooms', function (Blueprint $table) {
            $table->dropColumn('is_rejected');
        });
    }
};
