<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'patient_id', 'date', 'creatinine', 'blood_pressure_systolic',
        'blood_pressure_diastolic', 'weight', 'previous_weight'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
