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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable(false);
            $table->string('subTitle')->nullable(false);
            $table->enum('newsType', ['ASMODEE'])->nullable(false);
            $table->string('link')->nullable(false);
            $table->string('date')->nullable(false);
            $table->string('image')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
