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
            $table->id();
            $table->string('user_name');
            $table->string('user_address');
            $table->string('user_phone');
            $table->string('track_number');
            $table->bigInteger('order_status_id')->unsigned();
            $table->bigInteger('delivery_id')->unsigned();
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('delivery_id')->references('id')->on('deliveries');

            $table->timestamps();
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
