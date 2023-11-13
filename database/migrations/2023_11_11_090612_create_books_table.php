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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->index();;
            $table->string('author')->nullable()->index();;
            $table->string('genre')->nullable();
            $table->text('description')->nullable();
            $table->string('isbn')->unique()->nullable();
            $table->string('image')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('publisher')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
