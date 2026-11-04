@extends('layouts.app')
@section('title', 'Articles')
@section('content')
    <div class="page-head">
        <div>
            <div class="eyebrow">GESTION DU CATALOGUE</div>
            <h1 class="page-title">Articles</h1>
            <p class="subtitle">Consultez et gérez vos produits et niveaux de stock.</p>
        </div><a class="btn btn-brand" href="{{ route('articles.create') }}"><i class="bi bi-plus-circle" aria-hidden="true"></i> Nouvel article</a>
    </div>
    <section class="panel">
        <div class="panel-head">
            <h2>Catalogue <span class="text-secondary fw-normal">({{ $products->total() }})</span></h2>
            <form class="d-flex gap-2" method="get"><input name="q" class="form-control form-control-sm"
                    placeholder="Nom ou référence…" value="{{ request('q') }}"><button
                    class="btn btn-soft btn-sm">Rechercher</button></form>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ARTICLE</th>
                        <th>CATÉGORIE</th>
                        <th>FOURNISSEUR</th>
                        <th>STOCK</th>
                        <th>SEUIL</th>
                        <th>PRIX DE VENTE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>@forelse($products as $product)
                    <tr>
                        <td><a class="item-name" href="{{ route('articles.show', $product) }}">{{ $product->name }}</a><span
                                class="item-sub">{{ $product->sku }}</span></td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td>{{ $product->supplier?->name ?? '—' }}</td>
                        <td><span class="pill {{ $product->is_low_stock ? 'pill-warning' : '' }}">{{ $product->quantity }}
                                {{ $product->unit }}</span></td>
                        <td>{{ $product->minimum_stock }}</td>
                        <td>{{ number_format((float) $product->unit_price, 0, ',', ' ') }} F</td>
                        <td><a class="btn btn-sm btn-soft" href="{{ route('articles.edit', $product) }}">Modifier</a></td>
                </tr>@empty<tr>
                        <td colspan="7" class="text-center text-secondary py-5">Aucun article trouvé. <a
                                href="{{ route('articles.create') }}">Créer un article</a></td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $products->links() }}</div>
    </section>
@endsection
