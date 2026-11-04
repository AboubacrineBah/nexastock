@extends('layouts.app')
@section('title', 'Fournisseurs')
@section('content')
    <div class="page-head">
        <div>
            <div class="eyebrow">PARTENAIRES</div>
            <h1 class="page-title">Fournisseurs</h1>
            <p class="subtitle">Centralisez les contacts et les articles de vos fournisseurs.</p>
        </div><a class="btn btn-brand" href="{{ route('fournisseurs.create') }}"><i class="bi bi-plus-circle" aria-hidden="true"></i> Nouveau fournisseur</a>
    </div>
    <section class="panel">
        <div class="panel-head">
            <h2>Répertoire fournisseurs</h2>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>FOURNISSEUR</th>
                        <th>CONTACT</th>
                        <th>TÉLÉPHONE</th>
                        <th>ARTICLES</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>@forelse($suppliers as $supplier)
                    <tr>
                        <td><a class="item-name"
                                href="{{ route('fournisseurs.show', $supplier) }}">{{ $supplier->name }}</a><span
                                class="item-sub">{{ $supplier->address ?? 'Adresse non renseignée' }}</span></td>
                        <td>{{ $supplier->email ?? '—' }}</td>
                        <td>{{ $supplier->phone ?? '—' }}</td>
                        <td>{{ $supplier->products_count }}</td>
                        <td><a class="btn btn-sm btn-soft" href="{{ route('fournisseurs.edit', $supplier) }}">Modifier</a>
                        </td>
                </tr>@empty<tr>
                        <td colspan="5" class="text-center text-secondary py-5">Aucun fournisseur enregistré.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $suppliers->links() }}</div>
    </section>
@endsection
