<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Membre - {{ $membre->nom_complet }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f3f4f6;
        }

        /* Format Standard ID-1 (Carte bancaire) */
        .card-container {
            width: 85.6mm;
            height: 53.98mm;
            position: relative;
            background: white;
            overflow: hidden;
            display: flex;
            box-sizing: border-box;
        }

        .sidebar {
            width: 32%;
            background-color: #0c4a6e;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 10px 4px;
            z-index: 10;
        }

        .main-content {
            width: 68%;
            padding: 10px 14px;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 55%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            width: 65%;
            pointer-events: none;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background: none;
                padding: 0;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen p-4">

    <div class="mb-6 flex gap-4 no-print">
        <a href="{{ route('membres.index') }}"
            class="flex items-center gap-2 bg-gray-800 text-white px-5 py-2 rounded-lg font-semibold hover:bg-gray-900 transition shadow-md text-sm">
            Retour
        </a>
        <button onclick="downloadCard()"
            class="flex items-center gap-2 bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md text-sm">
            Télécharger l'image (JPG)
        </button>
    </div>

    <div id="memberCard" class="card-container rounded-xl shadow-2xl border border-gray-200">

        <div class="sidebar shadow-xl">
            <div class="text-center">
                <img src="{{ asset('images/logo_ong.png') }}" class="w-8 h-8 mx-auto mb-1 object-contain">
                <h2 class="text-[7.5px] font-black uppercase leading-tight tracking-tighter">Fondation Kazwazwa</h2>
                <p class="text-[4px] opacity-70 tracking-widest uppercase">Solidarité • Développement</p>
            </div>

            <div class="w-18 h-22 border-[1.5px] border-white/40 rounded-md overflow-hidden bg-slate-800 shadow-md">
                @if ($membre->photo_membre)
                    <img src="{{ asset('storage/' . $membre->photo_membre) }}" class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-[6px] text-gray-500">PAS DE PHOTO</div>
                @endif
            </div>

            <div class="text-center w-full px-1">
                <p class="text-[8px] font-extrabold uppercase truncate leading-none mb-1">
                    {{ Str::limit($membre->nom_complet, 20) }}</p>
                <div
                    class="bg-green-600 text-white text-[6px] py-0.5 px-2 rounded-full font-bold uppercase tracking-tight inline-block">
                    {{ $membre->fonction }}
                </div>
            </div>
        </div>

        <div class="main-content bg-white">
            <img src="{{ asset('images/logo_ong.png') }}" class="watermark">

            <div class="flex justify-between items-start border-b border-gray-100 pb-1">
                <div>
                    <h3 class="text-[5.5px] font-bold text-gray-400 uppercase tracking-[0.2em]">Carte Professionnelle
                    </h3>
                    <h1 class="text-blue-900 font-black text-[11px] uppercase leading-none mt-0.5">Fondation Kazwazwa
                    </h1>
                </div>
                <div class="text-right">
                    <img src="{{ asset('images/drc_flag.png') }}" class="w-6 h-3.5 shadow-sm rounded-sm mb-1">
                    <p class="text-[5px] font-black text-gray-800 uppercase leading-none">{{ $membre->type_membre }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-1.5 mt-2.5 flex-1">
                <div>
                    <label class="text-[5px] text-gray-400 font-bold uppercase block leading-tight">Nom complet
                        :</label>
                    <span
                        class="text-[9.5px] font-extrabold text-gray-900 uppercase leading-none">{{ $membre->nom_complet }}</span>
                </div>

                <div>
                    <label class="text-[5px] text-gray-400 font-bold uppercase block leading-tight">Fonction & Lieu
                        :</label>
                    <span class="text-[8px] font-bold text-gray-800 uppercase leading-none">
                        {{ $membre->fonction }} ({{ $membre->lieu_naissance ?? 'KINSHASA' }})
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-[5px] text-gray-400 font-bold uppercase block leading-tight">Adhésion
                            :</label>
                        <span class="text-[7.5px] font-bold text-gray-800 uppercase leading-none">
                            {{ $membre->date_adhesion ? $membre->date_adhesion->format('d/m/Y') : 'N/A' }}
                        </span>
                    </div>
                    <div>
                        <label class="text-[5px] text-gray-400 font-bold uppercase block leading-tight">Ancienneté
                            :</label>
                        <span class="text-[7.5px] font-bold text-gray-800 uppercase leading-none">
                            {{ intval($membre->anciennete) }} ans
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-end mt-auto pt-1 border-t border-gray-100">
                <div class="flex flex-col gap-1">
                    <div class="bg-slate-100 px-1.5 py-0.5 rounded border border-gray-200 inline-block">
                        <span class="text-[5.5px] font-bold text-gray-500 uppercase italic">N° :</span>
                        <span class="text-[7px] font-black text-blue-900">{{ $membre->numero_membre }}</span>
                    </div>
                    <p class="text-[5px] font-bold text-gray-500 uppercase">Expire le : <span
                            class="text-red-600 font-black">31 DÉC 2026</span></p>
                </div>

                <div class="flex items-center gap-2">
                    <div class="text-center min-w-[35px] border-r border-gray-100 pr-2">
                        <img src="{{ asset('images/signature.png') }}" class="h-4 mx-auto mb-0.5 opacity-90">
                        <p class="text-[4px] font-bold text-gray-400 uppercase leading-none">La Direction</p>
                    </div>
                    <div
                        class="p-0.5 bg-white border border-gray-200 rounded shadow-sm flex items-center justify-center">
                        {!! QrCode::size(34)->margin(0)->generate('https://votre-site.com/verifier/' . $membre->numero_membre) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute top-0 right-0 w-8 h-8 bg-orange-500 shadow-inner"
            style="clip-path: polygon(100% 0, 0 0, 100% 100%); opacity: 0.95;"></div>
    </div>

    <script>
        function downloadCard() {
            const card = document.getElementById('memberCard');
            // On augmente le scale pour une impression de haute qualité
            html2canvas(card, {
                scale: 5,
                useCORS: true,
                backgroundColor: null,
                logging: false,
                width: card.offsetWidth,
                height: card.offsetHeight
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Carte_{{ Str::slug($membre->nom_complet) }}.jpg';
                link.href = canvas.toDataURL('image/jpeg', 0.95);
                link.click();
            });
        }
    </script>
</body>

</html>
