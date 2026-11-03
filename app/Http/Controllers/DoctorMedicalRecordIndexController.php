<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class DoctorMedicalRecordIndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $doctor = $user->doctor;

        if (!$doctor) {
            abort(403, 'Akun ini belum terhubung dengan data dokter.');
        }

        $medicalRecords = MedicalRecord::with([
            'appointment.patient.user',
            'appointment.doctor.poli',
        ])
        ->whereHas('appointment', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })
        ->orderByDesc('created_at')
        ->get();

        return view(
            'doctor.medical-records.index',
            compact('medicalRecords')
        );
    }
}
