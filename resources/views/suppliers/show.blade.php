@extends('layouts.app')
@section('title', $supplier->name)
@section('content')
    <div class="page-head">
        <div>
            <div class="eyebrow">FICHE FOURNISSEUR</div>
            <h1 class="page-title">{{ $supplier->name }}</h1>
            <p class="subtitle">{{ $supplier->email ?? 'E-mail non renseigné' }} ·
                {{ $supplier->phone ?? 'Téléphone non renseigné' }}</p>
        </div>
        <div class="d-flex gap-2"><a class="btn btn-soft" href="{{ route('fournisseurs.index') }}">Retour</a><a
                class="btn btn-brand" href="{{ route('fournisseurs.edit', $supplier) }}">Modifier</a></div>
    </div>
    <section class="panel">
        <div class="panel-head">
            <h2>Articles associés</h2>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ARTICLE</th>
                        <th>RÉFÉRENCE</th>
                        <th>STOCK</th>
                        <th>SEUIL</th>
                    </tr>
                </thead>
                <tbody>@forelse($supplier->products as $product)
                    <tr>
                        <td><a class="item-name" href="{{ route('articles.show', $product) }}">{{ $product->name }}</a></td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->quantity }} {{ $product->unit }}</td>
                        <td>{{ $product->minimum_stock }}</td>
                </tr>@empty<tr>
                        <td colspan="4" class="text-center text-secondary py-4">Aucun article lié à ce fournisseur.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
