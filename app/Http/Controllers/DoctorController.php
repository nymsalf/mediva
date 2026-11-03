<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctor = Auth::user()->doctor;

        $appointments = Appointment::with([
            'patient.user',
            'doctor.poli',
        ])
        ->where('doctor_id', $doctor->id)
        ->whereDate('visit_date', today())
        ->orderBy('queue_number')
        ->get();

        return view('doctor.dashboard', compact('appointments'));
    }

    public function appointment($id)
    {
        $doctor = Auth::user()->doctor;
        
        $appointment = Appointment::where('id', $id)
        ->where('doctor_id', auth()->user()->doctor_id)
        ->firstOrFail();
        
        return view('doctor.appointment', compact('appointment'));
    }
}