<x-layouts.app title="Daftar Pesanan">
    <div class="space-y-6">
        <h1 class="text-2xl font-bold">Pesanan Masuk</h1>

        <div class="overflow-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Item</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-800">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order['order_id'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order['customer_name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order['items_count'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp{{ number_format($order['total_amount'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ucfirst(str_replace('_', ' ', $order['status'] ?? 'pending')) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
    {{ \Carbon\Carbon::parse($order['created_at'])->translatedFormat('d M Y') }}
</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('orders.show', $order['order_id']) }}" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
