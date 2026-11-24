@extends('layouts.app')

@section('content')
<div class="pharmacy-page">

    <!-- Navbar -->
    <nav class="navbar">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="logo-img">
        </a>

        <div class="nav-menu">
            <a href="/">Dashboard</a>
            <a href="/login" class="login-button">Login</a>
        </div>
    </nav>

    <div class="pharmacy-container">

        <header class="pharmacy-header">
            <h1>Apotek Mediva</h1>
            <p>Berikan obat terbaik untuk kesehatan keluarga Anda.</p>
        </header>

        {{-- Pesan sukses / error: sekali saja, di luar loop --}}
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="pharmacy-grid">
            @forelse ($medicines as $medicine)
                <article class="pharmacy-card">

                    <div class="pharmacy-image">
                        @if ($medicine->image)
                            <img
                                src="{{ asset('storage/' . $medicine->image) }}"
                                alt="{{ $medicine->name }}"
                            >
                        @else
                            <span class="pharmacy-placeholder">
                                Foto {{ $medicine->name }}
                            </span>
                        @endif
                    </div>

                    <div class="pharmacy-info">
                        <h3>{{ $medicine->name }}</h3>

                        <p class="pharmacy-description">
                            {{ $medicine->description ?? 'Produk kesehatan Mediva.' }}
                        </p>

                        <p class="pharmacy-stock">
                            Tersedia {{ $medicine->stock }}
                        </p>

                        <div class="pharmacy-price">
                            Rp. {{ number_format($medicine->price ?? 0, 0, ',', '.') }}/pcs
                        </div>

                        @if ($medicine->stock > 0)
                        @auth
                        <form action="{{ route('pharmacy.buy', $medicine->id) }}" method="POST">
                            @csrf
                            <button class="pharmacy-buy-button" type="submit">
                                BELI
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="pharmacy-buy-button">
                            BELI
                        </a>
                        @endauth
                        @else
                            <button
                                class="pharmacy-buy-button pharmacy-buy-disabled"
                                type="button"
                                disabled
                            >
                                STOK HABIS
                            </button>
                        @endif
                    </div>

                </article>
            @empty
                <div class="pharmacy-empty">
                    <h3>Belum ada obat tersedia.</h3>
                    <p>Produk obat akan ditampilkan di sini.</p>
                </div>
            @endforelse
        </div>
        <div class="pharmacy-history">
            <button href="{{ route('patient.orders.index') }}" class="pharmacy-buy-button">
                Riwayat Pesanan
            </button>
        </div>
    </div>
</div>
@endsection