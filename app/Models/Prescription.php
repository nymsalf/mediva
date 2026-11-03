<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'medical_record_id',
        'processed_by',
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function details()
    {
        return $this->hasMany(PrescriptionDetail::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}