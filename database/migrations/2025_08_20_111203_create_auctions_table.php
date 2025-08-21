<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
    $table->id();
    $table->string('item_name');
    $table->text('description')->nullable();
    $table->decimal('starting_price', 10, 2);
    $table->decimal('current_price', 10, 2)->nullable();
    $table->dateTime('start_time');
    $table->dateTime('end_time');
    $table->enum('status', ['active', 'closed'])->default('active');
    $table->dateTime('created_at')->nullable();
    $table->dateTime('updated_at')->nullable();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
