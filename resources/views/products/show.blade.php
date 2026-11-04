@extends('layouts.app')
@section('title', $product->name)
@section('content')
    <div class="page-head">
        <div>
            <div class="eyebrow">FICHE ARTICLE · {{ $product->sku }}</div>
            <h1 class="page-title">{{ $product->name }}</h1>
            <p class="subtitle">{{ $product->category?->name ?? 'Sans catégorie' }} ·
                {{ $product->supplier?->name ?? 'Sans fournisseur' }}
            </p>
        </div>
        <div class="d-flex gap-2"><a class="btn btn-soft" href="{{ route('articles.index') }}">Retour</a><a
                class="btn btn-brand" href="{{ route('articles.edit', $product) }}">Modifier l’article</a></div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="panel stat-card">
                <div class="label">Stock disponible</div>
                <div class="value">{{ $product->quantity }} <span class="fs-6">{{ $product->unit }}</span></div>
                <div class="hint">Seuil minimum : {{ $product->minimum_stock }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel stat-card">
                <div class="label">Coût d’achat</div>
                <div class="value">{{ number_format((float) $product->unit_cost, 0, ',', ' ') }} F</div>
                <div class="hint">{{ number_format($product->quantity * (float) $product->unit_cost, 0, ',', ' ') }} F de
                    valeur en stock</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel stat-card">
                <div class="label">Prix de vente</div>
                <div class="value">{{ number_format((float) $product->unit_price, 0, ',', ' ') }} F</div>
                <div class="hint">par {{ $product->unit }}</div>
            </div>
        </div>
    </div>
    <section class="panel">
        <div class="panel-head">
            <h2>Historique des mouvements</h2><a href="{{ route('mouvements.create') }}" class="btn btn-brand btn-sm"><i
                    class="bi bi-plus-circle" aria-hidden="true"></i> Enregistrer un
                Mouvement</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>TYPE</th>
                        <th>QUANTITÉ</th>
                        <th>RÉFÉRENCE / MOTIF</th>
                        <th>UTILISATEUR</th>
                        <th>DATE</th>
                    </tr>
                </thead>
                <tbody>@forelse($product->movements->sortByDesc('occurred_at') as $movement)
                    <tr>
                        <td><span class="pill">{{ ucfirst($movement->type) }}</span></td>
                        <td>{{ $movement->type === 'ajustement' ? 'Stock fixé à ' : '' }}{{ $movement->quantity }}
                            {{ $product->unit }}
                        </td>
                        <td>{{ $movement->reference ?? $movement->notes ?? '—' }}</td>
                        <td>{{ $movement->user->name }}</td>
                        <td>{{ $movement->occurred_at->format('d/m/Y H:i') }}</td>
                </tr>@empty<tr>
                        <td colspan="5" class="text-center text-secondary py-4">Pas encore de mouvement enregistré.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
