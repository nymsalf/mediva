@extends('layouts.app')

@section('content')
<div class="w-full min-h-screen bg-white overflow-x-hidden">
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="logo-img">
        </a>

        <div class="nav-menu">
            <a href="#">Dashboard</a>
            <a href="/login" class="login-button">Login</a>
        </div>
    </nav>


    <!-- Hero -->
     <section class="hero" style="background-image: url('{{ asset('images/istockphoto-1238687200-612x612.jpg') }}');">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            
            <h1>
                Solusi kesehatan di<br>
                Tanganmu
            </h1>

            <p>
                Klinik digital terpercaya untuk konsultasi kesehatan di Plaju.
            </p>

            <a href="#feature" class="hero-button">Mulai Sekarang</a>

        </div>

    </section>

    <div class="features-section" id="feature">
        <h2>Fitur Unggulan</h2>

        <div class="features-grid">
            <div class="feature-card">
                <img src="{{ asset('images/doctor.png') }}" alt="Chat dengan Dokter">
                <h3>Chat dengan Dokter</h3>
                <p>Konsultasi kesehatan secara online dengan dokter terpercaya.</p>
            </div>

            <div class="feature-card">
                <img src="{{ asset('images/resep.png') }}" alt="Toko Kesehatan">
                <h3>Toko Kesehatan</h3>
                <p>Beli obat dan produk kesehatan dengan mudah dan cepat.</p>
            </div>
            
            <div class="feature-card" onclick="window.location.href='{{ url('/patient/appointments') }}'" style="cursor: pointer;">
                <img src="{{ asset('images/janji_temu_kalender.png') }}" alt="Jadwal Janji Temu">
                <h3>
                    Jadwal Janji Temu
                </h3>
                <p>Atur janji temu dengan dokter sesuai jadwal Anda.</p>
            </div>

            <div class="feature-card">
                <img src="{{ asset('images/obat.png') }}" alt="Pengingat Obat">
                <h3>Pengingat Obat</h3>
                <p>Dapatkan pengingat untuk minum obat tepat waktu.</p>
            </div>
        </div>
</div>
<footer>
        <p style="text-align: center; color: #ff7dbe; font-size: 14px;">
            &copy; 2026 MEDIVA. By Kelompok 10. All rights reserved.
        </p>
    </footer>
</body>
</html>
@endsection