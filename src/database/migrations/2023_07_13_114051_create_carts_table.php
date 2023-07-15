<?php

use App\Enums\CartStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', static function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(0);
            $table->float('total_amount')->default(0);
            $table->boolean('status')->default(CartStatus::ACTIVE->value);
            $table->foreignIdFor(User::class);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
