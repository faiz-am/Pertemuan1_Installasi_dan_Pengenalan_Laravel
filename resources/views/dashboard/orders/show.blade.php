<x-layouts.app title="Detail Pesanan">
    <div class="space-y-6">
        <hr class="my-6">

<h2 class="text-xl font-semibold mb-2">Ubah Status Pesanan</h2>

<form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
            <option value="accepted" {{ $order->status === 'accepted' ? 'selected' : '' }}>Pesanan Diterima</option>
            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Sedang Dikirim</option>
        </select>
    </div>

    <div id="trackingInput" style="{{ $order->status === 'shipped' ? '' : 'display: none;' }}">
        <label for="tracking_number" class="block text-sm font-medium text-gray-700">Nomor Resi</label>
        <input type="text" name="tracking_number" id="tracking_number" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"
            value="{{ $order->tracking_number }}">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
</form>
<script>
    document.getElementById('status').addEventListener('change', function () {
        const trackingInput = document.getElementById('trackingInput');
        if (this.value === 'shipped') {
            trackingInput.style.display = 'block';
        } else {
            trackingInput.style.display = 'none';
        }
    });
</script>

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
