<?php

namespace App\Services;

use App\Models\Alert;
use App\Models\Patient;

class AlertEngine
{
    public static function check(Patient $patient): void
    {
        $consultation = $patient->consultations()->latest()->first();

        if (!$consultation) return;

        // Calcul de la perte de poids
        $weightLoss = 0;
        if ($consultation->previous_weight && $consultation->weight) {
            $weightLoss = (($consultation->previous_weight - $consultation->weight) / $consultation->previous_weight) * 100;
        }

        // Règles simples
        if ($consultation->creatinine > 1.5) {
            Alert::create([
                'patient_id' => $patient->id,
                'type' => 'Créatinine',
                'message' => 'Niveau élevé de créatinine détecté (> 1.5 mg/dL).',
                'level' => 'danger',
            ]);
        }

        if ($consultation->blood_pressure_systolic > 140) {
            Alert::create([
                'patient_id' => $patient->id,
                'type' => 'Tension artérielle',
                'message' => 'Hypertension détectée (> 140 mmHg).',
                'level' => 'warning',
            ]);
        }

        if ($weightLoss > 5) {
            Alert::create([
                'patient_id' => $patient->id,
                'type' => 'Poids',
                'message' => 'Perte de poids rapide détectée (>' . round($weightLoss, 1) . '%).',
                'level' => 'danger',
            ]);
        }
    }
}
