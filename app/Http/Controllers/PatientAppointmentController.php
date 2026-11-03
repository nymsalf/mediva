<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        $patient = Auth::user()->patient;

        $appointments = Appointment::with([
            'doctor.user',
            'doctor.poli',
        ])
        ->where('patient_id', $patient->id)
        ->orderByDesc('visit_date')
        ->orderBy('queue_number')
        ->get();

        return view('patient.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::with([
            'user',
            'poli',
        ])->get();

        return view('patient.appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'visit_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        $patient = Auth::user()->patient;

        $lastQueue = Appointment::where('doctor_id', $request->doctor_id)
            ->whereDate('visit_date', $request->visit_date)
            ->max('queue_number');

        $queueNumber = ($lastQueue ?? 0) + 1;

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'queue_number' => $queueNumber,
            'status' => 'menunggu',
            'visit_date' => $request->visit_date,
        ]);

        return redirect('/patient/appointments')
            ->with('success', 'Appointment berhasil dibuat.');
    }
}