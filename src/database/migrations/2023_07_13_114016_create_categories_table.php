<?php

use App\Enums\CategoryStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->bigInteger('parent_id')->nullable();
            $table->boolean('status')->default(CategoryStatusEnum::ACTIVE->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
