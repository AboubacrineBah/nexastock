@extends('layouts.app')
@section('title', 'Mouvements')
@section('content')
    <div class="page-head">
        <div>
            <div class="eyebrow">HISTORIQUE DU STOCK</div>
            <h1 class="page-title">Mouvements</h1>
            <p class="subtitle">Suivez les entrées, sorties et ajustements de stock.</p>
        </div><a class="btn btn-brand" href="{{ route('mouvements.create') }}"><i class="bi bi-plus-circle" aria-hidden="true"></i> Enregistrer un mouvement</a>
    </div>
    <section class="panel">
        <div class="panel-head">
            <h2>Historique des opérations</h2>
            <form method="get">
                <select class="form-select form-select-sm" name="type" onchange="this.form.submit()">
                    <option value="">Tous les types</option>
                    @foreach(['entrée', 'sortie', 'ajustement'] as $type)
                        <option value="{{ $type }}" @selected(request('type') === $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>TYPE</th>
                        <th>ARTICLE</th>
                        <th>QUANTITÉ</th>
                        <th>RÉFÉRENCE / MOTIF</th>
                        <th>UTILISATEUR</th>
                        <th>DATE</th>
                    </tr>
                </thead>
                <tbody>@forelse($movements as $movement)
                    <tr>
                        <td><span
                                class="pill {{ $movement->type === 'sortie' ? 'pill-warning' : '' }}">{{ ucfirst($movement->type) }}</span>
                        </td>
                        <td><a class="item-name"
                                href="{{ route('articles.show', $movement->product) }}">{{ $movement->product->name }}</a><span
                                class="item-sub">{{ $movement->product->sku }}</span></td>
                        <td>{{ $movement->type === 'ajustement' ? 'Stock fixé à ' : ($movement->type === 'sortie' ? '−' : '+') }}{{ $movement->quantity }}
                            {{ $movement->product->unit }}
                        </td>
                        <td>{{ $movement->reference ?? $movement->notes ?? '—' }}</td>
                        <td>{{ $movement->user->name }}</td>
                        <td>{{ $movement->occurred_at->format('d/m/Y H:i') }}</td>
                </tr>@empty<tr>
                        <td colspan="6" class="text-center text-secondary py-5">Aucun mouvement de stock enregistré.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $movements->links() }}</div>
    </section>
@endsection
