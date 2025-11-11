<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        // Convert 'users' table to use UUIDs
        Schema::create('users_new', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default('user')->nullable();
            $table->timestamps();
        });

        DB::table('users')->get()->each(function ($user) {
            DB::table('users_new')->insert([
                'id' => (string) Str::uuid(),
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        });

        Schema::drop('users');
        Schema::rename('users_new', 'users');

        // Convert 'social_accounts' table to use UUIDs
        Schema::create('social_accounts_new', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('provider_name');
            $table->string('provider_id')->unique();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        DB::table('social_accounts')->get()->each(function ($socialAccount) {
            $user = DB::table('users')->where('id', $socialAccount->user_id)->first();
            if ($user) {
                DB::table('social_accounts_new')->insert([
                    'id' => (string) Str::uuid(),
                    'user_id' => $user->id, // Use the new UUID from the users table
                    'provider_name' => $socialAccount->provider_name,
                    'provider_id' => $socialAccount->provider_id,
                    'access_token' => $socialAccount->access_token,
                    'refresh_token' => $socialAccount->refresh_token,
                    'created_at' => $socialAccount->created_at,
                    'updated_at' => $socialAccount->updated_at,
                ]);
            }
        });

        Schema::drop('social_accounts');
        Schema::rename('social_accounts_new', 'social_accounts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert 'social_accounts' table to use bigIncrements
        Schema::create('social_accounts_old', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('provider_name');
            $table->string('provider_id')->unique();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->timestamps();
        });

        DB::table('social_accounts')->get()->each(function ($socialAccount) {
            DB::table('social_accounts_old')->insert([
                'id' => $socialAccount->id, // This will be a UUID, but we're inserting into an auto-increment column
                'user_id' => $socialAccount->user_id,
                'provider_name' => $socialAccount->provider_name,
                'provider_id' => $socialAccount->provider_id,
                'access_token' => $socialAccount->access_token,
                'refresh_token' => $socialAccount->refresh_token,
                'created_at' => $socialAccount->created_at,
                'updated_at' => $socialAccount->updated_at,
            ]);
        });

        Schema::drop('social_accounts');
        Schema::rename('social_accounts_old', 'social_accounts');

        // Revert 'users' table to use bigIncrements
        Schema::create('users_old', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default('user')->nullable();
            $table->timestamps();
        });

        DB::table('users')->get()->each(function ($user) {
            DB::table('users_old')->insert([
                'id' => $user->id, // This will be a UUID, but we're inserting into an auto-increment column
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        });

        Schema::drop('users');
        Schema::rename('users_old', 'users');

        Schema::table('social_accounts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
