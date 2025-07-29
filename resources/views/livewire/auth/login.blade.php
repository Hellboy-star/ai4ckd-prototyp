<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
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
          <div class="relative">
            <input wire:model.defer="email" type="email" id="email"
              class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-cyan-600"
              placeholder="Adresse email" autocomplete="email" required />
            <label for="email"
              class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
              Adresse email
            </label>
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
          </div>

          <!-- Password -->
          <div class="relative">
            <input wire:model.defer="password" type="password" id="password"
              class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-cyan-600"
              placeholder="Mot de passe" autocomplete="current-password" required />
            <label for="password"
              class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
              Mot de passe
            </label>
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            @if (Route::has('password.request'))
              <a class="absolute right-0 top-2 text-sm text-cyan-600 hover:underline" href="{{ route('password.request') }}">
                  Mot de passe oublié ?
              </a>
            @endif
          </div>

          <!-- Remember Me -->
          <div class="flex items-center">
            <input wire:model="remember" id="remember" type="checkbox"
              class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 block text-sm text-gray-900">
              Se souvenir de moi
            </label>
          </div>

          <!-- Submit Button -->
          <div class="relative">
            <button type="submit"
              class="bg-cyan-500 w-full text-white rounded-md px-4 py-2 hover:bg-cyan-600 transition">
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
