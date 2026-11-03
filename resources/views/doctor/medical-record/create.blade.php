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
                Pemeriksaan Pasien
            </h1>

            <p class="doctor-welcome-text">
                Masukkan hasil pemeriksaan pasien.
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
                <strong>
                    #{{ $appointment->queue_number }}
                </strong>
            </div>

            <div class="doctor-detail-row">
                <span>Poli</span>
                <strong>
                    {{ $appointment->doctor->poli->name }}
                </strong>
            </div>

            <form
                method="POST"
                action="/doctor/appointment/{{ $appointment->id }}/medical-record"
                class="medical-record-form"
            >

                @csrf

                <div class="form-group">
                    <label for="diagnosis">
                        Diagnosis
                    </label>

                    <textarea
                        id="diagnosis"
                        name="diagnosis"
                        rows="6"
                        placeholder="Masukkan diagnosis pasien..."
                        required
                    >{{ old('diagnosis') }}</textarea>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-actions">

                    <a
                        href="/doctor/appointment/{{ $appointment->id }}"
                        class="cancel-button"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="primary-button"
                    >
                        Simpan Rekam Medis
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

@endsection