@extends('layouts.app')
@section('title', 'Tableau de bord')
@section('content')
    <div class="page-head">
        <div>
            <div class="eyebrow">VUE D’ENSEMBLE</div>
            <h1 class="page-title">Bonjour {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
            <p class="subtitle">Voici la situation de votre stock aujourd’hui.</p>
        </div><a class="btn btn-brand" href="{{ route('mouvements.create') }}"><i class="bi bi-plus-circle"
                aria-hidden="true"></i> Enregistrer un mouvement</a>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="panel stat-card"><span class="stat-icon"><i class="bi bi-cart-check" aria-hidden="true"></i></span>
                <div class="label">Articles suivis</div>
                <div class="value">{{ number_format($productCount, 0, ',', ' ') }}</div>
                <div class="hint">Dans votre catalogue</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="panel stat-card"><span class="stat-icon"><i class="bi bi-exclamation-triangle"
                        aria-hidden="true"></i></span>
                <div class="label">Stocks faibles</div>
                <div class="value">{{ number_format($lowStockCount, 0, ',', ' ') }}</div>
                <div class="hint">À réapprovisionner</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="panel stat-card"><span class="stat-icon"><i class="bi bi-cash-stack"
                        aria-hidden="true"></i></span>
                <div class="label">Valeur du stock</div>
                <div class="value" style="font-size:24px">{{ number_format((float) $stockValue, 0, ',', ' ') }} F</div>
                <div class="hint">Au coût d’achat</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="panel stat-card"><span class="stat-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                <div class="label">Fournisseurs</div>
                <div class="value">{{ number_format($supplierCount, 0, ',', ' ') }}</div>
                <div class="hint">Partenaires enregistrés</div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-xl-8">
            <section class="panel">
                <div class="panel-head">
                    <h2>Mouvements récents</h2><a href="{{ route('mouvements.index') }}"
                        class="small text-success text-decoration-none">Tout afficher →</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>TYPE</th>
                                <th>ARTICLE</th>
                                <th>QUANTITÉ</th>
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
                                <td>{{ $movement->user->name }}</td>
                                <td>{{ $movement->occurred_at->format('d/m/Y H:i') }}</td>
                        </tr>@empty<tr>
                                <td colspan="5" class="text-center text-secondary py-5">Aucun mouvement. Ajoutez un premier
                                    article ou mouvement.</td>
                            </tr>@endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="col-xl-4">
            <section class="panel">
                <div class="panel-head">
                    <h2>À réapprovisionner</h2><a href="{{ route('articles.index') }}"
                        class="small text-success text-decoration-none">Catalogue →</a>
                </div>
                <div class="p-3">
                    @forelse($lowStockProducts as $product)<a href="{{ route('articles.show', $product) }}"
                        class="d-flex justify-content-between align-items-center py-2 text-decoration-none border-bottom"><span><span
                                class="item-name">{{ $product->name }}</span><span
                                class="item-sub">{{ $product->sku }}</span></span><span
                            class="pill {{ $product->quantity === 0 ? 'pill-danger' : 'pill-warning' }}">{{ $product->quantity }}
                            / {{ $product->minimum_stock }}</span></a>
                    @empty<p class="text-secondary py-4 text-center mb-0">
                        Aucun article sous le seuil minimum.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
@endsection
