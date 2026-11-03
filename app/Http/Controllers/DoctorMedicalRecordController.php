<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorMedicalRecordController extends Controller
{
    public function create($appointmentId)
    {
        $doctor = Auth::user()->doctor;

        $appointment = Appointment::with([
            'patient.user',
            'doctor.poli',
            'medicalRecord',
        ])
        ->where('id', $appointmentId)
        ->where('doctor_id', $doctor->id)
        ->firstOrFail();

        return view('doctor.medical-record.create', compact('appointment'));
    }

    public function store(Request $request, $appointmentId)
    {
        $request->validate([
            'diagnosis' => ['required', 'string'],
        ]);

        $doctor = Auth::user()->doctor;

        $appointment = Appointment::where('id', $appointmentId)
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        MedicalRecord::create([
            'appointment_id' => $appointment->id,
            'diagnosis' => $request->diagnosis,
        ]);

        $appointment->update([
            'status' => 'selesai',
        ]);

        return redirect('/doctor/appointment/' . $appointment->id)
            ->with('success', 'Rekam medis berhasil dibuat.');
    }
}