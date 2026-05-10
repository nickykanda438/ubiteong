<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>F.KZZ/CONTSHI | Fondation Kazwazwa</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        kzz: {
                            blue: '#1e40af',
                            green: '#10b981',
                            dark: '#0f172a',
                            light: '#f8fafc'
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Animations fluides */
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        
        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(30, 64, 175, 0.15), transparent),
                        radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.1), transparent);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="bg-kzz-light text-slate-900 antialiased">

    <nav class="glass-nav fixed w-full z-50 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logoubite.png') }}" class="h-10" alt="Logo">
                <span class="self-center text-xl font-extrabold tracking-tighter text-kzz-blue">F.KZZ/CONTSHI</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse gap-2">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-white bg-kzz-blue hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-full text-sm px-6 py-2.5 text-center transition-all transform hover:scale-105">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-kzz-blue hover:bg-gray-100 font-semibold text-sm px-4 py-2.5">Connexion</a>
                        <a href="{{ route('register') }}" class="text-white bg-kzz-dark hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-bold rounded-full text-sm px-6 py-2.5 text-center shadow-lg transition-all">S'inscrire</a>
                    @endauth
                @endif
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li><a href="#" class="block py-2 px-3 text-kzz-blue md:p-0 font-bold" aria-current="page">Accueil</a></li>
                    <li><a href="#vision" class="block py-2 px-3 text-gray-900 hover:text-kzz-blue md:p-0 transition">Vision</a></li>
                    <li><a href="#objectifs" class="block py-2 px-3 text-gray-900 hover:text-kzz-blue md:p-0 transition">Objectifs</a></li>
                    <li><a href="#adhesion" class="block py-2 px-3 text-gray-900 hover:text-kzz-blue md:p-0 transition">Adhésion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="relative pt-20">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative h-[550px] md:h-[750px] overflow-hidden">
                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470" class="absolute block w-full h-full object-cover brightness-50" alt="...">
                    <div class="absolute inset-0 flex items-center justify-center text-center p-4 bg-black/20">
                        <div class="max-w-4xl reveal active">
                            <span class="bg-kzz-green text-white text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest mb-6 inline-block">Impact Social</span>
                            <h1 class="text-4xl md:text-7xl font-extrabold text-white mb-6 leading-tight">Développement <span class="text-kzz-green">Intégral</span></h1>
                            <p class="text-lg md:text-xl text-gray-200 mb-10 font-light">Agir concrètement pour l’autonomie de chaque province de la RDC.</p>
                            <a href="#adhesion" class="bg-white text-kzz-dark hover:bg-kzz-blue hover:text-white px-10 py-4 rounded-full font-bold text-lg transition-all shadow-2xl">Commencer l'aventure</a>
                        </div>
                    </div>
                </div>
                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                    <img src="https://images.unsplash.com/photo-1521791136064-7986c2923216?q=80&w=1469" class="absolute block w-full h-full object-cover brightness-50" alt="...">
                    <div class="absolute inset-0 flex items-center justify-center text-center p-4">
                        <div class="max-w-4xl">
                            <h1 class="text-4xl md:text-7xl font-extrabold text-white mb-6 leading-tight">Éducation pour <span class="text-blue-400">Tous</span></h1>
                            <p class="text-lg md:text-xl text-gray-200 mb-8 font-light">Former les cadres paysans pour bâtir un Congo nouveau.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute z-30 flex -translate-x-1/2 bottom-10 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-12 h-1.5 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-12 h-1.5 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            </div>
        </div>
    </section>

    <section id="vision" class="py-24 hero-gradient relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <div class="inline-flex items-center gap-2 text-kzz-blue font-bold text-sm uppercase tracking-widest mb-4">
                    <span class="w-10 h-px bg-kzz-blue"></span> À propos de nous
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-kzz-dark mb-8 leading-snug">Une vision noble pour le <span class="text-kzz-blue">Congo</span>.</h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-6">
                    Sous l'impulsion de l'ingénieur <span class="font-bold text-kzz-dark underline decoration-kzz-green decoration-4">KAZWAZWA UBITE Modeste</span>, notre fondation transforme les défis en opportunités depuis 2018.
                </p>
                <blockquote class="p-6 bg-white border-l-8 border-kzz-green shadow-xl rounded-r-2xl italic text-xl text-slate-700">
                    « Développer ensemble les capacités de se prendre en charge pour un développement intégral et durable. »
                </blockquote>
            </div>
            <div class="grid grid-cols-2 gap-4 reveal">
                <div class="space-y-4 pt-12">
                    <img class="rounded-3xl shadow-2xl hover:scale-105 transition duration-500" src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=500" alt="">
                    <div class="bg-kzz-blue p-8 rounded-3xl text-white shadow-xl">
                        <p class="text-4xl font-black mb-2">100%</p>
                        <p class="text-sm font-bold opacity-80 uppercase">Engagement Provincial</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-kzz-green p-8 rounded-3xl text-white shadow-xl">
                        <p class="text-4xl font-black mb-2">ASBL</p>
                        <p class="text-sm font-bold opacity-80 uppercase">Statut Officiel</p>
                    </div>
                    <img class="rounded-3xl shadow-2xl hover:scale-105 transition duration-500" src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=500" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="objectifs" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20 reveal">
                <h2 class="text-4xl font-extrabold text-kzz-dark mb-6">Nos piliers stratégiques</h2>
                <p class="text-slate-500 text-lg">Nous intervenons sur les leviers essentiels pour éradiquer la pauvreté de manière durable.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $objectifs = [
                        ['icon' => 'scale', 'title' => 'Économie & Social', 'desc' => 'Coopératives d’épargne et crédits pour l’autonomisation financière.'],
                        ['icon' => 'leaf', 'title' => 'Sécurité Alimentaire', 'desc' => 'Agriculture durable et lutte contre la malnutrition infantile.'],
                        ['icon' => 'truck', 'title' => 'Infrastructures', 'desc' => 'Routes agricoles, centres de santé et écoles modernes.'],
                        ['icon' => 'shield', 'title' => 'Protection & Droits', 'desc' => 'Défense des vulnérables et lutte contre les antivaleurs.'],
                        ['icon' => 'heart', 'title' => 'Santé & Climat', 'desc' => 'Prévention VIH/SIDA et gestion durable de l’environnement.'],
                        ['icon' => 'academic', 'title' => 'Formation', 'desc' => 'Alphabétisation fonctionnelle et séminaires paysans.'],
                    ];
                @endphp

                @foreach($objectifs as $obj)
                <div class="group p-10 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 reveal">
                    <div class="w-14 h-14 bg-white group-hover:bg-kzz-blue group-hover:text-white text-kzz-blue rounded-2xl flex items-center justify-center mb-6 shadow-sm transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-kzz-dark mb-4 group-hover:text-kzz-blue transition-colors">{{ $obj['title'] }}</h3>
                    <p class="text-slate-500 leading-relaxed">{{ $obj['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="adhesion" class="py-24 hero-gradient relative">
        <div class="max-w-5xl mx-auto px-6 bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col md:flex-row reveal">
            <div class="md:w-1/2 bg-kzz-dark p-12 text-white flex flex-col justify-center">
                <h3 class="text-3xl font-black mb-6 leading-tight">Rejoignez le mouvement du <span class="text-kzz-green">Changement</span>.</h3>
                <p class="text-slate-400 mb-8">Devenez membre effectif, sympathisant ou d'honneur et contribuez à l'essor de la RDC.</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-slate-800/50 p-4 rounded-2xl">
                        <div class="w-3 h-3 bg-kzz-green rounded-full animate-pulse"></div>
                        <span class="text-sm font-bold">Inscriptions ouvertes 2026</span>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 p-12">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
                        <p class="text-sm font-bold text-red-700 mb-2">Erreurs détectées :</p>
                        <ul class="text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-4">
                        <p class="text-sm font-bold text-green-700">✓ {{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('adhesion.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700">Nom Complet</label>
                        <input type="text" name="nom_complet" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-4 transition" placeholder="Modeste Kazwazwa" value="{{ old('nom_complet') }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700">Email ou Téléphone</label>
                        <input type="text" name="email_ou_telephone" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-4 transition" placeholder="contact@domaine.com" value="{{ old('email_ou_telephone') }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700">Catégorie</label>
                        <select name="categorie" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-4 transition" required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            <option value="Membre Effectif" {{ old('categorie') == 'Membre Effectif' ? 'selected' : '' }}>Membre Effectif</option>
                            <option value="Membre Sympathisant" {{ old('categorie') == 'Membre Sympathisant' ? 'selected' : '' }}>Membre Sympathisant</option>
                            <option value="Membre d'Honneur" {{ old('categorie') == 'Membre d\'Honneur' ? 'selected' : '' }}>Membre d'Honneur</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full text-white bg-kzz-blue hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-black rounded-2xl text-lg px-5 py-5 text-center shadow-lg transition-all transform active:scale-95 uppercase tracking-wider">
                        Envoyer ma candidature
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-kzz-dark text-slate-400 py-16 px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-12 border-b border-slate-800 pb-16">
            <div class="col-span-2">
                <span class="text-2xl font-black text-white mb-6 block">F.KZZ/CONTSHI</span>
                <p class="max-w-sm leading-relaxed mb-8">
                    Organisation Non Gouvernementale dédiée au développement socio-économique et culturel des provinces de la République Démocratique du Congo.
                </p>
                <div class="flex space-x-5">
                    <a href="#" class="text-white hover:text-kzz-green"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10s-10 4.48-10 10c0 4.89 3.53 9.03 8.32 9.79v-6.92h-2.52v-2.87h2.52v-2.18c0-2.48 1.48-3.85 3.73-3.85 1.08 0 2.2.19 2.2.19v2.42h-1.24c-1.23 0-1.62.76-1.62 1.54v1.88h2.72l-.44 2.87h-2.28v6.92c4.79-.76 8.32-4.9 8.32-9.79z"/></svg></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Navigation</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="#" class="hover:text-white">Accueil</a></li>
                    <li><a href="#vision" class="hover:text-white">Notre Vision</a></li>
                    <li><a href="#objectifs" class="hover:text-white">Objectifs</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Contact</h4>
                <ul class="space-y-4 text-sm">
                    <li>Avenue Dispensaire N°16, Kenge</li>
                    <li>Province du Kwango, RDC</li>
                    <li class="text-white font-bold">info@fondation-kzz.org</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-8 flex flex-col md:flex-row justify-between items-center text-xs gap-4">
            <p>© {{ date('Y') }} Fondation Kazwazwa. <span class="italic font-bold text-kzz-green">Pour un développement durable.</span></p>
            <p>Conçu avec excellence pour F.KZZ</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        // Reveal on scroll
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 100;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        // Trigger initial check
        reveal();
    </script>
</body>
</html>