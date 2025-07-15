<x-layouts.customer :title="$title">
    <div class="bg-white shadow-md rounded-xl p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Detail Pesanan #{{ $order->id }}</h1>

        <div class="mb-6">
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Resi Pengiriman:</strong> {{ $order->tracking_number ?? 'Belum dikirim' }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Produk</th>
                        <th class="px-4 py-2 text-right">Harga</th>
                        <th class="px-4 py-2 text-center">Qty</th>
                        <th class="px-4 py-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item->product->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-right">Rp{{ number_format($item->price) }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 text-right">Rp{{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 border-t">
                        <td colspan="3" class="px-4 py-2 text-right font-bold">Total:</td>
                        <td class="px-4 py-2 text-right font-bold">
                            Rp{{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity)) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('customer.orders.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Riwayat Pesanan</a>
        </div>
    </div>
</x-layouts.customer>
