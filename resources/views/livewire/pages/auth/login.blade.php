<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};
?>

<!-- Vue stylisée -->
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
  <div class="relative py-3 sm:max-w-xl sm:mx-auto">
    <div
      class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-sky-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
    </div>

    <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
      <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-semibold text-center text-sky-600 mb-6">Connexion à votre compte</h1>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-6">
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Adresse email
                </label>
                <input
                    wire:model.defer="form.email"
                    type="email"
                    id="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                    required
                    autocomplete="email"
                />
                @error('form.email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Mot de passe
                </label>
                <input
                    wire:model.defer="form.password"
                    type="password"
                    id="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                    required
                    autocomplete="current-password"
                />
                @error('form.password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
        
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-sky-600 hover:underline float-right mt-1">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
        
            <!-- Remember Me -->
            <div class="flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="h-4 w-4 text-sky-600 focus:ring-sky-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900">
                    Se souvenir de moi
                </label>
            </div>
        
            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full bg-sky-600 text-white py-2 px-4 rounded-md hover:bg-sky-700 transition">
                    Connexion
                </button>
            </div>
        </form>


        <!-- Register Link -->
        @if (Route::has('register'))
          <p class="text-center text-sm text-gray-600 mt-6">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-cyan-600 hover:underline">Créer un compte</a>
          </p>
        @endif
      </div>
    </div>
  </div>
</div>
