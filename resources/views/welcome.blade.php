<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>F.KZZ/CONTSHI | Fondation Kazwazwa</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Flowbite CSS (pour carrousel) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animations personnalisées */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        /* Animation au scroll */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .scroll-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }

        html {
            scroll-behavior: smooth;
        }
    </style>

    <script>
        // Intersection Observer pour animations au scroll
        document.addEventListener('DOMContentLoaded', function () {
            const elements = document.querySelectorAll('.scroll-animate');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });
            elements.forEach(el => observer.observe(el));
        });
    </script>
</head>

<body class="font-sans bg-kzz-gray text-gray-800 antialiased overflow-x-hidden">

    <!-- NAVBAR MINIMALISTE -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
    <img src="{{ asset('images/logoubite.png') }}" alt="Logo F.KZZ/CONTSHI" class="h-10 w-auto">
    <span class="text-xl font-title font-semibold tracking-tight text-kzz-blue hover:opacity-80 transition">
        F.KZZ/CONTSHI
    </span>
</a>
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-5 py-2 text-sm font-medium text-white bg-kzz-blue rounded-full hover:bg-opacity-90 transition shadow-sm">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-5 py-2 text-sm font-medium text-kzz-blue border border-kzz-blue rounded-full hover:bg-gray-50 transition">
                            Connexion
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-5 py-2 text-sm font-medium text-white bg-kzz-blue rounded-full hover:bg-opacity-90 transition shadow-sm">
                                Inscription
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- CARROUSEL FLOWBITE (3 IMAGES) -->
    <div id="main-carousel" class="relative w-full" data-carousel="slide">
        <div class="relative h-[500px] md:h-[600px] overflow-hidden">
            <!-- Slide 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470"
                     class="absolute block w-full h-full object-cover brightness-50" alt="Développement">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                    <h2 class="text-3xl md:text-5xl font-title font-bold text-white drop-shadow-md">Développement Intégral</h2>
                    <p class="mt-3 text-lg text-white/90 max-w-2xl">Agir pour l’autonomie de chaque province de la RDC</p>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2923216?q=80&w=1469"
                     class="absolute block w-full h-full object-cover brightness-50" alt="Éducation">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                    <h2 class="text-3xl md:text-5xl font-title font-bold text-white drop-shadow-md">Éducation & Formation</h2>
                    <p class="mt-3 text-lg text-white/90 max-w-2xl">Former les cadres paysans et alphabétiser pour un avenir meilleur</p>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1470"
                     class="absolute block w-full h-full object-cover brightness-50" alt="Agriculture durable">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6">
                    <h2 class="text-3xl md:text-5xl font-title font-bold text-white drop-shadow-md">Sécurité Alimentaire</h2>
                    <p class="mt-3 text-lg text-white/90 max-w-2xl">Soutenir l’agriculture locale et lutter contre la malnutrition</p>
                </div>
            </div>
        </div>
        <!-- Indicateurs de navigation (petits points) -->
        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition" data-carousel-slide-to="2"></button>
        </div>
        <!-- Flèches gauche/droite -->
        <button type="button" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white rounded-full p-2 z-10" data-carousel-prev>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button type="button" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white rounded-full p-2 z-10" data-carousel-next>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>

    <!-- SECTION NOTRE VISION & MISSION -->
    <section class="py-20 px-6 max-w-7xl mx-auto scroll-animate">
        <div class="grid md:grid-cols-2 gap-12 items-start">
            <div>
                <h2 class="text-3xl font-title font-semibold text-kzz-blue mb-5">Notre Vision</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Initiée par l’ingénieur <span class="font-medium text-kzz-blue">KAZWAZWA UBITE Modeste</span>, la Fondation F.KZZ/CONTSHI est une ONG de développement socio‑économique et culturel créée le 20 octobre 2018.
                </p>
                <p class="text-gray-600 italic leading-relaxed mt-4 border-l-3 border-kzz-green pl-4">
                    « Développer ensemble les capacités de se prendre en charge pour un développement intégral et durable dans toutes les provinces de la RDC. »
                </p>
                <div class="flex flex-wrap gap-3 mt-8 text-sm">
                    <span class="bg-white text-kzz-blue px-4 py-1.5 rounded-full shadow-sm">Siège : Kenge, Kwango</span>
                    <span class="bg-white text-kzz-blue px-4 py-1.5 rounded-full shadow-sm">ASBL / ONG</span>
                </div>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-xl font-title font-semibold text-kzz-blue mb-3">Notre mission</h3>
                <p class="text-gray-600 leading-relaxed">
                    Lutter contre la pauvreté en exploitant les richesses agro‑écologiques et le potentiel humain de nos provinces, avec un focus particulier sur le Kwango. Nous intégrons épanouissement social, économique et culturel.
                </p>
            </div>
        </div>
    </section>

    <!-- OBJECTIFS STRATÉGIQUES -->
    <section id="objectifs" class="py-20 bg-white px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 scroll-animate">
                <h2 class="text-3xl font-title font-semibold text-kzz-blue">Nos objectifs prioritaires</h2>
                <div class="w-16 h-0.5 bg-kzz-green mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $objectifs = [
                        ['01', 'Économie & Social', 'Création de coopératives d’épargne et de crédits pour lutter contre la pauvreté.'],
                        ['02', 'Sécurité Alimentaire', 'Production agricole et lutte active contre la malnutrition dans les provinces.'],
                        ['03', 'Infrastructures', 'Réhabilitation de routes de desserte agricole et création d’écoles / centres de santé.'],
                        ['04', 'Protection & Droits', 'Lutte contre les violences faites aux vulnérables et les antivaleurs.'],
                        ['05', 'Santé & Environnement', 'Prévention VIH/SIDA, éducation environnementale et gestion durable.'],
                        ['06', 'Éducation & Formation', 'Alphabétisation, séminaires et formation des cadres paysans.'],
                    ];
                @endphp
                @foreach($objectifs as $index => $obj)
                <div class="bg-kzz-gray p-6 rounded-xl border border-gray-100 hover:border-kzz-green/30 hover:shadow-md transition-all duration-200 group scroll-animate" style="transition-delay: {{ $index * 0.1 }}s">
                    <div class="text-2xl font-light text-kzz-blue/30 mb-3 group-hover:text-kzz-green/50 transition">{{ $obj[0] }}</div>
                    <h4 class="font-bold text-kzz-blue mb-2">{{ $obj[1] }}</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $obj[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CATÉGORIES DE MEMBRES -->
    <section class="py-16 px-6 bg-kzz-gray scroll-animate">
        <div class="max-w-3xl mx-auto text-center">
            <h3 class="text-2xl font-title font-semibold text-kzz-blue mb-6">Catégories de membres</h3>
            <div class="flex flex-wrap justify-center gap-8 text-sm font-medium text-gray-600">
                <span class="flex items-center gap-2"><span class="w-3 h-3 bg-kzz-green rounded-full"></span> Membres Effectifs</span>
                <span class="flex items-center gap-2"><span class="w-3 h-3 bg-kzz-blue rounded-full"></span> Membres Sympathisants</span>
                <span class="flex items-center gap-2"><span class="w-3 h-3 bg-gray-400 rounded-full"></span> Membres d’Honneur</span>
            </div>
        </div>
    </section>

    <!-- FORMULAIRE D'ADHÉSION -->
    <section id="adhesion" class="py-20 px-6 bg-white scroll-animate">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-10">
                <h3 class="text-3xl font-title font-semibold text-kzz-blue">Adhérer à la Fondation</h3>
                <p class="text-gray-500 mt-2">Devenez acteur du développement intégral de la RDC.</p>
            </div>

            <form action="#" method="POST" class="bg-kzz-gray p-8 rounded-2xl shadow-md border border-gray-100">
                @csrf
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                        <input type="text" 
                               class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-kzz-green/50 focus:border-kzz-green transition bg-white" 
                               placeholder="Ex: Kazwazwa Ubite" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de membre</label>
                        <select class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-kzz-green/50 focus:border-kzz-green transition bg-white">
                            <option>Membre Effectif</option>
                            <option>Membre Sympathisant</option>
                            <option>Membre d'Honneur</option>
                        </select>
                    </div>
                </div>
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email ou Téléphone</label>
                    <input type="text" 
                           class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-kzz-green/50 focus:border-kzz-green transition bg-white" 
                           required>
                </div>
                <button type="submit" 
                        class="w-full py-4 bg-kzz-green text-white font-bold rounded-xl text-lg shadow-md hover:shadow-lg hover:bg-opacity-90 transition-all duration-200 transform hover:-translate-y-0.5 active:scale-95">
                    ✨ Rejoindre maintenant ✨
                </button>
                <p class="text-xs text-gray-400 text-center mt-6">
                    En adhérant, vous acceptez notre politique de confidentialité.
                </p>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 pt-16 pb-8 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-10 pb-12 border-b border-gray-800">
                <div>
                    <span class="text-xl font-title font-semibold text-white">F.KZZ/CONTSHI</span>
                    <p class="text-sm leading-relaxed mt-4">
                        ONG contribuant au développement socio‑économique et culturel des provinces de la RDC.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-medium text-sm uppercase tracking-wider mb-4">Adresse</h4>
                    <ul class="text-sm space-y-2">
                        <li>Avenue Dispensaire N°16</li>
                        <li>Kenge, Province du Kwango</li>
                        <li>République Démocratique du Congo</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium text-sm uppercase tracking-wider mb-4">Liens</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">À propos</a></li>
                        <li><a href="#objectifs" class="hover:text-white transition">Objectifs</a></li>
                        <li><a href="#adhesion" class="hover:text-white transition">Adhésion</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium text-sm uppercase tracking-wider mb-4">Mentions légales</h4>
                    <p class="text-xs italic">
                        Conformément au décret-loi N°004/2001 du 20 Juillet 2001 portant ASBL.
                    </p>
                </div>
            </div>
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-sm gap-3">
                <p class="italic">« Pour un développement intégral et durable. »</p>
                <p>© {{ date('Y') }} Fondation Kazwazwa. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Flowbite JS (pour carrousel) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>