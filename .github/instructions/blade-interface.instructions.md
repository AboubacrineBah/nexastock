---
description: "Use when inspecting or changing NexaStock Blade templates, CSS, forms, navigation, responsive behavior, accessibility, or Bootstrap UI."
applyTo: "resources/views/**/*.blade.php, resources/css/**/*.css"
---

# Interface Blade — accompagnement guidé

- Pour une demande de modification de l’interface, utilise le skill `interface-blade-guide`. Par défaut, n’édite pas les fichiers et ne fais pas les manipulations à la place de l’utilisateur : explique une étape à la fois, attends sa confirmation, puis poursuis.
- Avant de proposer une modification, repère la vue concernée, son layout, les données fournies par le contrôleur et les styles/composants existants.
- L’interface est en français et utilise actuellement Blade et Bootstrap 5.3 chargé depuis un CDN. Réutilise les classes et composants existants; ne suppose pas qu’une nouvelle dépendance front-end est nécessaire.
- Préserve les noms de routes, les valeurs de formulaire, la validation Laravel, les messages d’erreur et les protections CSRF. Pense à l’affichage mobile, au clavier et aux libellés accessibles.
