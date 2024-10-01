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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->text('banner');
            $table->string('title');
            $table->string('subtitle');
            $table->longText('content');
            $table->string('slug');

            $table->foreignId('user_id')
            ->references('id')
            ->on('users');

            $table->foreignId('category_id')
            ->references('id')
            ->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
