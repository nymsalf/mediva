@extends('layouts.app')

@section('content')

<div class="order-history-page">
    
        <nav class="patient-navbar">
        <a class="navbar-brand" href="{{ url('/patient') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="logo-img">
        </a>

        <div class="patient-nav-right">
            <span class="patient-name">{{ auth()->user()->name }}</span>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </nav>

    <div class="order-history-container">

        <div class="order-history-header">
            <h1>Riwayat Pesanan</h1>
            <p>Lihat daftar pembelian obat Anda di MEDIVA.</p>
        </div>

        @if ($orders->count() > 0)

            <div class="order-list">

                @foreach ($orders as $order)
                    <div class="order-card">

                        <div class="order-card-header">
                            <h3>{{ $order->medicine->name ?? 'Obat' }}</h3>

                            <span class="order-status">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="order-card-body">
                            <p>
                                Jumlah:
                                {{ $order->quantity }} pcs
                            </p>

                            <p>
                                Harga satuan:
                                Rp {{ number_format($order->price, 0, ',', '.') }}
                            </p>

                            <p class="order-total">
                                Total:
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </p>

                            <p class="order-date">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>

        @else

            <div class="order-empty">
                <h3>Belum ada pesanan</h3>
                <p>Pesanan obat Anda akan muncul di halaman ini.</p>

                <a href="{{ route('pharmacy.index') }}" class="order-pharmacy-button">
                    Belanja Obat
                </a>
            </div>

        @endif

    </div>
</div>

@endsection