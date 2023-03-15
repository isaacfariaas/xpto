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
        Schema::create('tb_users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('name')->nullable();
            $table->string('cpf', 11)->unique()->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('nationality')->nullable();
            $table->string('responsible')->nullable();
            $table->string('kinship_level')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('terms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_users');
    }
};
