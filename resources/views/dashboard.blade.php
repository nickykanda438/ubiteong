<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tableau de Bord</h1>
                    <p class="text-sm text-gray-500">Bienvenue sur votre interface de gestion</p>
                </div>
            </div>

            <!-- Cartes statistiques -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <!-- Membres -->
                <div class="bg-blue-600 rounded-lg shadow p-6 text-white">
                    <p class="text-sm opacity-80">Membres Totaux</p>
                    <p class="text-4xl font-bold">{{ number_format($membresTotaux ?? 0, 0, ',', ' ') }}</p>
                </div>
                <!-- Documents -->
                <div class="bg-green-600 rounded-lg shadow p-6 text-white">
                    <p class="text-sm opacity-80">Documents</p>
                    <p class="text-4xl font-bold">{{ number_format($documentsTotaux ?? 0, 0, ',', ' ') }}</p>
                </div>
                <!-- Crédits -->
                <div class="bg-gray-800 rounded-lg shadow p-6 text-white">
                    <p class="text-sm opacity-80">Crédits en cours</p>
                    <p class="text-4xl font-bold">{{ number_format($creditsEnCours ?? 0, 0, ',', ' ') }}</p>
                </div>
                <!-- Épargnes -->
                <div class="bg-purple-600 rounded-lg shadow p-6 text-white">
                    <p class="text-sm opacity-80">Total Épargne</p>
                    <p class="text-4xl font-bold">{{ number_format($totalEpargne ?? 0, 0, ',', ' ') }}</p>
                </div>
                <!-- Cadres -->
                <div class="bg-orange-600 rounded-lg shadow p-6 text-white">
                    <p class="text-sm opacity-80">Cadres ONG</p>
                    <p class="text-4xl font-bold">{{ number_format($cadresTotaux ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Évolution des Épargnes -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Évolution des Épargnes</h3>
                    <div id="epargne-chart" style="height: 300px;"></div>
                </div>
                <!-- Évolution des Crédits -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Crédits accordés</h3>
                    <div id="credit-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique Épargne
            const epargneOptions = {
                chart: { type: 'area', height: 300, fontFamily: 'sans-serif', toolbar: { show: false } },
                series: [{ name: 'Montant', data: @json($epargneChartData ?? []) }],
                xaxis: { categories: @json($labels ?? []) },
                colors: ['#3B82F6'],
                stroke: { curve: 'smooth', width: 2 },
                fill: { type: 'gradient', gradient: { opacityFrom: 0.4, opacityTo: 0.1 } }
            };
            new ApexCharts(document.getElementById('epargne-chart'), epargneOptions).render();

            // Graphique Crédits
            const creditOptions = {
                chart: { type: 'bar', height: 300, fontFamily: 'sans-serif', toolbar: { show: false } },
                series: [{ name: 'Nombre', data: @json($creditChartData ?? []) }],
                xaxis: { categories: @json($labels ?? []) },
                colors: ['#10B981'],
                plotOptions: { bar: { borderRadius: 4, columnWidth: '70%' } }
            };
            new ApexCharts(document.getElementById('credit-chart'), creditOptions).render();
        });
    </script>
</x-app-layout>
