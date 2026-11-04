@extends('layouts.app')
@section('title', 'Catégories')
@section('content')
    <div class="page-head">
        <div>
            <div class="eyebrow">ORGANISATION DU CATALOGUE</div>
            <h1 class="page-title">Catégories</h1>
            <p class="subtitle">Classez vos articles pour retrouver rapidement vos produits.</p>
        </div><a class="btn btn-brand" href="{{ route('categories.create') }}"><i class="bi bi-plus-circle"
                aria-hidden="true"></i> Nouvelle catégorie</a>
    </div>
    <section class="panel">
        <div class="panel-head">
            <h2>Catégories enregistrées</h2>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NOM</th>
                        <th>DESCRIPTION</th>
                        <th>ARTICLES</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="item-name">{{ $category->name }}</td>
                            <td>{{ $category->description ?: '—' }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td><a class="btn btn-sm btn-soft" href="{{ route('categories.edit', $category) }}">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-5">Aucune catégorie. Créez une catégorie pour
                                organiser votre catalogue.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $categories->links() }}</div>
    </section>
@endsection
