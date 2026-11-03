<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Akun ini bukan akun dokter.');
        }

        $appointments = Appointment::with([
            'patient.user',
            'doctor.poli',
        ])
            ->where('doctor_id', $doctor->id)
            ->orderByDesc('visit_date')
            ->orderBy('queue_number')
            ->get();

        return view(
            'doctor.appointments.index',
            compact('appointments')
        );
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:dikonfirmasi,dibatalkan'],
        ]);

        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Akun ini bukan akun dokter.');
        }

        $appointment = Appointment::where('id', $id)
            ->where('doctor_id', $doctor->id)
            ->where('status', 'menunggu')
            ->firstOrFail();

        $visitDate = Carbon::parse($appointment->visit_date);

        if (
            $validated['status'] === 'dikonfirmasi'
            && $visitDate->lt(today())
        ) {
            return back()->with(
                'error',
                'Janji ini sudah lewat tanggal, tidak bisa dikonfirmasi.'
            );
        }

        $appointment->update([
            'status' => $validated['status'],
        ]);

        $message = $validated['status'] === 'dikonfirmasi'
            ? 'Appointment berhasil dikonfirmasi.'
            : 'Appointment berhasil ditolak.';

        return back()->with('success', $message);
    }
}