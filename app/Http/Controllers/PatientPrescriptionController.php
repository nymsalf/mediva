<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;

class PatientPrescriptionController extends Controller
{
    public function index()
    {
        $patient = Auth::user()->patient;

        if (!$patient) {
            abort(403, 'Akun ini belum terhubung dengan data pasien.');
        }

        $prescriptions = Prescription::with([
            'medicalRecord.appointment.doctor.user',
            'medicalRecord.appointment.doctor.poli',
            'medicalRecord.appointment',
            'details.medicine',
        ])
        ->whereHas('medicalRecord.appointment', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })
        ->orderByDesc('created_at')
        ->get();

        return view(
            'patient.prescriptions.index',
            compact('prescriptions')
        );
    }
}
