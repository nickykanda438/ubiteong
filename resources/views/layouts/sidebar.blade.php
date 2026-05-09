    <!-- NAVBAR AVEC LOGO -->
    <nav class="fixed top-0 z-50 w-full bg-kzz-blue border-b border-white/10 shadow-lg">
        <div class="px-4 py-2 lg:px-6">
            <div class="flex items-center justify-between">
                <!-- Logo + Texte -->
                <div class="flex items-center gap-3">
                    <button data-drawer-target="sidebar" data-drawer-toggle="sidebar"
                        class="p-2 text-white rounded-lg sm:hidden hover:bg-white/10 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h10"></path>
                        </svg>
                    </button>
                    <img src="{{ asset('images/logoubite.png') }}" alt="Logo" class="h-9 w-auto">
                    <span class="text-xl font-title font-bold text-white uppercase tracking-wider">Fondation KAZWAZWA</span>
                </div>

                <!-- Menu utilisateur -->
                <div class="flex items-center gap-3">
                    <button type="button"
                        class="flex items-center gap-2 bg-white/10 p-1 pr-3 rounded-full hover:bg-white/20 transition"
                        data-dropdown-toggle="dropdown-user">
                        <div class="w-8 h-8 rounded-full bg-kzz-green flex items-center justify-center text-white font-bold text-xs font-title shadow-md">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-xl shadow-xl border border-gray-100"
                        id="dropdown-user">
                        <div class="px-4 py-3">
                            <p class="text-sm font-bold text-kzz-black">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <ul class="py-1">
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-2 px-4 py-2 text-sm text-kzz-black hover:bg-kzz-gray transition">
                                    <svg class="w-4 h-4 text-kzz-blue" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                    </svg> Profil
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 font-medium hover:bg-red-50 w-full text-left transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR AMÉLIORÉ -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-all duration-300 -translate-x-full bg-kzz-blue sm:translate-x-0 shadow-xl">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-kzz-blue">
            <ul class="space-y-1.5 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="sidebar-link flex items-center p-2.5 text-white rounded-lg group transition">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        <span class="ms-3">Tableau de bord</span>
                    </a>
                </li>

                <!-- Gestion Membres avec dropdown -->
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2.5 text-white rounded-lg hover:bg-white/10 transition group"
                        data-collapse-toggle="drop-m">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                        <span class="flex-1 ms-3 text-left">Gestion Membres</span>
                        <svg class="w-3 h-3 text-white transition-transform duration-200" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="drop-m" class="hidden py-2 space-y-1 bg-blue-900/30 rounded-lg mt-1">
                        <li><a href="{{ route('membres.index') }}"
                                class="dropdown-item block p-2 pl-11 text-xs text-blue-100 hover:text-white transition font-sans">Liste des membres</a></li>
                        <li><a href="{{ route('membres.create') }}"
                                class="dropdown-item block p-2 pl-11 text-xs text-blue-100 hover:text-white transition font-sans">Enregistrement</a></li>
                    </ul>
                </li>

                <!-- Documentation -->
                <li>
                    <a href="{{ route('documents.index') }}"
                       class="sidebar-link flex items-center p-2.5 text-white rounded-lg group transition">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414L12.586 2H9z"></path>
                        </svg>
                        <span class="ms-3">Documentation</span>
                    </a>
                </li>

                <!-- Cadres ONG -->
                <li>
                    <a href="{{ route('cadres.index') }}"
                       class="sidebar-link flex items-center p-2.5 text-white rounded-lg group transition">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ms-3">Cadres ONG</span>
                    </a>
                </li>

                <!-- Communication -->
                <li>
                    <a href="{{ route('communication.index') }}"
                       class="sidebar-link flex items-center p-2.5 text-white rounded-lg group transition">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"></path>
                        </svg>
                        <span class="ms-3">Communication</span>
                    </a>
                </li>

                <!-- Finance (bouton mis en avant) -->
                <li class="pt-6">
                    <a href="{{ route('finance.index') }}"
                       class="flex items-center p-3 text-white bg-kzz-green rounded-xl shadow-lg hover:shadow-xl hover:bg-opacity-90 transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ms-3 font-title font-bold uppercase tracking-wide">Finance</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- ESPACE POUR LE CONTENU PRINCIPAL (à utiliser dans les pages enfants) -->
    <main class="sm:ml-64 pt-20 p-6">
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        // Gestion de l'icône du dropdown (rotation)
        document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                const target = document.querySelector(button.getAttribute('data-collapse-toggle'));
                const arrow = button.querySelector('svg:last-child');
                if (target.classList.contains('hidden')) {
                    target.classList.remove('hidden');
                    arrow.style.transform = 'rotate(180deg)';
                } else {
                    target.classList.add('hidden');
                    arrow.style.transform = 'rotate(0deg)';
                }
            });
        });
    </script>