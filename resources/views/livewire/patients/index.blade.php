<x-app-layout>
    <x-slot name="header">
        Liste des patients
    </x-slot>

    <div>
        <h2 class="text-xl font-bold mb-4">Liste des patients</h2>
        <ul>
            @foreach($patients as $patient)
                <li>
                    <a href="{{ route('patients.show', $patient->id) }}" class="text-blue-500 hover:underline">
                        {{ $patient->name }} ({{ $patient->dob }})
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</x-app-layout>