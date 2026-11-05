---
name: pre-delivery-review
description: "Use when asked to review a NexaStock change, inspect a diff before delivery, or identify regressions without implementing fixes."
---

# Relecture avant livraison

1. Lis le diff et les fichiers modifiés dans leur contexte; compare le comportement à la demande et aux règles du projet.
2. Cherche uniquement les problèmes concrets introduits par le changement : régression fonctionnelle, cas limite non traité, incohérence entre route/vue/données, migration risquée ou test manquant.
3. Pour chaque constat, donne le niveau d’impact, le fichier et la ligne, le scénario de reproduction et la raison. Sépare les faits vérifiables des questions.
4. Ne modifie pas le code pendant une relecture. Si aucun problème n’est trouvé, dis-le clairement et signale les vérifications non exécutées.
5. Ne traite pas une demande de relecture ordinaire comme un audit de sécurité spécialisé; signale simplement si une vérification de sécurité distincte est nécessaire.
