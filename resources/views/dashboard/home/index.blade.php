<x-layouts.customer :title="$title">
    {{-- Hero Banner --}}
    <div class="container-fluid bg-light py-5 text-center">
        <h1 class="display-4 fw-bold">Selamat Datang di Toko Kami</h1>
        <p class="lead">Temukan berbagai produk terbaik untuk kebutuhan Anda</p>
        <a href="{{ url('products') }}" class="btn btn-primary btn-lg mt-3">Lihat Semua Produk</a>
    </div>

    <div class="container py-5">
        {{-- Kategori --}}
        <h2 class="mb-4">Kategori Populer</h2>
        <div class="row row-cols-2 row-cols-md-4 g-4 mb-5">
            @forelse($categories as $category)
                <div class="col">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="{{ url('category/'.$category->slug) }}" class="btn btn-outline-primary btn-sm mt-2">Lihat Kategori</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada kategori.</p>
            @endforelse
        </div>

        {{-- Produk Terbaru --}}
        <h2 class="mb-4">Produk Terbaru</h2>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @forelse($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200?text=Product+Image' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-primary fw-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-outline-dark mt-auto">Detail Produk</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada produk tersedia.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.customer>
