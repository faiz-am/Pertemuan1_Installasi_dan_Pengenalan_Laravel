{{-- resources/views/dashboard/home/product.blade.php --}}
<x-layouts.customer :title="$product->name">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400' }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold">{{ $product->name }}</h1>
                <h4 class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                <p class="mt-3">{{ $product->description }}</p>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>

        <hr class="my-5">

        <h3>Produk Terkait</h3>
        <div class="row">
            @foreach ($relatedProducts as $related)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ $related->image_url ?? 'https://via.placeholder.com/200' }}" class="card-img-top" alt="{{ $related->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $related->name }}</h5>
                            <p class="card-text text-success">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.show', $related->slug) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.customer>
