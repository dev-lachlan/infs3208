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
        Schema::create('account_usernames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('platform');
            $table->string('username');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE account_usernames ADD CONSTRAINT chk_platform CHECK (platform in ('PSN','XBOX','STEAM','DISCORD','BATTLENET'));");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_usernames');

        DB::statement("ALTER TABLE account_usernames DROP CONSTRAINT chk_platform;");
    }
};
