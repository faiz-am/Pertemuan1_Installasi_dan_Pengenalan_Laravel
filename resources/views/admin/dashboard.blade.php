{{-- resources/views/admin/dashboard.blade.php --}}
<x-layouts.app :title="$title">
    <div class="container py-5">
        <h1 class="mb-4">Selamat Datang Admin 👋</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">Produk</h5>
                        <p class="card-text">Kelola semua produk di toko Anda.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
            </div>
            <!-- Tambahkan lagi card lainnya jika perlu -->
        </div>
    </div>
</x-layouts.app>
