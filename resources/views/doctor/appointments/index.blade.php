@extends('layouts.app')

@section('content')

<div class="doctor-page">

    {{-- Navbar --}}
    <nav class="doctor-navbar">
        <a class="navbar-brand" href="{{ url('/doctor') }}">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Mediva"
                class="logo-img"
            >
        </a>

        <div class="doctor-nav-right">
            <span class="doctor-name">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ url('/logout') }}">
                @csrf

                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Konten utama --}}
    <main class="doctor-content">

        {{-- Header halaman --}}
        <header class="doctor-welcome">
            <p class="doctor-label">APPOINTMENT</p>

            <h1>Appointment Pasien</h1>

            <p class="doctor-welcome-text">
                Daftar jadwal kunjungan pasien Anda.
            </p>
        </header>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Daftar appointment --}}
        <div class="doctor-appointment-list">

            @forelse ($appointments as $appointment)

                <article class="doctor-appointment-card">

                    {{-- Informasi pasien --}}
                    <div class="doctor-appointment-info">
                        <span class="doctor-queue-number">
                            #{{ $appointment->queue_number }}
                        </span>

                        <div>
                            <h3>
                                {{ $appointment->patient->user->name }}
                            </h3>

                            <p>
                                {{ $appointment->doctor->poli->name ?? 'Poli tidak tersedia' }}
                            </p>
                        </div>
                    </div>

                    {{-- Jadwal kunjungan --}}
                    <div class="doctor-appointment-time">
                        <strong>
                            {{ \Carbon\Carbon::parse($appointment->visit_date)->format('d M Y, H:i') }}
                        </strong>

                        <span>Appointment</span>
                    </div>

                    {{-- Status --}}
                    <span class="doctor-status-badge">
                        {{ ucfirst($appointment->status) }}
                    </span>

                    {{-- Tombol tindakan --}}
                    <div class="doctor-appointment-actions">

                        <a
                            href="{{ url('/doctor/appointment/' . $appointment->id) }}"
                            class="doctor-detail-button"
                        >
                            Detail
                        </a>

                        @if ($appointment->status === 'menunggu')

                            {{-- Konfirmasi appointment --}}
                            <form
                                method="POST"
                                action="{{ url('/doctor/appointment/' . $appointment->id . '/status') }}"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="dikonfirmasi"
                                >

                                <button
                                    type="submit"
                                    class="btn-confirm"
                                >
                                    Konfirmasi
                                </button>
                            </form>

                            {{-- Tolak appointment --}}
                            <form
                                method="POST"
                                action="{{ url('/doctor/appointment/' . $appointment->id . '/status') }}"
                                onsubmit="return confirm('Yakin menolak appointment ini?')"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="status"
                                    value="dibatalkan"
                                >

                                <button
                                    type="submit"
                                    class="btn-reject"
                                >
                                    Tolak
                                </button>
                            </form>

                        @endif

                    </div>

                </article>

            @empty

                <div class="doctor-appointment-card">
                    <p>Belum ada appointment pasien.</p>
                </div>

            @endforelse

        </div>

        {{-- Kembali ke dashboard --}}
        <div class="doctor-detail-actions">
            <a
                href="{{ url('/doctor') }}"
                class="cancel-button"
            >
                ← Kembali ke Dashboard
            </a>
        </div>

    </main>

</div>

@endsection
