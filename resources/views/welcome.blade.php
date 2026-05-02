<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>F.KZZ/CONTSHI | Fondation Kazwazwa</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="font-sans bg-kzz-gray text-kzz-black antialiased">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center">
                <span
                    class="self-center text-2xl font-title font-bold text-kzz-blue tracking-tight">F.KZZ/CONTSHI</span>
            </a>

            <div class="flex md:order-2 space-x-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-white bg-kzz-blue hover:bg-opacity-90 font-medium rounded-lg text-sm px-5 py-2.5 transition">Mon
                            Tableau de Bord</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="py-2.5 px-5 text-sm font-medium text-kzz-blue focus:outline-none bg-white rounded-lg border border-kzz-blue hover:bg-gray-100 transition">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-white bg-kzz-blue hover:bg-opacity-90 font-medium rounded-lg text-sm px-5 py-2.5 transition">Inscription</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- CARROUSEL (HAUTEUR AUGMENTÉE) -->
    <div id="main-carousel" class="relative w-full" data-carousel="slide">
        <div class="relative h-[450px] overflow-hidden md:h-[650px]">
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1470"
                    class="absolute block w-full h-full object-cover" alt="Développement">
                <div class="absolute inset-0 bg-kzz-blue/40 flex flex-col items-center justify-center text-white p-4">
                    <h1 class="text-4xl md:text-6xl font-title font-bold text-center uppercase drop-shadow-md">
                        Développement Intégral
                    </h1>
                    <p class="mt-4 text-xl md:text-2xl font-light">Une vision pour toutes les provinces de la RDC</p>
                </div>
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2923216?q=80&w=1469"
                    class="absolute block w-full h-full object-cover" alt="Éducation">
                <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-white p-4">
                    <h1 class="text-4xl md:text-6xl font-title font-bold text-center uppercase drop-shadow-md">F.KZZ /
                        CONTSHI</h1>
                    <p class="mt-4 text-xl md:text-2xl font-light">Engagement social depuis 2018</p>
                </div>
            </div>
        </div>
    </div>

    <!-- PRÉSENTATION & IDENTITÉ -->
    <section class="py-16 bg-white">
        <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-title font-bold text-kzz-blue mb-6">Notre Vision</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Sur l’initiative de l’ingénieur KAZWAZWA UBITE Modeste, la Fondation F.KZZ/CONTSHI est une ONG
                    de développement à caractère socio-économique et culturel créée le 20 octobre 2018.
                </p>
                <p class="text-gray-600 leading-relaxed italic border-l-4 border-kzz-green pl-4">
                    "Développer ensemble les capacités de se prendre en charge pour un développement intégral et durable
                    dans toutes les provinces de la RDC."
                </p>
                <div class="mt-6 flex flex-wrap gap-4 text-sm">
                    <span class="bg-gray-100 text-kzz-blue px-3 py-1 rounded-full font-medium italic">Siège : Kenge,
                        Prov. du Kwango</span>
                    <span class="bg-gray-100 text-kzz-blue px-3 py-1 rounded-full font-medium italic">Statut : ASBL /
                        ONG</span>
                </div>
            </div>
            <div class="bg-kzz-gray p-8 rounded-2xl border border-gray-100">
                <h3 class="text-xl font-title font-bold text-kzz-blue mb-4">But de l'organisation</h3>
                <p class="text-gray-600">
                    Notre mission intègre des actions d’épanouissement socio-économiques et culturelles. Nous luttons
                    contre la pauvreté grandissante en exploitant les richesses agro-écologiques et le potentiel humain
                    de nos provinces, avec un focus particulier sur les défis de la province du Kwango.
                </p>
            </div>
        </div>
    </section>

    <!-- OBJECTIFS STRATÉGIQUES (Grille moderne) -->
    <section class="py-16 bg-kzz-gray">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-title font-bold text-kzz-blue">Nos Objectifs Prioritaires</h2>
                <div class="h-1 w-20 bg-kzz-green mx-auto mt-4 rounded"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Objectif 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div
                        class="w-10 h-10 bg-kzz-blue text-white flex items-center justify-center rounded-lg mb-4 font-bold">
                        01</div>
                    <h4 class="font-bold text-kzz-blue mb-2">Économie & Social</h4>
                    <p class="text-sm text-gray-600 leading-snug">Création de coopératives d'épargne et de crédits pour
                        lutter contre la pauvreté.</p>
                </div>
                <!-- Objectif 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div
                        class="w-10 h-10 bg-kzz-blue text-white flex items-center justify-center rounded-lg mb-4 font-bold">
                        02</div>
                    <h4 class="font-bold text-kzz-blue mb-2">Sécurité Alimentaire</h4>
                    <p class="text-sm text-gray-600 leading-snug">Production agricole et lutte active contre la
                        malnutrition dans les provinces.</p>
                </div>
                <!-- Objectif 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div
                        class="w-10 h-10 bg-kzz-blue text-white flex items-center justify-center rounded-lg mb-4 font-bold">
                        03</div>
                    <h4 class="font-bold text-kzz-blue mb-2">Infrastructures</h4>
                    <p class="text-sm text-gray-600 leading-snug">Réhabilitation de routes de desserte agricole et
                        création d'écoles/centres de santé.</p>
                </div>
                <!-- Objectif 4 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div
                        class="w-10 h-10 bg-kzz-blue text-white flex items-center justify-center rounded-lg mb-4 font-bold">
                        04</div>
                    <h4 class="font-bold text-kzz-blue mb-2">Protection & Droits</h4>
                    <p class="text-sm text-gray-600 leading-snug">Lutte contre les violences faites aux vulnérables et
                        contre les antivaleurs.</p>
                </div>
                <!-- Objectif 5 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div
                        class="w-10 h-10 bg-kzz-blue text-white flex items-center justify-center rounded-lg mb-4 font-bold">
                        05</div>
                    <h4 class="font-bold text-kzz-blue mb-2">Santé & Environnement</h4>
                    <p class="text-sm text-gray-600 leading-snug">Vulgarisation des techniques contre le VIH/SIDA et
                        gestion saine de l'environnement.</p>
                </div>
                <!-- Objectif 6 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div
                        class="w-10 h-10 bg-kzz-blue text-white flex items-center justify-center rounded-lg mb-4 font-bold">
                        06</div>
                    <h4 class="font-bold text-kzz-blue mb-2">Éducation & Formation</h4>
                    <p class="text-sm text-gray-600 leading-snug">Cours d'alphabétisation, séminaires et formation des
                        cadres paysans.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TYPES DE MEMBRES -->
    <section class="py-16 bg-white">
        <div class="max-w-screen-xl mx-auto px-4">
            <h3 class="text-2xl font-title font-bold text-kzz-blue mb-8 text-center">Catégories de Membres</h3>
            <div class="flex flex-wrap justify-center gap-8">
                <div class="flex items-center space-x-3">
                    <div class="w-4 h-4 bg-kzz-green rounded-full"></div>
                    <span class="font-medium">Membres Effectifs</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-4 h-4 bg-kzz-blue rounded-full"></div>
                    <span class="font-medium">Membres Sympathisants</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-4 h-4 bg-gray-400 rounded-full"></div>
                    <span class="font-medium">Membres d'Honneur</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FORMULAIRE D'ADHÉSION -->
    <section class="py-16 px-4 bg-kzz-blue text-white">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <h3 class="text-3xl font-title font-bold">Formulaire d'adhésion</h3>
                <p class="text-blue-200 mt-2">Contribuez vous aussi au développement intégral de la RDC.</p>
            </div>

            <form action="#" method="POST" class="bg-white p-8 rounded-xl shadow-2xl text-kzz-black">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium">Nom complet</label>
                        <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-kzz-blue"
                            placeholder="Ex: Kazwazwa Ubite" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium">Type de membre souhaité</label>
                        <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-kzz-blue">
                            <option>Membre Effectif</option>
                            <option>Membre Sympathisant</option>
                            <option>Membre d'Honneur</option>
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium">Email / Téléphone</label>
                    <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-kzz-blue"
                        required>
                </div>
                <button type="submit"
                    class="w-full py-4 text-white bg-kzz-green hover:bg-opacity-90 font-bold rounded-lg text-lg shadow-lg">
                    Rejoindre la Fondation
                </button>
            </form>
        </div>
    </section>

    <!-- FOOTER RÉALIGNÉ -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Col 1: Branding -->
                <div class="col-span-1">
                    <span class="text-2xl font-title font-bold">F.KZZ/CONTSHI</span>
                    <p class="text-gray-400 text-sm mt-4 leading-relaxed">
                        Organisation Non Gouvernementale contribuant à l'effort du développement au niveau des provinces
                        de la RDC.
                    </p>
                </div>

                <!-- Col 2: Contact -->
                <div>
                    <h4 class="font-bold text-white mb-6 uppercase text-sm tracking-wider">Contact</h4>
                    <ul class="text-gray-400 text-sm space-y-3">
                        <li>Avenue Dispensaire N°16</li>
                        <li>Ville de Kenge, Province du Kwango</li>
                        <li>République Démocratique du Congo</li>
                    </ul>
                </div>

                <!-- Col 3: Navigation rapide -->
                <div>
                    <h4 class="font-bold text-white mb-6 uppercase text-sm tracking-wider">Liens rapides</h4>
                    <ul class="text-gray-400 text-sm space-y-3">
                        <li><a href="#" class="hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="hover:text-white transition">Objectifs</a></li>
                        <li><a href="#" class="hover:text-white transition">Adhésion</a></li>
                    </ul>
                </div>

                <!-- Col 4: Légal -->
                <div>
                    <h4 class="font-bold text-white mb-6 uppercase text-sm tracking-wider">Mentions légales</h4>
                    <p class="text-gray-500 text-xs italic leading-relaxed">
                        Conformément au décret-loi N°004/2001 du 20 Juillet 2001 portant dispositions générales
                        applicables aux ASBL.
                    </p>
                </div>
            </div>

            <!-- Bottom footer -->
            <div
                class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-4">
                <p class="text-sm text-gray-500 italic">"Pour un développement intégral et durable."</p>
                <p class="text-sm text-gray-400">© {{ date('Y') }} Fondation Kazwazwa. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
