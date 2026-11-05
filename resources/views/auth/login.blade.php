@extends('layouts.app')
@section('title', 'Connexion')
@section('guest-content')
    <div class="auth-bg">
        <section class="auth-card">
            <p class="h2 text-success"><img class="auth-logo" src="{{ asset('logo-mark.svg') }}" alt="NexaStock"> NexaStock</p>
            <div class="eyebrow">VOTRE STOCK SOUS CONTRÔLE</div>
            <h1 class="page-title mb-2">Bienvenue</h1>
            <p class="text-secondary mb-4">Connectez-vous à votre espace NexaStock.</p>
            <form method="post" action="{{ route('login.attempt') }}">@csrf<label class="form-label" for="email">Adresse
                    e-mail</label><input class="form-control mb-3" id="email" name="email" type="email"
                    value="{{ old('email') }}" required autofocus>@error('email')
                    <div class="text-danger small mb-2">{{ $message }}</div>@enderror<label class="form-label"
                    for="password">Mot de passe</label><input class="form-control mb-3" id="password" name="password"
                    type="password" required>
                <div class="form-check mb-4"><input class="form-check-input" type="checkbox" id="remember"
                        name="remember"><label class="form-check-label small" for="remember">Se souvenir de moi</label>
                </div><button class="btn btn-brand w-100 py-2">Se connecter</button>
            </form>
            <div class="small text-secondary mt-4">NexaStock · NexaWeb Mali</div>
        </section>
    </div>
@endsection
