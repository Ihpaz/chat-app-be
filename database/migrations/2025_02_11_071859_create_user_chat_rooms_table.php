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
        Schema::create('user_chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid")->nullable()->index();
            $table->bigInteger("user_id")->nullable()->unsigned()->index();
            $table->bigInteger("chat_room_id")->nullable()->unsigned()->index();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_chat_rooms');
    }
};
