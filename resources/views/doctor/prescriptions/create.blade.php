
@extends('layouts.app')

@section('content')

<div class="doctor-page">

    <nav class="doctor-navbar">
        <div class="logo">
            MED<span>I</span>VA
        </div>

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
            <p class="doctor-label">RESEP OBAT</p>
            <h1>Buat Resep Pasien</h1>
            <p class="doctor-welcome-text">
                Pilih obat untuk resep berdasarkan pemeriksaan pasien.
            </p>
        </div>

        <div class="doctor-detail-card">

            <div class="doctor-detail-row">
                <span>Nama Pasien</span>
                <strong>
                    {{ $appointment->patient->user->name }}
                </strong>
            </div>

            <div class="doctor-detail-row">
                <span>No. Antrean</span>
                <strong>#{{ $appointment->queue_number }}</strong>
            </div>

            <div class="doctor-detail-row">
                <span>Diagnosis</span>
                <strong>
                    {{ $appointment->medicalRecord->diagnosis }}
                </strong>
            </div>

            <div class="medical-record-form">

                <p>
                    Daftar obat tersedia:
                    <strong>{{ $medicines->count() }}</strong>
                </p>

                @forelse ($medicines as $medicine)
                    <div class="doctor-detail-row">
                        <span>{{ $medicine->name }}</span>
                        <strong>
                            Stok: {{ $medicine->stock }}
                        </strong>
                    </div>
                @empty
                    <p>
                        Belum ada obat di database. Tambahkan data obat
                        sebelum membuat resep.
                    </p>
                @endforelse

            </div>

            <div class="doctor-detail-actions">
                <a
                    href="/doctor/appointment/{{ $appointment->id }}"
                    class="cancel-button"
                >
                    ← Kembali ke Appointment
                </a>
            </div>

        </div>

    </main>

</div>

@endsection
