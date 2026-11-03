<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasUuids, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
    
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    
    public function processedPrescriptions()
    {
        return $this->hasMany(Prescription::class, 'processed_by');
    }
}