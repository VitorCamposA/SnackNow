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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount_amount', 8, 2);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->date('valid_from');
            $table->date('valid_until');
            $table->integer('usage_limit')->nullable(); // Max number of times this coupon can be used
            $table->integer('used')->default(0); // Number of times the coupon has been used
            $table->unsignedBigInteger('supplier_id'); // Foreign key for Supplier
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
