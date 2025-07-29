<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: sans-serif; font-size: 14px; }
            h2 { text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
            th { background-color: #f0f0f0; }
        </style>
    </head>
    <body>
        <h2>Dossier Patient - {{ $patient->name }}</h2>
        <p><strong>ID :</strong> {{ $patient->id }}</p>
        <p><strong>Date de naissance :</strong> {{ $patient->dob }}</p>
    
        <h3>Antécédents médicaux</h3>
        <p>{{ $patient->history ?? 'Aucun renseignement' }}</p>
    
        <h3>Consultations</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Créatinine</th>
                    <th>TA</th>
                    <th>Poids</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patient->consultations as $c)
                    <tr>
                        <td>{{ $c->date }}</td>
                        <td>{{ $c->creatinine }}</td>
                        <td>{{ $c->blood_pressure_systolic }}/{{ $c->blood_pressure_diastolic }}</td>
                        <td>{{ $c->weight }} kg</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <h3>Alertes déclenchées</h3>
        <ul>
            @forelse($patient->alerts as $a)
                <li><strong>{{ $a->type }}</strong> ({{ $a->level }}) : {{ $a->message }}</li>
            @empty
                <li>Aucune alerte enregistrée.</li>
            @endforelse
        </ul>
    </body>
</html>
