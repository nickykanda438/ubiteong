<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fondation KAZWAZWA</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-kzz-gray font-sans antialiased">

    <nav class="fixed top-0 z-50 w-full bg-kzz-blue border-b border-blue-900 shadow-md">
        <div class="px-3 py-3 lg:px-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <button data-drawer-target="sidebar" data-drawer-toggle="sidebar" class="p-2 text-white rounded-lg sm:hidden hover:bg-blue-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h10"></path></svg>
                    </button>
                    <span class="ms-4 text-xl font-title font-bold text-white uppercase tracking-wider">Fondation KAZWAZWA</span>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" class="flex items-center gap-2 bg-white/10 p-1 pr-3 rounded-full hover:bg-white/20 transition" data-dropdown-toggle="dropdown-user">
                        <div class="w-8 h-8 rounded-full bg-kzz-green flex items-center justify-center text-white font-bold text-xs font-title">AK</div>
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow-xl border border-gray-100" id="dropdown-user">
                        <div class="px-4 py-3">
                            <p class="text-sm font-bold text-kzz-black">Admin KZZ</p>
                            <p class="text-xs text-gray-500 font-sans">contact@kazwazwa.org</p>
                        </div>
                        <ul class="py-1 font-sans">
                            <li><a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-kzz-black hover:bg-kzz-gray"><svg class="w-4 h-4 text-kzz-blue" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg> Profil</a></li>
                            <li><a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 font-bold hover:bg-red-50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg> Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-kzz-blue sm:translate-x-0 border-r border-blue-900">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-kzz-blue">
            <ul class="space-y-1 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-white/10 group">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        <span class="ms-3 font-sans">Tableau de bord</span>
                    </a>
                </li>

                <li>
                    <button type="button" class="flex items-center w-full p-2 text-white rounded-lg hover:bg-white/10 group transition" data-collapse-toggle="drop-m">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                        <span class="flex-1 ms-3 text-left font-sans">Gestion Membres</span>
                        <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
                    </button>
                    <ul id="drop-m" class="py-2 space-y-1 bg-blue-900/30 rounded-lg mt-1">
                        <li><a href="#" class="block p-2 pl-11 text-xs text-blue-100 hover:text-white hover:bg-white/5 transition font-sans italic">Liste des membres</a></li>
                        <li><a href="#" class="block p-2 pl-11 text-xs text-blue-100 hover:text-white hover:bg-white/5 transition font-sans italic">Enregistrement</a></li>
                        <li><a href="#" class="block p-2 pl-11 text-xs text-blue-100 hover:text-white hover:bg-white/5 transition font-sans italic">Statistiques</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-white/10 group">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414L12.586 2H9z"></path></svg>
                        <span class="ms-3 font-sans">Documentation</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-white/10 group">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        <span class="ms-3 font-sans">Cadres ONG</span>
                    </a>
                </li>

                <li class="pt-4">
                    <a href="#" class="flex items-center p-3 text-white bg-kzz-green rounded-xl shadow-lg hover:bg-opacity-90 transition transform hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                        <span class="ms-3 font-title font-bold italic uppercase tracking-wider">Finance</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <main class="p-4 sm:ml-64 pt-24 min-h-screen bg-kzz-gray">
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>