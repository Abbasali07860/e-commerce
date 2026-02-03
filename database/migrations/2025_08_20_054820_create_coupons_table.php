<?php
    
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent']); // fixed = ₹ amount, percent = %
            $table->decimal('value', 8, 2);
            $table->timestamp('expires_at')->nullable();
            $table->boolean('status')->default(1); // 1 = active
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('coupons');
    }
};

