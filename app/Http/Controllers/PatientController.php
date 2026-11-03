<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function dashboard()
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

        return view('patient.dashboard', compact('appointments'));
    }
}