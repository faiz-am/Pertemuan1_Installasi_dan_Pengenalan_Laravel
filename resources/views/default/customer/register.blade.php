<x-layouts.customer :title="'Register'">
    <div class="container py-5">
        <h2>Register Customer</h2>
        <form method="POST" action="{{ route('customer.store_register') }}" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label for="name">Nama</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control" 
                    value="{{ old('name') }}" 
                    required 
                    autocomplete="name"
                >
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="email"
                >
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control" 
                    required 
                    autocomplete="new-password"
                >
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="form-control" 
                    required 
                    autocomplete="new-password"
                >
            </div>

            <button class="btn btn-success">Daftar</button>
        </form>
    </div>
</x-layouts.customer>
