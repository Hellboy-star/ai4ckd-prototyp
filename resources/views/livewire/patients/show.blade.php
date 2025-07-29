<div>
    <h2 class="text-2xl font-bold">{{ $patient->name }}</h2>
    <p>Date de naissance : {{ $patient->dob }}</p>
    <p>Antécédents : {{ $patient->history }}</p>

    <h3 class="mt-4 font-semibold">Alertes</h3>
    @foreach($patient->alerts as $alert)
        <div class="p-2 rounded mb-2 bg-{{ $alert->level == 'danger' ? 'red' : ($alert->level == 'warning' ? 'yellow' : 'blue') }}-200">
            <strong>{{ $alert->type }}</strong> : {{ $alert->message }}
        </div>
    @endforeach

    @livewire('consultations.create', ['patientId' => $patient->id])
    @livewire('pdf-export', ['patientId' => $patient->id])

</div>
