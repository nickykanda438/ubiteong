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
        body { font-family: 'Montserrat', sans-serif; background-color: #f3f4f6; }
        .card-container { width: 86mm; height: 54mm; position: relative; background: white; overflow: hidden; display: flex; }
        .sidebar { width: 32%; background-color: #0c4a6e; color: white; display: flex; flex-direction: column; align-items: center; justify-content: space-between; padding: 8px 4px; z-index: 10; }
        .main-content { width: 68%; padding: 8px 12px; position: relative; display: flex; flex-direction: column; justify-content: space-between; }
        .watermark { position: absolute; top: 50%; left: 55%; transform: translate(-50%, -50%); opacity: 0.04; width: 70%; pointer-events: none; }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-4">

    <div class="mb-6 flex gap-4 no-print">
        <a href="{{ route('membres.index') }}" class="flex items-center gap-2 bg-gray-800 text-white px-5 py-2 rounded-lg font-semibold hover:bg-gray-900 transition shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour
        </a>
        <button onclick="downloadCard()" class="flex items-center gap-2 bg-green-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-700 transition shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Télécharger JPG
        </button>
    </div>

    <div id="memberCard" class="card-container rounded-xl shadow-2xl border border-gray-200">
        
        <div class="sidebar shadow-xl">
            <div class="text-center">
                <img src="{{ asset('images/logo_ong.png') }}" class="w-9 h-9 mx-auto mb-1 object-contain">
                <h2 class="text-[7px] font-black uppercase leading-tight">Fondation Kazwazwa</h2>
                <p class="text-[3.5px] opacity-70 tracking-widest leading-tight">SOLIDARITÉ • DÉVELOPPEMENT</p>
            </div>

            <div class="w-20 h-24 border-[1.5px] border-white/30 rounded-lg overflow-hidden bg-slate-800 shadow-lg">
                @if($membre->photo_membre)
                    <img src="{{ asset('storage/' . $membre->photo_membre) }}" class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-[6px] text-gray-400">PHOTO</div>
                @endif
            </div>

            <div class="text-center w-full px-1">
                <p class="text-[8px] font-extrabold uppercase truncate leading-tight">{{ $membre->nom_complet }}</p>
                <div class="mt-1 bg-green-600 text-white text-[7px] py-0.5 px-2 rounded-full font-bold uppercase tracking-tighter inline-block">
                    {{ $membre->fonction }}
                </div>
            </div>
        </div>

        <div class="main-content bg-white">
            <img src="{{ asset('images/logo_ong.png') }}" class="watermark">

            <div class="flex justify-between items-start border-b border-gray-100 pb-1">
                <div>
                    <h3 class="text-[5.5px] font-bold text-gray-400 uppercase tracking-widest">Carte de Membre Professionnel</h3>
                    <h1 class="text-blue-900 font-black text-[10px] uppercase leading-none mt-0.5">Fondation Kazwazwa</h1>
                </div>
                <div class="text-right">
                    <p class="text-[5px] font-black text-gray-800 uppercase leading-none mb-1">{{ $membre->type_membre }}</p>
                    <img src="{{ asset('images/drc_flag.png') }}" class="w-6 h-3.5 shadow-sm rounded-sm inline-block">
                </div>
            </div>

            <div class="flex flex-col gap-1.5 mt-2">
                <div class="flex gap-4">
                    <div class="min-w-[70px]">
                        <label class="text-[5px] text-gray-400 font-bold uppercase block">Nom :</label>
                        <span class="text-[9px] font-extrabold text-gray-900 uppercase leading-none">{{ explode(' ', $membre->nom_complet)[0] }}</span>
                    </div>
                    <div>
                        <label class="text-[5px] text-gray-400 font-bold uppercase block">Postnom :</label>
                        <span class="text-[9px] font-extrabold text-gray-900 uppercase leading-none">{{ explode(' ', $membre->nom_complet)[1] ?? '' }}</span>
                    </div>
                </div>

                <div>
                    <label class="text-[5px] text-gray-400 font-bold uppercase block">Fonction :</label>
                    <span class="text-[8px] font-bold text-gray-800 uppercase leading-none">{{ $membre->fonction }} ({{ $membre->lieu_naissance ?? 'KENGE' }})</span>
                </div>

                <div>
                    <label class="text-[5px] text-gray-400 font-bold uppercase block">Adresse :</label>
                    <span class="text-[6.5px] font-semibold text-gray-600 uppercase leading-tight line-clamp-1 italic">
                        {{ $membre->adresse_membre }}
                    </span>
                </div>
            </div>

            <div class="flex justify-between items-end mt-auto pt-1 border-t border-gray-50">
                <div class="flex flex-col gap-1">
                    <div class="bg-slate-100 px-1.5 py-0.5 rounded border border-gray-200 inline-block">
                        <span class="text-[5px] font-bold text-gray-500 uppercase">N° :</span>
                        <span class="text-[6px] font-black text-blue-900">{{ $membre->numero_membre }}</span>
                    </div>
                    <p class="text-[5px] font-bold text-gray-500">VALIDE : <span class="text-red-600">31 DÉC 2026</span></p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="p-0.5 bg-white border border-gray-200 rounded shadow-sm flex items-center justify-center">
                        {!! QrCode::size(32)->margin(0)->generate("ID: $membre->numero_membre | Nom: $membre->nom_complet") !!}
                    </div>
                    <div class="text-center min-w-[40px]">
                        <img src="{{ asset('images/signature.png') }}" class="h-4 mx-auto mb-0.5">
                        <p class="text-[4px] font-bold text-gray-400 uppercase leading-none">Direction</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute top-0 right-0 w-6 h-6 bg-orange-500" style="clip-path: polygon(100% 0, 0 0, 100% 100%); opacity: 0.9;"></div>
    </div>

    <script>
        function downloadCard() {
            const card = document.getElementById('memberCard');
            html2canvas(card, {
                scale: 4, // Très haute résolution
                useCORS: true,
                backgroundColor: null,
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Carte_{{ Str::slug($membre->nom_complet) }}.jpg';
                link.href = canvas.toDataURL('image/jpeg', 1.0);
                link.click();
            });
        }
    </script>
</body>
</html>