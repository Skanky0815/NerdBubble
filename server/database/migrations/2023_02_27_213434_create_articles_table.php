<?php

declare(strict_types=1);

use App\Models\ProviderType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('title')->nullable(false);
            $table->string('subTitle')->nullable();
            $table->text('description')->nullable();
            $table->enum('provider', ProviderType::getAllValues())->nullable(false);
            $table->string('link')->nullable(false);
            $table->date('date')->nullable(false);
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
