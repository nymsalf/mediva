<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    use HasUuids;

    protected $fillable = [
        'prescription_id',
        'medicine_id',
        'quantity',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}