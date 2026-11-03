@extends('layouts.app')

@section('content')

<div class="crud-page">

    <div class="crud-header">

        <div>
            <h1>Appointment</h1>
            <p>Daftar antrean dan kunjungan pasien.</p>
        </div>

        <a href="#" class="primary-button small-button">
            + Tambah Appointment
        </a>

    </div>

    <div class="table-card">

        <table>

            <thead>
                <tr>
                    <th>No. Antrean</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($appointments as $appointment)

                    <tr>

                        <td>
                            {{ $appointment->queue_number }}
                        </td>

                        <td>
                            {{ $appointment->patient->user->name }}
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

                        <td class="action-buttons">

                            <a href="#" class="edit-button">
                                Edit
                            </a>

                            <button class="delete-button">
                                Hapus
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty-data">
                            Belum ada appointment.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection