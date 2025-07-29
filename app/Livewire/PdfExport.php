<?php

namespace App\Livewire;

use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class PdfExport extends Component
{
    public $patientId;

    public function download()
    {
        $patient = Patient::with(['consultations', 'alerts'])->findOrFail($this->patientId);
        $pdf = Pdf::loadView('pdf.patient', compact('patient'));

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "dossier_patient_{$patient->id}.pdf"
        );
    }

    public function render()
    {
        return view('livewire.pdf-export');
    }
}
