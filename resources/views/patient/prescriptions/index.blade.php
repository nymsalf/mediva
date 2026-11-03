
@extends('layouts.app')

@section('content')
<div class="patient-page patient-prescriptions-page">
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

    <main class="patient-content">
        <div class="patient-welcome">
            <p class="patient-label">RESEP & OBAT</p>
            <h1>Resep Saya</h1>
            <p class="patient-welcome-text">
                Lihat daftar obat yang diresepkan dokter untuk Anda.
            </p>
        </div>

        <div class="patient-appointment-list">
            @forelse ($prescriptions as $prescription)
                <div class="patient-appointment-card">
                    <div class="patient-appointment-info">
                        <span class="patient-queue-number">💊</span>

                        <div>
                            <h3>
                                {{ $prescription->medicalRecord->appointment->doctor->user->name }}
                            </h3>

                            <p>
                                Poli:
                                {{ $prescription->medicalRecord->appointment->doctor->poli->name }}
                            </p>

                            <p>
                                Tanggal kunjungan:
                                {{ $prescription->medicalRecord->appointment->visit_date }}
                            </p>

                            <p>
                                Diagnosis:
                                {{ $prescription->medicalRecord->diagnosis }}
                            </p>

                            <p><strong>Daftar Obat</strong></p>

                            @forelse ($prescription->details as $detail)
                                <p>
                                    {{ $detail->medicine->name }}
                                    — {{ $detail->quantity }} buah
                                </p>
                            @empty
                                <p>Belum ada detail obat.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="patient-appointment-card">
                    <p>Belum ada resep obat.</p>
                </div>
            @endforelse
        </div>

        <div class="patient-detail-actions">
            <a href="/patient" class="cancel-button">
                ← Kembali ke Dashboard
            </a>
        </div>
    </main>
</div>
@endsection
