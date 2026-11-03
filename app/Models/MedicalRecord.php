<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{

    use HasUuids;

    protected $fillable = [
        'appointment_id',
        'diagnosis',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
}