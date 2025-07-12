{{-- resources/views/dashboard/home/category_by_slug.blade.php --}}
<x-layouts.customer :title="$category->name">
    <div class="container py-5">
        <h2 class="mb-4">Kategori: {{ $category->name }}</h2>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-success btn-sm w-100">+ Keranjang</button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.customer>
