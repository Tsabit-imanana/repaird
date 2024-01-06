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
    Schema::create('devices', function (Blueprint $table) {
        $table->id('device_id');
        $table->unsignedBigInteger('cust_id');
        $table->string('product');
        $table->string('type');
        $table->string('damage');
        $table->timestamps();

        // Menambahkan foreign key constraint
        $table->foreign('cust_id')->references('cust_id')->on('customers')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
