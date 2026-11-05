---
description: "Use when editing PHP, Laravel routes, Eloquent models, controllers, migrations, seeders, or PHPUnit tests in NexaStock."
applyTo:
  "{app,routes,database,tests}/**/*.php"
---

# Conventions PHP et Laravel

- Respecte le style Laravel et le formatage Laravel Pint (`vendor/bin/pint --test`). Préfère les types de retour et les relations Eloquent déjà employés dans le projet.
- Garde les contrôleurs responsables de la validation HTTP et de l’orchestration; réutilise les modèles et les relations existantes plutôt que de dupliquer les requêtes.
- Les noms de routes, chemins et libellés métier existants sont en français. Préserve-les sauf demande explicite de changement.
- Les pages métier sont derrière le middleware `auth`. Toute nouvelle route doit suivre la protection et le style de déclaration de `routes/web.php`.
- Préserve les contraintes du schéma, les clés étrangères et les valeurs de mouvements (`entrée`, `sortie`, `ajustement`). Pour les changements de schéma, crée une nouvelle migration et suis le skill `database-migration`.
- Vérifie les chemins de succès et d’erreur. Ajoute des tests PHPUnit dans `tests/Feature` ou `tests/Unit`, en suivant les exemples et `RefreshDatabase` lorsque la base est concernée.
- Les tests sont configurés pour SQLite en mémoire, tandis que le déploiement local documenté utilise MySQL/MariaDB. Évite les requêtes ou types qui ne fonctionnent que sur un seul moteur sans nécessité.
