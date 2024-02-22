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
<<<<<<< Updated upstream:database/migrations/2024_01_25_120027_authors.php
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('name',128);
=======
        Schema::create('LinkMinimizer', function (Blueprint $table) {
            $table->id();
            $table->string('link')->unique();
            $table->string('signature')->unique();
>>>>>>> Stashed changes:database/migrations/2024_02_11_114526_link_minimizer.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< Updated upstream:database/migrations/2024_01_25_120027_authors.php
        Schema::dropIfExists('authors');
=======

    Schema::dropIfExists('LinkMinimizer');
>>>>>>> Stashed changes:database/migrations/2024_02_11_114526_link_minimizer.php
    }
};
