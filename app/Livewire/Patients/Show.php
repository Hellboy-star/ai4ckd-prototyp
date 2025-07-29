<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class Show extends Component
{
    public $patient;

    public function mount($id)
    {
        $this->patient = Patient::with(['consultations', 'alerts'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.patients.show');
    }
}
