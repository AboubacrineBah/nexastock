---
name: phpunit-tests
description: "Use when adding, updating, debugging, or running PHPUnit tests for NexaStock features, routes, database behavior, or Blade responses."
---

# Tester NexaStock avec PHPUnit

1. Repère les tests dans `tests/Feature` et `tests/Unit` et reprends leur style. Les tests fonctionnels qui touchent la base utilisent généralement `RefreshDatabase`.
2. Couvre le comportement observable : résultat HTTP, redirection, données persistées, erreurs de validation et accès invité/authentifié selon la fonctionnalité.
3. Écris des tests déterministes, isolés et indépendants des services externes. La configuration PHPUnit utilise SQLite en mémoire.
4. Lance d’abord le test ciblé, par exemple `php artisan test --filter=StockPdfTest`, puis `php artisan test` si le changement touche plusieurs surfaces.
5. Si un test échoue, distingue une régression du comportement d’un problème d’environnement et rapporte l’erreur réelle; ne masque pas l’échec avec des valeurs de repli.
