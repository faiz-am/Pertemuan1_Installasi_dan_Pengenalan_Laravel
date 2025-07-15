<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Toko Online' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Navbar Customer --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">TokoKita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ url('products') }}" class="nav-link">Produk</a></li>
                    <li class="nav-item"><a href="{{ route('cart.index') }}" class="nav-link">Keranjang</a></li>
                    @auth('customer')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ auth('customer')->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="{{ route('customer.home') }}">Dashboard</a></li>
    <li><a class="dropdown-item" href="{{ route('customer.orders.index') }}">Pesanan Saya</a></li>
    <li>
        <form action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button class="dropdown-item" type="submit">Logout</button>
        </form>
    </li>
</ul>

                                <li>
                                    <form action="{{ route('customer.logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('customer.login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('customer.register') }}" class="nav-link">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        {{ $slot }}
    </main>

    <footer class="bg-light text-center py-4 mt-5 border-top">
        <p class="mb-0 text-muted">© {{ date('Y') }} TokoKita</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
