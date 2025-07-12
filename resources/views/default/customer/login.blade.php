<x-layouts.customer :title="'Login'">
    <div class="container py-5">
        <h2>Login Customer</h2>
        <form method="POST" action="{{ route('customer.store_login') }}" autocomplete="off">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autocomplete="off" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="new-password">
            </div>
            <button class="btn btn-primary">Login</button>
        </form>
    </div>
</x-layouts.customer>
