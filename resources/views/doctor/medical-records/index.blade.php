@extends('layouts.app')

@section('content')

<div class="doctor-page">

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


    <main class="doctor-content">

        <div class="doctor-welcome">

            <p class="doctor-label">
                REKAM MEDIS
            </p>

            <h1>
                Rekam Medis Pasien
            </h1>

            <p class="doctor-welcome-text">
                Daftar riwayat pemeriksaan pasien Anda.
            </p>

        </div>


        <div class="doctor-appointment-list">

            @forelse ($medicalRecords as $record)

                <div class="doctor-appointment-card">

                    <div class="doctor-appointment-info">

                        <span class="doctor-queue-number">
                            📋
                        </span>

                        <div>
                            <h3>
                                {{ $record->appointment->patient->user->name }}
                            </h3>

                            <p>
                                {{ $record->appointment->doctor->poli->name }}
                            </p>
                        </div>

                    </div>


                    <div class="doctor-appointment-time">

                        <strong>
                            {{ $record->appointment->visit_date }}
                        </strong>

                        <span>
                            Pemeriksaan
                        </span>

                    </div>


                    <span class="doctor-status-badge">
                        Selesai
                    </span>

                </div>

            @empty

                <div class="doctor-appointment-card">

                    <p>
                        Belum ada rekam medis pasien.
                    </p>

                </div>

            @endforelse

        </div>


        <div class="doctor-detail-actions">

            <a
                href="/doctor"
                class="cancel-button"
            >
                ← Kembali ke Dashboard
            </a>

        </div>

    </main>

</div>

@endsection