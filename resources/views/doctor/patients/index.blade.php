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
                PASIEN
            </p>

            <h1>
                Daftar Pasien
            </h1>

            <p class="doctor-welcome-text">
                Daftar pasien yang pernah melakukan kunjungan kepada Anda.
            </p>

        </div>


        <div class="doctor-appointment-list">

            @forelse ($patients as $patient)

                <div class="doctor-appointment-card">

                    <div class="doctor-appointment-info">

                        <span class="doctor-queue-number">
                            👤
                        </span>

                        <div>
                            <h3>
                                {{ $patient->user->name }}
                            </h3>

                            <p>
                                {{ $patient->user->email }}
                            </p>
                        </div>

                    </div>

                    <a
                        href="/doctor/patient/{{ $patient->id }}"
                        class="doctor-detail-button"
                    >
                        Detail
                    </a>

                </div>

            @empty

                <div class="doctor-appointment-card">

                    <p>
                        Belum ada pasien.
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