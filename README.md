# Projet Symfony Forum pour Développeurs Juniors

Ce projet consiste à développer un forum destiné aux développeurs juniors en utilisant le framework PHP Symfony. L'objectif est de créer un espace d'échange pour partager des astuces, des problèmes et des découvertes dans le domaine du développement.

## Commandes utiles du Projet

Pour checker s'il y a des doublons dans les tables intermédiaires des votes : 

```sql
SELECT user_id, response_id, COUNT(*) AS count_duplicates
FROM response_vote
GROUP BY user_id, response_id
HAVING COUNT(*) > 1;
```

Pour supprimer les doublons : 

```sql
DELETE FROM response_vote
WHERE id NOT IN (
    SELECT id
    FROM (
        SELECT MIN(id) AS id
        FROM response_vote
        GROUP BY user_id, response_id
    ) AS t
);
```

## Contexte du Projet

Après avoir réalisé avec succès le projet PHP MVC / API + SPA, vous êtes désormais prêt à découvrir Symfony, l'un des frameworks PHP les plus populaires et réputés, d'origine française.

Grâce à Symfony et à ses nombreux outils, vous allez concevoir un forum complet répondant aux besoins des développeurs juniors.

## Modalités pédagogiques

Vous disposez de 10 demi-journées pour mener à bien ce projet, avec une date limite de rendu fixée au 19/04/2024. Le travail est à réaliser en solo.

## Modalités d'évaluation

L'évaluation se fera par une présentation individuelle incluant une présentation orale et un support de présentation simple mais efficace. La présentation devra couvrir les aspects suivants :

- Déroulement de la réalisation (conception, versionnement, réalisation, etc.).
- Difficultés rencontrées et solutions trouvées (4 min).
- Améliorations à apporter (4 min).

## Livrables

Les livrables attendus sont les suivants :

- Modèle Conceptuel de Données (MCD) de la base de données.
- Maquettes / wireframes.
- Dépôt GitHub contenant un README complet et pertinent.
- Rendu sur Simplonline avec les liens vers les différents livrables (assurez-vous qu'ils soient accessibles publiquement !).

## Critères de performance

Les critères de performance pour ce projet sont les suivants :

- Respect du cahier des charges.
- Absence d'erreurs dans les fonctionnalités attendues.
- Adaptation du site à différents écrans (responsive design).
- Organisation pertinente des fichiers et des assets.
- Fonctionnalité opérationnelle de la ou des pages.
- Respect des bonnes pratiques de nommage, d'indentation et de sémantique.

