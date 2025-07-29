<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class Index extends Component
{

    public $patients;

    public function mount()
    {
        $this->patients = Patient::latest()->get();
    }

    public function render()
    {
        return view('livewire.patients.index');
    }
}
