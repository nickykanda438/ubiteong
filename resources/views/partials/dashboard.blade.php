
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-kzz-black font-title uppercase tracking-tight">Tableau de Bord</h1>
        <p class="text-sm text-gray-500 font-sans">Bienvenue sur l'interface de gestion de la Fondation KAZWAZWA</p>
    </div>
    
    <div class="relative w-full md:w-80">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
        </div>
        <input type="search" class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-xl bg-white focus:ring-kzz-blue focus:border-kzz-blue shadow-sm" placeholder="Rechercher un membre ou document...">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="flex items-center justify-between p-5 bg-kzz-blue rounded-2xl shadow-lg text-white transform hover:scale-[1.02] transition">
        <div>
            <p class="text-xs font-medium uppercase opacity-80 tracking-wider">Membres Totaux</p>
            <p class="text-3xl font-bold font-title">1,250</p>
        </div>
        <div class="p-3 bg-white/20 rounded-xl">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
        </div>
    </div>

    <div class="flex items-center justify-between p-5 bg-kzz-green rounded-2xl shadow-lg text-white transform hover:scale-[1.02] transition">
        <div>
            <p class="text-xs font-medium uppercase opacity-80 tracking-wider">Documents KZZ</p>
            <p class="text-3xl font-bold font-title">320</p>
        </div>
        <div class="p-3 bg-white/20 rounded-xl">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414L12.586 2H9z"></path></svg>
        </div>
    </div>

    <div class="flex items-center justify-between p-5 bg-kzz-black rounded-2xl shadow-lg text-white transform hover:scale-[1.02] transition">
        <div>
            <p class="text-xs font-medium uppercase opacity-80 tracking-wider">Trésorerie (USD)</p>
            <p class="text-3xl font-bold font-title">8,450</p>
        </div>
        <div class="p-3 bg-white/20 rounded-xl">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10v2a2 2 0 002 2h2V6a2 2 0 00-2-2H4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 4a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
        </div>
    </div>

    <div class="flex items-center justify-between p-5 bg-orange-500 rounded-2xl shadow-lg text-white transform hover:scale-[1.02] transition">
        <div>
            <p class="text-xs font-medium uppercase opacity-80 tracking-wider">Cadres ONG</p>
            <p class="text-3xl font-bold font-title">12</p>
        </div>
        <div class="p-3 bg-white/20 rounded-xl">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12V12.31c-.13.208-.25.432-.356.671L3.31 12.24V9.397zM7 11.062l2.394 1.026a1 1 0 00.788 0L12.586 11l.71.305c.13.208.25.432.356.671l-.71-.305v2.356l-2.548 1.092a1 1 0 01-.788 0L7 12.872V11.062z"></path></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold mb-6 text-kzz-black font-title uppercase tracking-wide">Évolution des adhésions</h3>
        <div id="main-chart" class="h-72 w-full"></div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold mb-6 text-kzz-black font-title uppercase tracking-wide">Crédits Membres</h3>
        <div id="credit-chart" class="h-72 w-full"></div>
    </div>
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
    <h3 class="text-lg font-bold mb-6 text-kzz-black font-title uppercase">Communications Récentes</h3>
    <div class="divide-y divide-gray-100">
        <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <img class="w-12 h-12 rounded-full border-2 border-kzz-blue" src="https://ui-avatars.com/api/?name=Marie+Dupont&background=003366&color=fff" alt="">
                <div>
                    <p class="text-sm font-bold text-kzz-black">Marie Dupont</p>
                    <p class="text-xs text-gray-500 italic">"Besoin de signatures pour les cadres ONG."</p>
                </div>
            </div>
            <span class="text-[11px] text-gray-400 font-medium bg-gray-50 px-3 py-1 rounded-full">Il y a 10 min</span>
        </div>
        <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <img class="w-12 h-12 rounded-full border-2 border-kzz-green" src="https://ui-avatars.com/api/?name=Jean+Martin&background=28A745&color=fff" alt="">
                <div>
                    <p class="text-sm font-bold text-kzz-black">Jean Martin <span class="ms-2 bg-kzz-green text-[9px] text-white px-2 py-0.5 rounded-full uppercase tracking-tighter">Finance</span></p>
                    <p class="text-xs text-gray-500 italic">"Le rapport de trésorerie est prêt."</p>
                </div>
            </div>
            <span class="text-[11px] text-gray-400 font-medium bg-gray-50 px-3 py-1 rounded-full">Il y a 5 min</span>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. Graphique des Adhésions ---
        const optionsMembres = {
            chart: {
                height: 300,
                type: "area",
                fontFamily: "Roboto, sans-serif",
                toolbar: { show: false },
            },
            fill: {
                type: "gradient",
                gradient: { shadeIntensity: 1, opacityFrom: 0.45, opacityTo: 0.05, stops: [0, 100] }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 4, colors: ['#003366'] },
            grid: { strokeDashArray: 4 },
            series: [{
                name: "Nouveaux Membres",
                data: [12, 25, 18, 36, 28, 45, 38],
                color: "#003366"
            }],
            xaxis: {
                categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
                axisBorder: { show: false },
                axisTicks: { show: false },
            },
            yaxis: { show: true },
        };

        // --- 2. Graphique des Crédits (Barres) ---
        const optionsCredits = {
            chart: {
                height: 300,
                type: "bar",
                fontFamily: "Roboto, sans-serif",
                toolbar: { show: false },
            },
            plotOptions: {
                bar: { borderRadius: 6, columnWidth: '45%' }
            },
            dataLabels: { enabled: false },
            series: [{
                name: "Demandes de Crédit",
                data: [5, 12, 9, 15, 11, 22, 18],
                color: "#28A745" // Vert KZZ
            }],
            xaxis: {
                categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
                axisBorder: { show: false },
                axisTicks: { show: false },
            },
            grid: { strokeDashArray: 4 },
        };

        // Initialisation du graphique Adhésions
        const chartMembres = document.getElementById("main-chart");
        if (chartMembres) {
            chartMembres.innerHTML = ''; 
            new ApexCharts(chartMembres, optionsMembres).render();
        }

        // Initialisation du graphique Crédits
        const chartCredits = document.getElementById("credit-chart");
        if (chartCredits) {
            chartCredits.innerHTML = ''; 
            new ApexCharts(chartCredits, optionsCredits).render();
        }
    });
</script>