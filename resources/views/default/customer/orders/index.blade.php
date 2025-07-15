<x-layouts.customer :title="$title">
    <div class="bg-white shadow-md rounded-xl p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Riwayat Pesanan</h1>

        @forelse ($orders as $order)
            <div class="border border-gray-200 rounded-lg p-4 mb-4">
                <h2 class="text-lg font-bold text-gray-700">Pesanan #{{ $order->id }}</h2>
                <p class="text-sm text-gray-600">Tanggal: {{ $order->created_at->format('d M Y') }}</p>
                <p class="text-sm text-gray-600">Status: <strong>{{ ucfirst($order->status) }}</strong></p>
                <p class="text-sm text-gray-600">Resi: {{ $order->tracking_number ?? 'Belum dikirim' }}</p>
                <p class="text-sm text-gray-600">
                    Total: <strong>Rp{{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity)) }}</strong>
                </p>
                <a href="{{ route('customer.orders.show', $order->id) }}" class="text-blue-600 hover:underline text-sm mt-2 inline-block">Lihat Detail</a>
            </div>
        @empty
            <p class="text-gray-500">Kamu belum memiliki pesanan.</p>
        @endforelse
    </div>
</x-layouts.customer>
