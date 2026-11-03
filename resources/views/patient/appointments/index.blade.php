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

        <div class="appointment-page-header">

            <div>
                <p class="welcome-label">
                    APPOINTMENT
                </p>

                <h1>
                    Appointment Saya
                </h1>

                <p class="welcome-text">
                    Lihat dan kelola jadwal kunjungan Anda.
                </p>
            </div>
            <div class="patient-appointment-actions">
                <a href="/patient/appointments/create"
                class="appointment-create-button">+ Buat Appointment</a>
            </div>
        </div>


        @if (session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        <div class="appointment-table-card">

            <table>

                <thead>
                    <tr>
                        <th>No. Antrean</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($appointments as $appointment)

                        <tr>

                            <td>
                                <strong>
                                    #{{ $appointment->queue_number }}
                                </strong>
                            </td>

                            <td>
                                {{ $appointment->doctor->user->name }}
                            </td>

                            <td>
                                {{ $appointment->doctor->poli->name }}
                            </td>

                            <td>
                                {{ $appointment->visit_date }}
                            </td>

                            <td>
                                <span class="status-badge">
                                    {{ $appointment->status }}
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty-data">
                                Belum ada appointment.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

@endsection