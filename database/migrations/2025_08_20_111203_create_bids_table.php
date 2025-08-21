<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('auction_id')->constrained()->onDelete('cascade');
            $table->decimal('bid_amount', 10, 2);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
