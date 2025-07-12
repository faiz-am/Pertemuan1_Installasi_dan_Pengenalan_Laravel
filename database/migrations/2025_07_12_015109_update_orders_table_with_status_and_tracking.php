
<?php

// database/migrations/xxxx_xx_xx_update_orders_table_with_tracking_only.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            // Tambahkan hanya kolom baru
            $table->string('tracking_number')->nullable();
        });

        // Ubah enum status (tidak bisa langsung di Laravel, perlu raw SQL di MySQL)
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'accepted', 'processing', 'shipped', 'completed', 'cancelled') DEFAULT 'pending'");
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('tracking_number');
        });

        // Kembalikan enum status ke sebelumnya
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending'");
    }
};
