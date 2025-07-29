<div class="mt-4 p-4 border rounded">
    <h4 class="font-semibold mb-2">Nouvelle consultation</h4>

    <input type="date" wire:model="date" class="input" placeholder="Date"><br>
    <input type="number" wire:model="creatinine" class="input" placeholder="Créatinine"><br>
    <input type="number" wire:model="blood_pressure_systolic" class="input" placeholder="TA systolique"><br>
    <input type="number" wire:model="blood_pressure_diastolic" class="input" placeholder="TA diastolique"><br>
    <input type="number" wire:model="weight" class="input" placeholder="Poids"><br>

    <button wire:click="save" class="btn btn-primary mt-2">Enregistrer</button>

    @if (session()->has('success'))
        <div class="text-green-500 mt-2">{{ session('success') }}</div>
    @endif
</div>
