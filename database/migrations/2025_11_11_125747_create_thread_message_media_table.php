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
        Schema::create('thread_message_media', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('thread_message_id');
            $table->string('file_path');
            $table->string('file_type');
            $table->timestamps();

            $table->foreign('thread_message_id')->references('id')->on('thread_messages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_message_media');
    }
};
