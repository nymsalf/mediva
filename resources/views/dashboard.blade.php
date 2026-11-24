@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="w-full min-h-screen bg-white overflow-x-hidden">

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


    <!-- Hero -->
    <section class="hero" style="--hero-img: url('{{ asset('images/istockphoto-1238687200-612x612.jpg') }}');">
        <div class="hero-overlay"></div>

        <div class="hero-content">

            <h1>
                Solusi Kesehatan di<br>
                <span class="highlight">Tanganmu</span>
            </h1>

            <p>
                Jelajahi fitur kesehatan di Website<br>
                Resmi Klinik Mediva.
            </p>

            <a href="#feature" class="hero-button">MULAI</a>

        </div>

    </section>

    <div class="trusted-section">
        <h2>Dokter Terpercaya</h2>
        <p>Lebih dari 10+ pengguna kami telah merasakan manfaat dari layanan kesehatan kami.</p>
        
        <div class="trusted-doctors">
            <img src="{{ asset('images/doctor-trusted.jpg') }}" alt="Dokter">
        </div>
    </div> 

    <div class="features-section" id="feature">
        <h2>Fitur Unggulan</h2>

        <div class="features-grid">
            <div class="feature-card"
            onclick="window.open('https://wa.me/628218069489', '_blank')"
            style="cursor: pointer;">
            <img src="{{ asset('images/doctor.png') }}" alt="Chat dengan Dokter">
            <h3>Chat dengan Dokter</h3>
            <p>Konsultasi kesehatan secara online dengan dokter terpercaya.</p>
            </div>

            <div class="feature-card" onclick="window.location.href='{{ url('/pharmacy')}}'" style="cursor: pointer;">
                <img src="{{ asset('images/resep.png') }}" alt="Toko Kesehatan">
                <h3>Toko Kesehatan</h3>
                <p>Beli obat dan produk kesehatan dengan mudah dan cepat.</p>
            </div>

            <div class="feature-card" onclick="window.location.href='{{ url('/patient/appointments')}}'" style="cursor: pointer;">
                <img src="{{ asset('images/janji_temu_kalender.png') }}" alt="Jadwal Janji Temu">
                <h3>
                    Jadwal Janji Temu
                </h3>
                <p>Atur janji temu dengan dokter sesuai jadwal Anda.</p>
            </div>

        </div>
    </div>

    @include('partial.footer')
</div>
@endsection