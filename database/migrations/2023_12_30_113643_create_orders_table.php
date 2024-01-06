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
    Schema::create('orders', function (Blueprint $table) {
        $table->id('orders_id');
        $table->unsignedBigInteger('cust_id');
        $table->unsignedBigInteger('device_id');
        $table->string('condition');
        $table->date('date');
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('status');
        $table->bigInteger('price');
        $table->timestamps();

        // Menambahkan foreign key constraints
        $table->foreign('cust_id')->references('cust_id')->on('customers')->onDelete('cascade');
        $table->foreign('device_id')->references('device_id')->on('devices')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
