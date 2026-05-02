<nav x-data="{ open: false }" class="bg-white border-b border-kzz-gray sticky top-0 z-50">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Branding -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="font-title font-bold text-kzz-blue text-xl tracking-wider">
                    KAZWAZWA
                </a>
            </div>

            <!-- Desktop Actions -->
            <div class="hidden sm:flex sm:items-center">
                <div class="flex items-center gap-4">

                    <span class="text-sm font-medium text-gray-500 border-r pr-4 border-gray-200">
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

            <!-- Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-kzz-blue hover:bg-gray-100 focus:outline-none transition">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-gray-50 border-t border-gray-100">

        <div class="px-4 py-6">

            <div class="mb-4">
                @auth
                    <div class="font-bold text-base text-kzz-blue">{{ auth()->user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                @endauth
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-xl">
                    Déconnexion
                </button>
            </form>

        </div>

    </div>

</nav>
