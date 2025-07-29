<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    //
    use HasFactory;

    protected $fillable = ['patient_id', 'type', 'message', 'level'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
