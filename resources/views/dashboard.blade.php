<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    <div class="min-h-screen bg-gray-100">
        
        {{-- Statistiques --}}
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Nombre total de patients</h2>
                <p class="text-3xl font-bold text-blue-600 mt-2"><?php
								$a=App\Models\Patient::count();
								echo $a; 
							?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Consultations ce mois</h2>
                <p class="text-3xl font-bold text-green-600 mt-2"><?php
								$a=App\Models\Alert::count();
								echo $a; 
							?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Alertes critiques</h2>
                <p class="text-3xl font-bold text-red-600 mt-2"><?php
								$a=App\Models\Alert::count();
								echo $a; 
							?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Analyses en attente</h2>
                <p class="text-3xl font-bold text-yellow-600 mt-2"><?php
								$a=App\Models\Alert::count();
								echo $a; 
							?></p>
            </div>
        </div>

        {{-- Graphiques / Activités (Placeholder) --}}
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Évolution des consultations</h2>
                <div class="h-48 flex items-center justify-center text-gray-400">
                    [Graphique ligne ici - Chart.js ou autre]
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Activité récente</h2>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>✅ Patient X a été consulté le 28 juillet</li>
                    <li>✅ Nouveau patient ajouté : Mme Y</li>
                    <li>⚠️ Analyse critique détectée pour M. Z</li>
                    <li>📤 Rapport trimestriel envoyé</li>
                </ul>
            </div>
        </div>
    </div>

</x-app-layout>