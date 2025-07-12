<x-layouts.customer :title="$title">
    <div class="container py-5">
        <h2 class="mb-4">Semua Produk</h2>

        <div class="row row-cols-2 row-cols-md-4 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-outline-dark mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.customer>
