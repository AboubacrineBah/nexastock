---
name: stock-movement
description: "Use when changing product quantities, stock entries, exits, adjustments, stock history, low-stock indicators, or inventory rules in NexaStock."
---

# Règles des mouvements de stock NexaStock

1. Repère les changements de quantité dans `StockMovementController` et `ProductController`, ainsi que les modèles, vues et tests associés.
2. Préserve les règles métier existantes :
   - les types sont `entrée`, `sortie` et `ajustement`;
   - une entrée augmente la quantité, une sortie la diminue sans permettre un stock négatif;
   - un ajustement fixe la quantité résultante;
   - un mouvement et sa mise à jour de stock doivent réussir ou échouer ensemble;
   - l’écriture actuelle verrouille le produit avec `lockForUpdate()` dans une transaction;
   - la quantité initiale d’un article crée une entrée d’ouverture, et la modification d’un article ne remplace pas l’historique des mouvements.
3. Ne supprime ni ne réécris silencieusement l’historique pour faire correspondre un nouveau calcul. Si une nouvelle règle implique une correction d’historique, explicite son impact et demande confirmation avant l’opération.
4. Ajoute des tests couvrant le type de mouvement, la quantité résultante, le refus d’une sortie supérieure au stock et la cohérence en cas d’erreur.
5. Vérifie que le stock affiché, les rapports et l’historique restent cohérents. Lance les tests concernés puis `php artisan test` et `vendor/bin/pint --test` si possible.
