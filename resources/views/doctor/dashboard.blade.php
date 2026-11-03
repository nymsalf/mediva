@extends('layouts.app')

@section('content')

<div class="doctor-page">

    <!-- Navbar -->
    <nav class="doctor-navbar">
        <a class="navbar-brand" href="{{ url('/doctor') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="logo-img">
        </a>

        <div class="doctor-nav-right">
            <span class="doctor-name">
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
    <main class="doctor-content">

        <!-- Welcome -->
        <section class="doctor-welcome">

            <div>
                <p class="doctor-label">
                    DASHBOARD DOKTER
                </p>

                <h1>
                    Selamat datang,
                    {{ auth()->user()->name }} 👋
                </h1>

                <p class="doctor-welcome-text">
                    Kelola appointment, pasien, rekam medis,
                    dan resep melalui MEDIVA.
                </p>
            </div>

        </section>


        <!-- Menu Cards -->
        <section class="doctor-menu">

            <a href="/doctor/appointments" class="doctor-card">

                <div class="doctor-card-icon">
                    📅
                </div>

                <div>
                    <h2>Appointment</h2>

                    <p>
                        Lihat dan kelola jadwal pasien.
                    </p>
                </div>

            </a>


            <a href="/doctor/patients" class="doctor-card">

                <div class="doctor-card-icon">
                    👥
                </div>

                <div>
                    <h2>Pasien</h2>

                    <p>
                        Lihat daftar pasien yang ditangani.
                    </p>
                </div>

            </a>


            <a href="/doctor/medical-records" class="doctor-card">

                <div class="doctor-card-icon">
                    📋
                </div>

                <div>
                    <h2>Rekam Medis</h2>

                    <p>
                        Kelola diagnosis dan catatan medis pasien.
                    </p>
                </div>

            </a>

        </section>


        <!-- Appointment Hari Ini -->
        <section class="doctor-section">

            <div class="doctor-section-heading">

                <div>
                    <h2>Appointment Hari Ini</h2>

                    <p>
                        Daftar pasien yang memiliki jadwal kunjungan.
                    </p>
                </div>

                <a href="#" class="doctor-view-all">
                    Lihat semua →
                </a>

            </div>

            @forelse ($appointments as $appointment)

    <div class="doctor-appointment-card">

        <div class="doctor-appointment-info">

            <span class="doctor-queue-number">
                #{{ $appointment->queue_number }}
            </span>

            <div>
                <h3>
                    {{ $appointment->patient->user->name }}
                </h3>

                <p>
                    {{ $appointment->doctor->poli->name }}
                </p>
            </div>

        </div>


        <div class="doctor-appointment-time">

            <strong>
                {{ $appointment->visit_date }}
            </strong>

            <span>
                Appointment
            </span>

        </div>


        <span class="doctor-status-badge">
            {{ $appointment->status }}
        </span>

    </div>

@empty

    <div class="doctor-appointment-card">

        <p>
            Belum ada appointment hari ini.
        </p>

    </div>

@endforelse

@endsection