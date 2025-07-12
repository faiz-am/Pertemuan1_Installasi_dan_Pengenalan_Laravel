<x-layouts.customer :title="$title">
    <div class="bg-white shadow-md rounded-xl p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Selamat Datang, {{ auth('customer')->user()->name }}!</h1>

        <p class="text-gray-600 mb-6">Ini adalah halaman dashboard pelanggan. Kamu bisa melihat produk, pesanan, atau memperbarui profil kamu.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-100 rounded-lg p-4 text-center shadow">
                <h2 class="text-xl font-bold text-blue-700">Produk</h2>
                <p class="text-sm text-blue-600">Lihat semua produk yang tersedia</p>
                <a href="{{ url('/products') }}" class="mt-2 inline-block text-blue-700 font-semibold hover:underline">Lihat Produk</a>
            </div>

            <div class="bg-green-100 rounded-lg p-4 text-center shadow">
                <h2 class="text-xl font-bold text-green-700">Keranjang</h2>
                <p class="text-sm text-green-600">Lihat atau ubah isi keranjang kamu</p>
                <a href="{{ route('cart.index') }}" class="mt-2 inline-block text-green-700 font-semibold hover:underline">Ke Keranjang</a>
            </div>

            <div class="bg-yellow-100 rounded-lg p-4 text-center shadow">
                <h2 class="text-xl font-bold text-yellow-700">Pesanan</h2>
                <p class="text-sm text-yellow-600">Lacak riwayat pembelian kamu</p>
                <a href="#" class="mt-2 inline-block text-yellow-700 font-semibold hover:underline">Lihat Pesanan</a>
            </div>
        </div>
    </div>
</x-layouts.customer>
