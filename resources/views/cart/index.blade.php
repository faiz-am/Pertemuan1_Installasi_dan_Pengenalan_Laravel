{{-- resources/views/cart/index.blade.php --}}
<x-layouts.customer title="Keranjang Belanja">
    <div class="container py-5">
        <h2 class="mb-4">Keranjang Belanja</h2>

        @if($cart && $cart->items->count())
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $item)
                        <tr>
                            <td>{{ $item->itemable->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->itemable->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->itemable->price * $item->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-success">Checkout</button>
            </form>
        @else
            <p>Keranjang Anda kosong.</p>
        @endif
    </div>
</x-layouts.customer>
