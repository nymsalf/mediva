@extends('layouts.app')

@section('content')

<div class="patient-page">

    <nav class="patient-navbar">
        <a class="navbar-brand" href="{{ url('/patient') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Mediva" class="logo-img">
        </a>

        <div class="patient-nav-right">

            <span class="patient-name">
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


    <main class="patient-content">

        <div class="appointment-form-header">

            <p class="welcome-label">
                APPOINTMENT
            </p>

            <h1>
                Buat Appointment
            </h1>

            <p class="welcome-text">
                Pilih dokter dan tanggal kunjungan Anda.
            </p>

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


        <div class="appointment-form-card">

            <form
                method="POST"
                action="/patient/appointments"
            >

                @csrf


                <div class="form-group">

                    <label for="doctor_id">
                        Dokter
                    </label>

                    <select
                        id="doctor_id"
                        name="doctor_id"
                        required
                    >

                        <option value="">
                            -- Pilih Dokter --
                        </option>

                        @foreach ($doctors as $doctor)

                            <option
                                value="{{ $doctor->id }}"
                                {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}
                            >
                                {{ $doctor->user->name }}
                                - {{ $doctor->poli->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label for="visit_date">
                        Tanggal Kunjungan
                    </label>

                    <input
                        type="date"
                        id="visit_date"
                        name="visit_date"
                        min="{{ date('Y-m-d') }}"
                        value="{{ old('visit_date') }}"
                        required
                    >

                </div>


                <div class="form-actions">

                    <a
                        href="/patient/appointments"
                        class="cancel-button"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="primary-button"
                    >
                        Buat Appointment
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

@endsection