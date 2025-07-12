<x-layouts.app title="Detail Pesanan">
    <div class="space-y-6">
        <h1 class="text-2xl font-bold mb-4">Detail Pesanan #{{ $order->id }}</h1>

        <div>
            <p><strong>Pelanggan:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Total:</strong> Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
        </div>

        <hr>

        <h2 class="text-xl font-semibold mt-4">Item Pesanan</h2>
        <table class="table-auto w-full mt-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Produk</th>
                    <th class="px-4 py-2 text-left">Jumlah</th>
                    <th class="px-4 py-2 text-left">Harga Satuan</th>
                    <th class="px-4 py-2 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $detail)
                    <tr>
                        <td class="px-4 py-2">{{ $detail->product->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $detail->quantity }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($detail->unit_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
