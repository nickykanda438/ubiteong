<x-guest-layout>
    <x-slot name="title">Connexion | Fondation KAZWAZWA</x-slot>

    <h1 class="text-2xl font-bold text-kzz-blue text-center font-title">
        Connexion
    </h1>

    <!-- Affichage des erreurs globales -->
    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <span class="font-bold">Erreur :</span> Identifiants incorrects.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block mb-2 text-sm font-semibold text-kzz-black">
                Adresse courriel
            </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-kzz-black rounded-lg focus:ring-2 focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3 outline-none transition duration-200"
                placeholder="nom@exemple.com" required autofocus autocomplete="username">
            @error('email')
                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-2 text-sm font-semibold text-kzz-black">
                Mot de passe
            </label>
            <input type="password" name="password" id="password"
                class="bg-gray-50 border @error('password') border-red-500 @else border-gray-300 @enderror text-kzz-black rounded-lg focus:ring-2 focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3 outline-none transition duration-200"
                required autocomplete="current-password" placeholder="••••••••">
            @error('password')
                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Options -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="w-4 h-4 text-kzz-blue border-gray-300 rounded focus:ring-kzz-blue">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Rester connecté</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm font-medium text-kzz-blue hover:text-kzz-green transition-colors">
                    Oublié ?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full text-white bg-kzz-blue hover:bg-[#003366] focus:ring-4 focus:outline-none focus:ring-blue-200 font-bold rounded-xl text-sm px-5 py-4 text-center transition-all shadow-lg hover:shadow-xl active:scale-[0.98] uppercase tracking-wide">
            Se connecter
        </button>

        <!-- Secondary Action -->
        @if (Route::has('register'))
            <p class="text-sm font-normal text-gray-500 text-center">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="font-bold text-kzz-green hover:underline">S'inscrire</a>
            </p>
        @endif
    </form>
</x-guest-layout>
