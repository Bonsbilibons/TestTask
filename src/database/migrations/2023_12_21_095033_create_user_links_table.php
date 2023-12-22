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
        Schema::create('user_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->boolean('status');
            $table->string('link');
            $table->date('expired_at');
            $table->timestamps();

            $table->index(['link']);
            $table->index(['status']);
            $table->index(['status', 'expired_at']);
            $table->index(['user_id', 'status']);
            $table->index(['link', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_links');
    }
};
