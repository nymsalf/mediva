<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class PatientMedicalRecordController extends Controller
{
    public function index()
    {
        $patient = Auth::user()->patient;

        if (!$patient) {
            abort(403, 'Akun ini belum terhubung dengan data pasien.');
        }

        $medicalRecords = MedicalRecord::with([
            'appointment.doctor.user',
            'appointment.doctor.poli',
            'prescription.details.medicine',
        ])
        ->whereHas('appointment', function ($query) use ($patient) {
            $query->where('patient_id', $patient->id);
        })
        ->orderByDesc('created_at')
        ->get();

        return view(
            'patient.medical-records.index',
            compact('medicalRecords')
        );
    }
}
