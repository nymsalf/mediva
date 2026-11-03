
@extends('layouts.app')

@section('content')
    <nav class="doctor-navbar">
        <a class="navbar-brand" href="{{ url('/doctor') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="logo-img">
        </a>

        <div class="doctor-nav-right">
            <span class="doctor-name">{{ auth()->user()->name }}</span>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </nav>

    <main class="doctor-content">
        <div class="doctor-welcome">
            <p class="doctor-label">DETAIL PASIEN</p>
            <h1>{{ $patient->user->name }}</h1>
            <p class="doctor-welcome-text">
                {{ $patient->user->email }}
            </p>
        </div>

        <h2>Riwayat Kunjungan</h2>

        <div class="doctor-appointment-list">
            @forelse ($patient->appointments as $appointment)
                <div class="doctor-appointment-card">
                    <div class="doctor-appointment-info">
                        <span class="doctor-queue-number">
                            {{ $appointment->queue_number }}
                        </span>

                        <div>
                            <h3>
                                {{ $appointment->doctor->user->name }}
                            </h3>

                            <p>
                                Poli:
                                {{ $appointment->doctor->poli->name }}
                            </p>

                            <p>
                                Tanggal:
                                {{ $appointment->visit_date }}
                            </p>

                            <p>
                                Status:
                                {{ $appointment->status }}
                            </p>

                            <p>
                                Diagnosis:
                                @if ($appointment->medicalRecord)
                                    {{ $appointment->medicalRecord->diagnosis }}
                                @else
                                    Belum ada rekam medis
                                @endif
                            </p>

                            <p><strong>Resep Obat:</strong></p>

                            @if (
                                $appointment->medicalRecord &&
                                $appointment->medicalRecord->prescription
                            )
                                @forelse (
                                    $appointment->medicalRecord->prescription->details
                                    as $detail
                                )
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
                <div class="doctor-appointment-card">
                    <p>Belum ada riwayat kunjungan.</p>
                </div>
            @endforelse
        </div>

        <div class="doctor-detail-actions">
            <a href="/doctor/patients" class="cancel-button">
                ← Kembali ke Daftar Pasien
            </a>
        </div>
    </main>
</div>
@endsection
