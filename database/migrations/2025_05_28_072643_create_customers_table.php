<?php

// database/migrations/xxxx_xx_xx_create_customers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration {
    public function up() {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->text('address')->nullable();
            $table->timestamps(); // created_at & updated_at nullable by default
        });
    }

    public function down() {
        Schema::dropIfExists('customers');
    }
}
