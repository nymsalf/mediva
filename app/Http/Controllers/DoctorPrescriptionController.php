<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorPrescriptionController extends Controller
{
    public function create($appointmentId)
    {
        $doctor = Auth::user()->doctor;

        $appointment = Appointment::with([
            'patient.user',
            'medicalRecord',
        ])
        ->where('id', $appointmentId)
        ->where('doctor_id', $doctor->id)
        ->firstOrFail();

        if (!$appointment->medicalRecord) {
            abort(404, 'Rekam medis belum tersedia.');
        }

        $medicines = Medicine::orderBy('name')->get();

        return view('doctor.prescriptions.create', compact(
            'appointment',
            'medicines'
        ));
    }
}