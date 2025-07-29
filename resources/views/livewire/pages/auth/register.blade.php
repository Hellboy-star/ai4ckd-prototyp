<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex font-poppins items-center justify-center dark:bg-gray-900 min-w-screen min-h-screen">
    <div class="grid gap-8">
        <div id="back-div" class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-[26px] m-4">
            <div class="border-[20px] border-transparent rounded-[20px] dark:bg-gray-900 bg-white shadow-lg xl:p-10 2xl:p-10 lg:p-10 md:p-10 sm:p-2 m-2">
                <h1 class="pt-8 pb-6 font-bold text-5xl dark:text-gray-400 text-center cursor-default">Sign Up</h1>
                <form wire:submit="register" class="space-y-4">
                    <!-- Nom -->
                    <div>
                        <label for="name" class="mb-2 dark:text-gray-400 text-lg">Nom</label>
                        <input id="name" type="text" wire:model="name" placeholder="Nom"
                            class="border dark:bg-indigo-700 dark:text-gray-300 dark:border-gray-700 p-3 shadow-md placeholder:text-base border-gray-300 rounded-lg w-full focus:scale-105 ease-in-out duration-300" />
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="mb-2 dark:text-gray-400 text-lg">Email</label>
                        <input id="email" type="email" wire:model="email" placeholder="Email"
                            class="border dark:bg-indigo-700 dark:text-gray-300 dark:border-gray-700 p-3 shadow-md placeholder:text-base border-gray-300 rounded-lg w-full focus:scale-105 ease-in-out duration-300" />
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="mb-2 dark:text-gray-400 text-lg">Mot de passe</label>
                        <input id="password" type="password" wire:model="password" placeholder="Mot de passe"
                            class="border dark:bg-indigo-700 dark:text-gray-300 dark:border-gray-700 p-3 mb-2 shadow-md placeholder:text-base border-gray-300 rounded-lg w-full focus:scale-105 ease-in-out duration-300" />
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirmation -->
                    <div>
                        <label for="password_confirmation" class="mb-2 dark:text-gray-400 text-lg">Confirmation</label>
                        <input id="password_confirmation" type="password" wire:model="password_confirmation" placeholder="Confirmez"
                            class="border dark:bg-indigo-700 dark:text-gray-300 dark:border-gray-700 p-3 mb-2 shadow-md placeholder:text-base border-gray-300 rounded-lg w-full focus:scale-105 ease-in-out duration-300" />
                        @error('password_confirmation') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bouton -->
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-purple-500 shadow-lg mt-6 p-2 text-white rounded-lg w-full hover:scale-105 hover:from-purple-500 hover:to-blue-500 transition duration-300 ease-in-out">
                        S'inscrire
                    </button>
                </form>
                <div class="flex flex-col mt-4 items-center justify-center text-sm">
                    <h3>
                        <span class="cursor-default dark:text-gray-300">Déjà inscrit ?</span>
                        <a href="{{ route('login') }}"
                            class="group text-blue-400 transition-all duration-100 ease-in-out">
                            <span
                                class="bg-left-bottom ml-1 bg-gradient-to-r from-blue-400 to-blue-400 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
                                Se connecter
                            </span>
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
