<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de Membre - {{ $membre->nom_complet }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Configuration pour l'imprimante */
        @page {
            size: 86mm 54mm;
            margin: 0;
        }
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; background: white; }
            .card-container { box-shadow: none; border: none; }
        }
        body {
            font-family: 'sans-serif';
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>

    <div class="no-print fixed top-5 right-5">
        <button onclick="window.print()" class="bg-blue-900 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-800 transition">
            Imprimer la carte
        </button>
        <a href="{{ route('membres.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-600 transition">
            Retour
        </a>
    </div>

    <div class="card-container relative w-[86mm] h-[54mm] bg-white border border-gray-200 rounded-xl shadow-2xl overflow-hidden p-3 box-border">
        
        <div class="flex justify-between items-start mb-2">
            <div class="flex items-center gap-1.5">
                <div class="w-8 h-8 bg-blue-900 rounded-full flex items-center justify-center p-1">
                    <img src="{{ asset('images/logo_ong.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <h2 class="text-blue-900 font-black text-[12px] leading-tight uppercase">ONG ESPOIR GLOBAL</h2>
                    <p class="text-[6px] text-gray-600 font-bold uppercase tracking-tighter">Solidarité • Développement • Action</p>
                </div>
            </div>
            <div class="text-right">
                <span class="text-[7px] font-bold text-gray-800 uppercase italic">{{ $membre->type_membre }}</span>
                <div class="mt-0.5">
                    <img src="{{ asset('images/drc_flag.png') }}" alt="DRC" class="w-6 h-3.5 shadow-sm inline-block">
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <div class="flex flex-col items-center w-1/4">
                <div class="p-0.5 border border-blue-900 rounded-lg">
                    @if($membre->photo_membre)
                        <img src="{{ asset('storage/' . $membre->photo_membre) }}" class="w-16 h-20 object-cover rounded-md bg-gray-100">
                    @else
                        <div class="w-16 h-20 bg-gray-200 flex items-center justify-center text-[8px] text-center">PAS DE PHOTO</div>
                    @endif
                </div>
                <div class="mt-1 text-center">
                    <span class="bg-green-600 text-white text-[6px] font-bold px-1.5 py-0.5 rounded-full uppercase">
                        {{ $membre->qualite ?? 'Membre' }}
                    </span>
                </div>
            </div>

            <div class="flex-1 space-y-1.5">
                <h4 class="text-blue-800 font-extrabold text-[8px] border-b border-orange-400 pb-0.5 uppercase">
                    Carte de membre
                </h4>
                
                <div>
                    <span class="block text-[6px] text-gray-500 font-medium uppercase">Nom Complet :</span>
                    <span class="font-bold text-[9px] text-gray-900 uppercase">{{ $membre->nom_complet }}</span>
                </div>

                <div class="grid grid-cols-2 gap-1">
                    <div>
                        <span class="block text-[6px] text-gray-500 font-medium uppercase">Fonction :</span>
                        <span class="font-bold text-[8px] text-gray-900 uppercase leading-none">{{ $membre->fonction }}</span>
                    </div>
                    <div>
                        <span class="block text-[6px] text-gray-500 font-medium uppercase">Origine :</span>
                        <span class="font-bold text-[8px] text-gray-900 uppercase leading-none">{{ $membre->lieu_naissance ?? 'RD CONGO' }}</span>
                    </div>
                </div>

                <div>
                    <span class="block text-[6px] text-gray-500 font-medium uppercase">Adresse :</span>
                    <p class="text-[7px] font-semibold text-gray-900 uppercase leading-tight line-clamp-2">
                        {{ $membre->adresse_membre }}
                    </p>
                </div>

                <div class="flex justify-between items-end pt-1">
                    <div class="space-y-0.5">
                        <div class="bg-gray-50 border border-gray-200 rounded px-1.5 py-0.5 text-[7px]">
                            <span class="text-gray-500 uppercase italic">ID:</span> 
                            <span class="font-bold text-blue-900">{{ $membre->numero_membre }}</span>
                        </div>
                        <div class="text-[6px] font-bold text-blue-900 italic uppercase leading-none">
                            Valide : 31/12/{{ date('Y') }}
                        </div>
                    </div>
                    
                    <div class="flex gap-2 items-center">
                        <img src="{{ asset('images/qr_code.png') }}" alt="QR" class="w-8 h-8">
                        <div class="text-center">
                            <img src="{{ asset('images/signature.png') }}" alt="Sign" class="h-4">
                            <span class="block text-[5px] font-bold uppercase">Direction</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-[-10px] right-[-10px] opacity-10 pointer-events-none">
             <img src="{{ asset('images/world_map.png') }}" alt="map" class="w-24">
        </div>
    </div>

</body>
</html>