
@extends('layouts.app')

@section('content')
<div class="patient-page patient-records-page">
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
            <p class="patient-label">REKAM MEDIS</p>
            <h1>Riwayat Rekam Medis</h1>
            <p class="patient-welcome-text">
                Lihat riwayat pemeriksaan dan diagnosis Anda.
            </p>
        </div>

        <div class="patient-appointment-list">
            @forelse ($medicalRecords as $record)
                <div class="patient-appointment-card">
                    <div class="patient-appointment-info">
                        <span class="patient-queue-number">🩺</span>

                        <div>
                            <h3>
                                {{ $record->appointment->doctor->user->name }}
                            </h3>

                            <p>
                                Poli:
                                {{ $record->appointment->doctor->poli->name }}
                            </p>

                            <p>
                                Tanggal:
                                {{ $record->appointment->visit_date }}
                            </p>

                            <p>
                                Diagnosis:
                                {{ $record->diagnosis }}
                            </p>

                            <p><strong>Resep Obat</strong></p>

                            @if ($record->prescription)
                                @forelse ($record->prescription->details as $detail)
                                    <p>
                                        {{ $detail->medicine->name }}
                                        — {{ $detail->quantity }} buah
                                    </p>
                                @empty
                                    <p>Belum ada detail obat.</p>
                                @endforelse
                            @else
                                <p>Belum ada resep.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="patient-appointment-card">
                    <p>Belum ada rekam medis.</p>
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
