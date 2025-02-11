<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fcm_token')->nullable()->after('remember_token');
        });

        Schema::table('chat_rooms', function (Blueprint $table) {
            $table->string('topic')->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fcm_token');
        });

        Schema::table('chat_rooms', function (Blueprint $table) {
            $table->dropColumn('topic');
        });
    }
};
