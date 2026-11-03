@extends('layouts.app')

@section('content')

<div class="patient-page">

    <!-- Navbar -->
    <nav class="patient-navbar">

        <a class="navbar-brand" href="{{ url('#') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="logo-img">
        </a>

        <div class="patient-nav-right">
            <span class="patient-name">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="/logout">
                @csrf

                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>
        </div>

    </nav>


    <!-- Main Content -->
    <main class="patient-content">

        <section class="welcome-section">

            <div>
                <p class="welcome-label">
                    DASHBOARD PASIEN
                </p>

                <h1>
                    Selamat datang,
                    {{ auth()->user()->name }} 👋
                </h1>

                <p class="welcome-text">
                    Kelola kebutuhan kesehatan Anda dengan mudah
                    melalui MEDIVA.
                </p>
            </div>

        </section>


        <!-- Menu Cards -->
        <section class="patient-menu">

            <a href="/patient/appointments" class="patient-card">

                <div class="card-icon">
                    📅
                </div>

                <div>
                    <h2>Appointment</h2>

                    <p>
                        Buat dan lihat jadwal kunjungan Anda.
                    </p>
                </div>

            </a>


            <a href="/patient/medical-records" class="patient-card">

                <div class="card-icon">
                    📋
                </div>

                <div>
                    <h2>Rekam Medis</h2>

                    <p>
                        Lihat riwayat pemeriksaan dan diagnosis.
                    </p>
                </div>

            </a>


            <a href="patient/prescriptions" class="patient-card">

                <div class="card-icon">
                    💊
                </div>

                <div>
                    <h2>Resep & Obat</h2>

                    <p>
                        Lihat resep dan obat yang diberikan dokter.
                    </p>
                </div>

            </a>

        </section>


        <!-- Appointment Terbaru -->
    @forelse ($appointments as $appointment)

    <div class="appointment-card">

        <div class="appointment-info">

            <span class="appointment-number">
                #{{ $appointment->queue_number }}
            </span>

            <div>
                <h3>
                    {{ $appointment->doctor->poli->name }}
                </h3>

                <p>
                    {{ $appointment->doctor->user->name }}
                </p>
            </div>

        </div>


        <div class="appointment-date">

            <strong>
                {{ $appointment->visit_date }}
            </strong>

            <span>
                Appointment
            </span>

        </div>


        <span class="status-badge">
            {{ $appointment->status }}
        </span>

    </div>

@empty

    <div class="appointment-card">

        <p>
            Belum ada appointment.
        </p>

    </div>

@endforelse
@endsection