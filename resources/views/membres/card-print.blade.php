<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Officielle - {{ $membre->nom_complet }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #e5e7eb; }

        .card-container {
            width: 85.6mm;
            height: 53.98mm;
            background: white;
            border-radius: 4mm;
            display: flex;
            overflow: hidden;
            position: relative; 
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            width: 30%;
            background: #0f172a;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 5px;
            z-index: 10;
        }

        .main-content {
            width: 70%;
            padding: 15px 20px;
            position: relative;
        }

        /* Fix QR Code Absolu */
        .qr-anchor {
            position: absolute;
            bottom: 12px;  
            right: 12px;   
            background: white;
            padding: 3px;
            border-radius: 6px;
            border: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .label-style { font-size: 5px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; }
        .value-style { font-size: 8px; font-weight: 700; color: #1e293b; text-transform: uppercase; }

        @media print { .no-print { display: none; } }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen">

    <div class="no-print mb-8 flex gap-4">
        <a href="{{ route('membres.index') }}" 
           class="flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white px-5 py-2 rounded-lg font-bold shadow transition-all text-sm">
            ← Retour à la liste
        </a>
        
        <button onclick="exportCard()" 
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-bold shadow-lg transition-all text-sm">
            ⬇ Télécharger la Carte (HD)
        </button>
    </div>

    <div id="captureArea" class="card-container">
        
        <div class="sidebar">
            <img src="{{ asset('images/logoubite.png') }}" class="w-10 h-10 object-contain mb-2" alt="Logo">
            <p class="text-[5px] font-black tracking-widest text-blue-400 mb-4 uppercase text-center">Fondation Kazwazwa</p>
            
            <div class="w-18 h-20 rounded-lg overflow-hidden border-2 border-slate-700 shadow-xl mb-3">
                <img src="{{ $membre->photo_url }}" class="w-full h-full object-cover">
            </div>

            <p class="text-[7px] font-bold text-center leading-tight">{{ $membre->nom_complet }}</p>
            <div class="mt-2 bg-emerald-500 text-[5px] px-3 py-1 rounded-full font-black uppercase">
                {{ $membre->fonction ?? 'MEMBRE' }}
            </div>
        </div>

        <div class="main-content">
            <h2 class="text-[11px] font-black text-slate-800 uppercase tracking-tighter border-b border-slate-100 pb-1 mb-3">
                Carte de Membre
            </h2>

            <div class="grid grid-cols-1 gap-2">
                <div>
                    <p class="label-style">Nom Complet</p>
                    <p class="text-[9px] font-black text-slate-900 uppercase">{{ $membre->nom_complet }}</p>
                </div>

                <div class="flex gap-8">
                    <div>
                        <p class="label-style">Lieu</p>
                        <p class="value-style">{{ $membre->lieu_naissance ?? 'KENGE' }}</p>
                    </div>
                    <div>
                        <p class="label-style">Adhésion</p>
                        <p class="value-style">{{ $membre->date_adhesion ? $membre->date_adhesion->format('d/m/Y') : '12/05/2025' }}</p>
                    </div>
                </div>

                <div class="flex gap-8">
                    <div>
                        <p class="label-style">Ancienneté</p>
                        <p class="value-style">{{ intval($membre->anciennete) }} ans</p>
                    </div>
                    <div>
                        <p class="label-style">N° Membre</p>
                        <p class="text-[9px] font-black text-blue-700">{{ $membre->numero_membre }}</p>
                    </div>
                </div>

                <div>
                    <p class="label-style">Expiration</p>
                    <p class="text-[7.5px] font-black text-red-600">31 DÉC 2026</p>
                </div>
            </div>

            <div class="qr-anchor">
                {!! QrCode::size(50)->margin(1)->generate('https://verify.kazwazwa.com/' . $membre->numero_membre) !!}
            </div>

            <div class="absolute bottom-3 left-5">
                <img src="{{ asset('images/signature.png') }}" class="h-4 opacity-70">
                <p class="text-[4px] font-bold text-slate-400 uppercase">Direction</p>
            </div>
        </div>
    </div>

    <script>
        function exportCard() {
            const area = document.getElementById('captureArea');
            html2canvas(area, {
                scale: 4, 
                useCORS: true,
                backgroundColor: null,
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Carte_{{ Str::slug($membre->nom_complet) }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>
</body>
</html>