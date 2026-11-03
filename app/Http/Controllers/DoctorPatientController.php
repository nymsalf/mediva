<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DoctorPatientController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        $patients = Appointment::with([
            'patient.user',
        ])
        ->where('doctor_id', $doctor->id)
        ->get()
        ->pluck('patient')
        ->unique('id')
        ->values();

        return view('doctor.patients.index', compact('patients'));
    }
}