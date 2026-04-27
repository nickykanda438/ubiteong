@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Crédits en retard</h1>

        <table class="w-full border">
            <thead>
                <tr>
                    <th>Membre</th>
                    <th>Montant</th>
                    <th>Reste</th>
                    <th>Échéance</th>
                </tr>
            </thead>
            <tbody>
                @forelse($credits as $credit)
                    <tr>
                        <td>{{ $credit->membre->nom_complet }}</td>
                        <td>{{ number_format($credit->montant_principal, 0, ',', ' ') }}</td>
                        <td>{{ number_format($credit->reste_a_payer, 0, ',', ' ') }}</td>
                        <td>{{ $credit->date_echeance_finale }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Aucun crédit en retard</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
