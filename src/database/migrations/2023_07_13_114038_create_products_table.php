<?php

use App\Enums\ProductInStockEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10)->default('0.00');
            $table->text('description')->nullable();
            $table->boolean('in_stock')->default(ProductInStockEnum::IN_STOCK->value);
            $table->string('is_active')->default(ProductStatusEnum::ACTIVE->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
