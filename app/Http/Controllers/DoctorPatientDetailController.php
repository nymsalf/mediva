<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class DoctorPatientDetailController extends Controller
{
    public function show($id)
    {
        $doctor = Auth::user()->doctor;

        $patient = Patient::with([
            'user',
            'appointments' => function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id)
                    ->with([
                        'doctor.user',
                        'doctor.poli',
                        'medicalRecord.prescription.details.medicine',
                    ])
                    ->orderByDesc('visit_date');
            },
        ])
        ->whereHas('appointments', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })
        ->where('id', $id)
        ->firstOrFail();

        return view('doctor.patients.show', compact('patient'));
    }
}
