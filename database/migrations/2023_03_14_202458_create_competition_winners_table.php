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
        Schema::create('competition_winners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_competition');
            $table->unsignedBigInteger('id_subscribe');
            $table->timestamps();

            $table->foreign('id_competition')->references('id')->on('competitions')->onDelete('cascade');
            $table->foreign('id_subscribe')->references('id')->on('competition_subscribes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_winners');
    }
};
