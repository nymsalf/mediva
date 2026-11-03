<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'stock',
    ];

    public function prescriptionDetails()
    {
        return $this->hasMany(PrescriptionDetail::class);
    }
}