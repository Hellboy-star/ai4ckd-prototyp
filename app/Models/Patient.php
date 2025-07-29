<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    use HasFactory;
    protected $fillable = ['name', 'dob', 'history'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
