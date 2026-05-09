<nav x-data="{ open: false }" class="bg-white border-b border-kzz-gray sticky top-0 z-50 shadow-sm">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Branding avec logo -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logoubite.png') }}" alt="Logo" class="h-9 w-auto">
                <a href="{{ route('dashboard') }}" class="font-title font-bold text-kzz-blue text-xl tracking-tight">
                    F.KZZ/CONTSHI
                </a>
            </div>

            <!-- Desktop Actions -->
            <div class="hidden sm:flex sm:items-center">
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-gray-600 border-r pr-4 border-gray-200">
                        @auth
                            {{ auth()->user()->name }}
                        @endauth
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 bg-kzz-blue hover:bg-kzz-green text-white text-xs font-bold rounded-lg transition-all duration-200 shadow-sm uppercase tracking-widest">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-kzz-blue hover:bg-kzz-gray focus:outline-none transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu avec animation -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="sm:hidden bg-kzz-gray border-t border-gray-100" style="display: none;">

        <div class="px-4 py-6 space-y-4">

            <!-- Infos utilisateur -->
            <div class="border-b border-gray-200 pb-3">
                @auth
                    <div class="font-bold text-base text-kzz-blue">{{ auth()->user()->name }}</div>
                    <div class="text-sm text-gray-600">{{ auth()->user()->email }}</div>
                @endauth
            </div>

            <!-- Bouton déconnexion (uniforme) -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full px-4 py-3 bg-kzz-blue hover:bg-kzz-green text-white font-bold rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>