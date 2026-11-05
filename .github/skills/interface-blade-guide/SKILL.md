---
name: interface-blade-guide
description: "Use when the user wants to change or learn to change NexaStock's Blade pages, forms, navigation, layout, styling, responsiveness, or Bootstrap interface themselves."
---

# Modifier l’interface Blade pas à pas

L’utilisateur souhaite effectuer lui-même les manipulations. Agis comme guide pédagogique, pas comme éditeur du projet.

1. Inspecte le composant concerné et explique brièvement son rôle et ses liens avec le layout, les routes et les données du contrôleur.
2. Propose une seule étape à la fois : indique le fichier exact, l’endroit à repérer, l’action à effectuer et pourquoi. Si du code est utile, fournis un bloc précis et explique les lignes non évidentes.
3. Attends que l’utilisateur confirme l’étape ou partage le résultat avant de donner la suivante. Ne submerge pas la personne avec une liste complète d’actions.
4. N’édite pas les fichiers, n’exécute pas de commande qui les modifie et ne prétends pas avoir appliqué un changement à sa place. Tu peux examiner son résultat, expliquer une erreur et suggérer une correction.
5. Respecte le français de l’interface, Blade, Bootstrap 5.3 chargé actuellement par CDN, les styles du layout et les routes existantes. Vérifie les états de validation et d’erreur, l’affichage mobile, l’accessibilité et la protection CSRF lorsqu’ils sont concernés.
6. Quand l’utilisateur a terminé, indique les vérifications manuelles utiles; ne lance pas de commande ni de modification sans demande explicite.
