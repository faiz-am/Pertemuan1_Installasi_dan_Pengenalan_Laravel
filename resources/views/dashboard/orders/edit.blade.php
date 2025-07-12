<x-layouts.app title="Edit Pesanan">
    <div class="max-w-xl mx-auto py-10">
        <h1 class="text-xl font-bold mb-4">Edit Pesanan #{{ $order->id }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul class="list-disc pl-5 text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('orders.update', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Status</label>
                <select name="status" class="form-control">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ $order->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Nomor Resi (Tracking Number)</label>
                <input type="text" name="tracking_number" class="form-control"
                       value="{{ old('tracking_number', $order->tracking_number) }}">
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</x-layouts.app>
