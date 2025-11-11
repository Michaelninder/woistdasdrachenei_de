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
        Schema::table('social_accounts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->after('id');
            $table->dropColumn('id');
            $table->renameColumn('uuid', 'id');
            $table->primary('id');
        });

        Schema::table('social_accounts', function (Blueprint $table) {
            $table->uuid('uuid')->after('id');
            $table->dropColumn('id');
            $table->renameColumn('uuid', 'id');
            $table->primary('id');
            $table->uuid('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_accounts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->dropColumn('uuid');
        });

        Schema::table('social_accounts', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->dropColumn('uuid');
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
