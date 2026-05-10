@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="p-4 pt-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight uppercase">Tableau de Bord</h1>
                <p class="text-sm text-gray-500 font-medium">Bienvenue sur votre interface de gestion administrative.</p>
            </div>
            <div>
                <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                    Données à jour
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            
            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Membres</p>
                    <p class="text-xl font-black text-gray-900 leading-none">{{ number_format($membresTotaux ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Documents</p>
                    <p class="text-xl font-black text-gray-900 leading-none">{{ number_format($documentsTotaux ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-slate-100 text-slate-700 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1L12 11c-1.11 0-2.08-.407-2.67-1L12 8z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Crédits</p>
                    <p class="text-xl font-black text-gray-900 leading-none">{{ number_format($creditsEnCours ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Épargne</p>
                    <p class="text-xl font-black text-gray-900 leading-none">{{ number_format($totalEpargne ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-3 bg-orange-50 text-orange-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m-1 4h1m5-12h1m-1 4h1m-1 4h1"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Cadres</p>
                    <p class="text-xl font-black text-gray-900 leading-none">{{ number_format($cadresTotaux ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="text-base font-bold text-gray-800 mb-6 border-b border-gray-50 pb-2">Évolution des Épargnes</h3>
                <div id="epargne-chart"></div>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="text-base font-bold text-gray-800 mb-6 border-b border-gray-50 pb-2">Crédits Accordés</h3>
                <div id="credit-chart"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commonOptions = {
            chart: { fontFamily: 'inherit', toolbar: { show: false } },
            stroke: { curve: 'smooth', width: 2.5 },
            grid: { borderColor: '#f3f4f6', strokeDashArray: 3 }
        };

        // Graphique Épargne
        new ApexCharts(document.getElementById('epargne-chart'), {
            ...commonOptions,
            chart: { ...commonOptions.chart, type: 'area', height: 280 },
            series: [{ name: 'Montant', data: @json($epargneChartData ?? []) }],
            xaxis: { categories: @json($labels ?? []), axisBorder: {show: false} },
            colors: ['#3B82F6'],
            fill: { type: 'gradient', gradient: { opacityFrom: 0.3, opacityTo: 0.05 } }
        }).render();

        // Graphique Crédits
        new ApexCharts(document.getElementById('credit-chart'), {
            ...commonOptions,
            chart: { ...commonOptions.chart, type: 'bar', height: 280 },
            series: [{ name: 'Crédits', data: @json($creditChartData ?? []) }],
            xaxis: { categories: @json($labels ?? []), axisBorder: {show: false} },
            colors: ['#10B981'],
            plotOptions: { bar: { borderRadius: 4, columnWidth: '45%' } }
        }).render();
    });
</script>
@endsection