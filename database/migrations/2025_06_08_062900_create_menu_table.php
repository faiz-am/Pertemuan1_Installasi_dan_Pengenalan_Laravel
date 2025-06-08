<?php

// database/migrations/xxxx_xx_xx_create_menu_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu_text');
            $table->string('menu_icon')->nullable();
            $table->string('menu_url');
            $table->integer('menu_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
