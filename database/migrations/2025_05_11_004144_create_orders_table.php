<?php

// database/migrations/xxxx_xx_xx_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->date('order_date');
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
