<?php

declare(strict_types=1);

use App\Models\ArticleLayout;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
use Domains\Article\ValueObjects\ProviderType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique()->nullable(false);
            $table->string('color', 7)->nullable(false);
            $table->string('logoImage')->nullable(false);
            $table->string('aggregateUrl')->nullable(false);
            $table->boolean('hasProducts')->default(false);
            $table->enum('layout', ArticleLayout::getAllValues())->nullable(false);
            $table->boolean('isActive')->default(false);
            $table->string('articleSelectorWrapper')->nullable(false);
            $table->string('articleSelectorHeadline')->nullable();
            $table->string('articleHeadline')->nullable();
            $table->string('articleSelectorSubHeadline')->nullable();
            $table->string('articleSelectorDescription')->nullable();
            $table->string('articleSelectorImage')->nullable();
            $table->string('articleSelectorDate')->nullable(false);
            $table->string('articleSelectorDateFormat')->nullable(false);
            $table->string('articleSelectorDateLocale')->nullable(false);
            $table->string('articleImage')->nullable();
            $table->string('articleSelectorLink')->nullable();
            $table->string('articleLink')->nullable();

            $table->string('productSelectorWrapper')->nullable();
            $table->string('productSelectorName')->nullable();
            $table->string('productSelectorImage')->nullable();
            $table->string('productSelectorLink')->nullable();
            $table->timestamps();
        });

        if (!Type::hasType('enum')) {
            Type::addType('enum', StringType::class);
        }

        Schema::table('articles', function (Blueprint $table) {
            $table->enum('provider', ProviderType::getAllValues())->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
