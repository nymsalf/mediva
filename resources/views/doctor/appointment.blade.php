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
                DETAIL APPOINTMENT
            </p>

            <h1>
                Data Kunjungan Pasien
            </h1>

            <p class="doctor-welcome-text">
                Informasi appointment dan pasien.
            </p>
        </div>

        <div class="doctor-detail-card">

            <div class="doctor-detail-row">
                <span>No. Antrean</span>
                <strong>
                    #{{ $appointment->queue_number }}
                </strong>
            </div>

            <div class="doctor-detail-row">
                <span>Nama Pasien</span>
                <strong>
                    {{ $appointment->patient->user->name }}
                </strong>
            </div>

            <div class="doctor-detail-row">
                <span>Poli</span>
                <strong>
                    {{ $appointment->doctor->poli->name }}
                </strong>
            </div>

            <div class="doctor-detail-row">
                <span>Tanggal Kunjungan</span>
                <strong>
                    {{ $appointment->visit_date }}
                </strong>
            </div>

            <div class="doctor-detail-row">
                <span>Status</span>
                <span class="doctor-status-badge">
                    {{ $appointment->status }}
                </span>
            </div>

        </div>

        <div class="doctor-detail-actions">

            @if ($appointment->medicalRecord)
            <a href="/doctor/appointment/{{ $appointment->id }}" class="doctor-detail-button">
                Detail
            </a>
            @else
                <a href="/doctor/appointment/{{ $appointment->id }}/medical-record/create" class="doctor-detail-button">
                    Buat Rekam Medis
                </a>
            @endif

            <a href="/doctor" class="cancel-button">
                ← Kembali
            </a>

        </div>

    </main>

</div>

@endsection