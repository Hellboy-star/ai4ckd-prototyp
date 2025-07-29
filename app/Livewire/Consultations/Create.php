<?php

namespace App\Livewire\Consultations;

use App\Models\Consultation;
use App\Models\Patient;
use App\Services\AlertEngine;
use Livewire\Component;

class Create extends Component
{
    public $patientId;
    public $date, $creatinine, $blood_pressure_systolic, $blood_pressure_diastolic, $weight;

    public function save()
    {
        $patient = Patient::findOrFail($this->patientId);

        $lastWeight = $patient->consultations()->latest()->first()?->weight;

        $consultation = Consultation::create([
            'patient_id' => $this->patientId,
            'date' => $this->date,
            'creatinine' => $this->creatinine,
            'blood_pressure_systolic' => $this->blood_pressure_systolic,
            'blood_pressure_diastolic' => $this->blood_pressure_diastolic,
            'weight' => $this->weight,
            'previous_weight' => $lastWeight
        ]);

        AlertEngine::check($patient); // déclenchement d’alertes

        session()->flash('success', 'Consultation enregistrée.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.consultations.create');
    }
}
