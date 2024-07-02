<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('organogram_ids')->nullable();
            $table->unsignedBigInteger('role_group_id')->comment('FK = role_groups.id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 50)->nullable();
            $table->string('image', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        DB::table('users')->insert(
            [
                'id' => 1,
                'organization_id' => 21,
                'organogram_ids' => 33,
                'role_group_id' => 44,
                'name' => 'Md. Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => null,
                'phone' => '01722707693',
                'image' => null,
                'password' => '$2y$10$QA2tpIzuEbbRf//TxfSj.OkRg4.4k/PiLI8TE2IpNBqJuC9A9nZH6',
                'remember_token' => null,
                'created_at' => '2020-10-14 17:38:27',
                'updated_at' => '2020-10-14 17:38:27'
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
