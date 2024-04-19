-- Insérer des catégories
INSERT INTO category (title, description, created, edited)
VALUES ('PHP', 'Discussion sur le langage PHP', NOW(), NOW()),
       ('JavaScript', 'Discussion sur JavaScript et ses frameworks', NOW(), NOW()),
       ('HTML', 'Discussion sur HTML', NOW(), NOW()),
       ('CSS', 'Discussion sur CSS', NOW(), NOW());

-- Insérer des utilisateurs avec mots de passe hashés
INSERT INTO user (pseudo, email, password, roles, created, edited)
VALUES 
    ('user1', 'user1@example.com', '$2y$10$Q7Og0I49TWhqINZnW0lLEufiWM/NfAKmE0BqLmDblhQyJTTtEexwK','["ROLE_USER"]', NOW(), NOW()),
    ('user2', 'user2@example.com', '$2y$10$0JExGgWfL8RFQ8f/HujAne8Cj1sUSr9Vd17qQjBSMzRu7AnJnYFvW', '["ROLE_USER"]', NOW(), NOW()),
    ('admin', 'admin@example.com', '$2y$10$jN7PNU5rYPHJbyhj6iy9rOZbw3vEK/NH4C8CzYl0XIfMJYd/u3CFa', '["ROLE_USER"]', NOW(), NOW()),
    ('user3', 'user3@example.com', '$2y$10$BMq4LfLTsE43xgJBl6G.vuqupR0Dy9zOHCfP5b75iea8am8Wjb3Fy', '["ROLE_USER"]', NOW(), NOW()),
    ('user4', 'user4@example.com', '$2y$10$5rHUNcsSxTqJVu.qMD5SZuTTRWw5fns8dY8CqT9so5JgELOU/fQk6', '["ROLE_USER"]', NOW(), NOW()),
    ('admin', 'admin@admin.fr', '$2y$13$7zXwhHage3.K4WT6yPvhBe0bSqHJL6GjvYYlDmOptgG.8NmHsACem', '["ROLE_ADMIN"]', NOW(), NOW()),
    ('Vellanos', 'test@test.fr', '$2y$13$e5norTMBq14lv61IYZou3OmWrDMLpqy.MBiDGgtfjEy1HBgni5Tia', '["ROLE_USER,ROLE_ADMIN"]', NOW(), NOW());
    -- MDP pour Vellanos (ADMIN et USER) : 12345678
    -- MDP pour admin (ADMIN) : admin123

INSERT INTO thread (status, title, description, main, created, edited, user_id)
VALUES ('open', 'Problème de boucle en PHP', 'J''ai un problème avec une boucle PHP.', 'Je suis en train de coder une boucle en PHP et elle semble entrer dans une boucle infinie. Quelqu''un peut-il m''aider ?', NOW(), NOW(), 1),
       ('closed', 'Meilleurs frameworks JS', 'Quels sont les meilleurs frameworks JS ?', 'Je cherche à commencer un nouveau projet et je me demande quels sont les frameworks JavaScript les plus populaires et les mieux adaptés.', NOW(), NOW(), 2),
       ('open', 'Centrer un élément en CSS ?', 'J''ai du mal à centrer un élément en CSS.', 'Je travaille sur un projet HTML/CSS et je veux centrer un élément horizontalement et verticalement, mais ça ne fonctionne pas comme prévu.', NOW(), NOW(), 3),
       ('open', 'Optimiser les performances web', 'Les techniques pour améliorer les performances d''une application web.', 'Mon application web rencontre des problèmes de latence et de temps de chargement. Je suis ouvert à toutes suggestions pour l''optimiser.', NOW(), NOW(), 3),
       ('closed', 'Meilleurs CMS pour e-commerce', 'Quels sont les meilleurs CMS pour les sites e-commerce ?', 'Je cherche à créer un site e-commerce et je me demande quels sont les meilleurs CMS disponibles pour ce type de projet.', NOW(), NOW(), 4),
       ('open', 'Gérer les états dans React', 'Quelle est la meilleure approche pour gérer les états dans une application React ?', 'Je suis nouveau dans React et je me demande quelle est la meilleure façon de gérer les états dans une application React.', NOW(), NOW(), 5),
       ('open', 'Sécuriser une API REST', 'Quelles sont les meilleures pratiques pour assurer sa sécurité.', 'Je veux m''assurer que mon API est sécurisée contre les attaques courantes comme l''injection SQL et les attaques par force brute.', NOW(), NOW(), 6),
       ('closed', 'Tendances de conception web', 'Quelles sont les tendances de conception web pour l''année à venir ?', 'Je suis curieux de connaître les tendances émergentes en matière de conception web pour l''année à venir.', NOW(), NOW(), 7);

-- Insérer des réponses
INSERT INTO response (main, created, edited, thread_id, user_id)
VALUES 
    ('Vous devriez vérifier votre condition de sortie de boucle.', NOW(), NOW(), 1, 2),
    ('Je suis d''accord, assurez-vous également de nettoyer vos variables après utilisation.', NOW(), NOW(), 1, 3),
    ('Angular est très populaire en ce moment.', NOW(), NOW(), 2, 1),
    ('React est également une excellente option pour le développement front-end.', NOW(), NOW(), 2, 3),
    ('Pour centrer un élément en CSS, utilisez la propriété `margin: auto;`.', NOW(), NOW(), 3, 3),
    ('Vous pouvez également utiliser flexbox pour centrer des éléments de manière plus flexible.', NOW(), NOW(), 3, 1),
    ('Utilisez des index sur les colonnes fréquemment utilisées dans vos requêtes et assurez-vous de limiter le nombre de résultats retournés si possible.', NOW(), NOW(), 4, 3),
    ('Le responsive design est plus flexible car il s''adapte à différents types d''appareils, tandis que le mobile first se concentre sur les appareils mobiles en premier lieu, ce qui peut conduire à une expérience utilisateur plus optimisée sur ces appareils.', NOW(), NOW(), 5, 2),
    ('Assurez-vous de valider et d''échapper correctement toutes les données utilisateur pour éviter les attaques XSS et les injections SQL.', NOW(), NOW(), 6, 1),
    ('Utilisez des techniques de mise en cache pour réduire les temps de chargement et minimisez les requêtes HTTP autant que possible.', NOW(), NOW(), 7, 4),
    ('Les CMS populaires pour les sites e-commerce incluent WooCommerce, Shopify et Magento. Choisissez celui qui correspond le mieux à vos besoins et compétences.', NOW(), NOW(), 8, 3),
    ('Redux est souvent utilisé pour gérer les états complexes dans les grandes applications React, tandis que Context API peut être plus adapté pour des applications plus simples.', NOW(), NOW(), 1, 2),
    ('Assurez-vous d''utiliser HTTPS pour toutes les communications et de mettre en œuvre des mécanismes d''authentification robustes comme OAuth2.', NOW(), NOW(), 2, 1),
    ('Les tendances de conception web incluent le design minimaliste, l''utilisation de couleurs vives, les micro-animations et l''intégration de l''IA pour une expérience utilisateur personnalisée.', NOW(), NOW(), 3, 4);


-- Insérer les votes pour les réponses
-- Insérer des votes pour chaque utilisateur
-- Insérer des votes pour chaque utilisateur pour les réponses
INSERT INTO response_vote (user_id, response_id, vote)
VALUES 
    (1, 1, 1), -- User 1 like la réponse 1
    (1, 2, 0), -- User 1 dislike la réponse 2
    (1, 3, 1), -- User 1 like la réponse 3
    (1, 4, 0), -- User 1 dislike la réponse 4
    (1, 5, 1), -- User 1 like la réponse 5
    (1, 6, 0), -- User 1 dislike la réponse 6
    (1, 7, 1), -- User 1 like la réponse 7
    (1, 8, 0), -- User 1 dislike la réponse 8
    (1, 10, 0), -- User 1 dislike la réponse 10
    (1, 11, 1), -- User 1 like la réponse 11
    (1, 12, 0), -- User 1 dislike la réponse 12
    (1, 13, 1), -- User 1 like la réponse 13
    (1, 14, 0), -- User 1 dislike la réponse 14
    (2, 1, 1), -- User 2 like la réponse 1
    (2, 2, 0), -- User 2 dislike la réponse 2
    (2, 3, 1), -- User 2 like la réponse 3
    (2, 4, 0), -- User 2 dislike la réponse 4
    (2, 7, 1), -- User 2 like la réponse 7
    (2, 8, 0), -- User 2 dislike la réponse 8
    (2, 9, 1), -- User 2 like la réponse 9
    (2, 10, 0), -- User 2 dislike la réponse 10
    (2, 11, 1), -- User 2 like la réponse 11
    (2, 12, 0), -- User 2 dislike la réponse 12
    (2, 13, 1), -- User 2 like la réponse 13
    (2, 14, 0), -- User 2 dislike la réponse 14
    (3, 1, 1), -- User 3 like la réponse 1
    (3, 2, 0), -- User 3 dislike la réponse 2
    (3, 3, 1), -- User 3 like la réponse 3
    (3, 4, 0), -- User 3 dislike la réponse 4
    (3, 5, 1), -- User 3 like la réponse 5
    (3, 6, 0), -- User 3 dislike la réponse 6
    (3, 7, 1), -- User 3 like la réponse 7
    (3, 10, 0), -- User 3 dislike la réponse 10
    (3, 11, 1), -- User 3 like la réponse 11
    (3, 12, 0), -- User 3 dislike la réponse 12
    (3, 13, 1), -- User 3 like la réponse 13
    (3, 14, 0), -- User 3 dislike la réponse 14
    (4, 4, 0), -- User 4 dislike la réponse 4
    (4, 5, 1), -- User 4 like la réponse 5
    (4, 6, 0), -- User 4 dislike la réponse 6
    (4, 7, 1), -- User 4 like la réponse 7
    (4, 8, 0), -- User 4 dislike la réponse 8
    (4, 9, 1), -- User 4 like la réponse 9
    (4, 10, 0), -- User 4 dislike la réponse 10
    (4, 11, 1), -- User 4 like la réponse 11
    (4, 12, 0), -- User 4 dislike la réponse 12
    (4, 13, 1), -- User 4 like la réponse 13
    (4, 14, 0), -- User 4 dislike la réponse 14
    (5, 1, 1), -- User 5 like la réponse 1
    (5, 2, 0), -- User 5 dislike la réponse 2
    (5, 3, 1), -- User 5 like la réponse 3
    (5, 4, 0), -- User 5 dislike la réponse 4
    (5, 5, 1), -- User 5 like la réponse 5
    (5, 6, 0), -- User 5 dislike la réponse 6
    (5, 7, 1), -- User 5 like la réponse 7
    (5, 8, 0), -- User 5 dislike la réponse 8
    (5, 9, 1), -- User 5 like la réponse 9
    (5, 14, 0), -- User 5 dislike la réponse 14
    (6, 1, 1), -- User 6 like la réponse 1
    (6, 2, 0), -- User 6 dislike la réponse 2
    (6, 3, 1), -- User 6 like la réponse 3
    (6, 4, 0), -- User 6 dislike la réponse 4
    (6, 5, 1), -- User 6 like la réponse 5
    (6, 6, 0), -- User 6 dislike la réponse 6
    (6, 7, 1), -- User 6 like la réponse 7
    (6, 8, 0), -- User 6 dislike la réponse 8
    (6, 9, 1), -- User 6 like la réponse 9
    (6, 10, 0), -- User 6 dislike la réponse 10
    (6, 11, 1), -- User 6 like la réponse 11
    (7, 1, 1), -- User 7 like la réponse 1
    (7, 2, 0), -- User 7 dislike la réponse 2
    (7, 3, 1), -- User 7 like la réponse 3
    (7, 6, 0), -- User 7 dislike la réponse 6
    (7, 7, 1), -- User 7 like la réponse 7
    (7, 8, 0), -- User 7 dislike la réponse 8
    (7, 9, 1), -- User 7 like la réponse 9
    (7, 10, 0), -- User 7 dislike la réponse 10
    (7, 12, 0), -- User 7 dislike la réponse 12
    (7, 13, 1), -- User 7 like la réponse 13
    (7, 14, 0); -- User 7 dislike la réponse 14


-- Associer les threads supplémentaires à des catégories existantes
INSERT INTO thread_category (category_id, thread_id)
VALUES 
    (1, 1),
    (2, 2),
    (1, 2),
    (1, 3),
    (2, 3),
    (3, 3),
    (3, 4),
    (4, 5),
    (1, 6),
    (2, 6),
    (2, 7),
    (3, 8);

-- Insérer des votes pour chaque utilisateur pour les threads
INSERT INTO thread_vote (user_id, thread_id, vote)
VALUES 
    (1, 1, 1), -- User 1 like le thread 1
    (1, 2, 0), -- User 1 dislike le thread 2
    (1, 3, 1), -- User 1 like le thread 3
    (1, 4, 0), -- User 1 dislike le thread 4
    (1, 5, 1), -- User 1 like le thread 5
    (1, 6, 0), -- User 1 dislike le thread 6
    (1, 7, 1), -- User 1 like le thread 7
    (1, 8, 0), -- User 1 dislike le thread 8
    (2, 1, 0), -- User 2 dislike le thread 1
    (2, 2, 1), -- User 2 like le thread 2
    (2, 3, 0), -- User 2 dislike le thread 3
    (2, 4, 1), -- User 2 like le thread 4
    (2, 5, 0), -- User 2 dislike le thread 5
    (2, 6, 1), -- User 2 like le thread 6
    (2, 7, 0), -- User 2 dislike le thread 7
    (2, 8, 1), -- User 2 like le thread 8
    (3, 1, 1), -- User 3 like le thread 1
    (3, 2, 0), -- User 3 dislike le thread 2
    (3, 3, 1), -- User 3 like le thread 3
    (3, 4, 0), -- User 3 dislike le thread 4
    (3, 5, 1), -- User 3 like le thread 5
    (3, 6, 0), -- User 3 dislike le thread 6
    (3, 7, 1), -- User 3 like le thread 7
    (3, 8, 0), -- User 3 dislike le thread 8
    (4, 1, 0), -- User 4 dislike le thread 1
    (4, 2, 1), -- User 4 like le thread 2
    (4, 3, 0), -- User 4 dislike le thread 3
    (4, 4, 1), -- User 4 like le thread 4
    (4, 5, 0), -- User 4 dislike le thread 5
    (4, 6, 1), -- User 4 like le thread 6
    (4, 7, 0), -- User 4 dislike le thread 7
    (4, 8, 1), -- User 4 like le thread 8
    (5, 1, 1), -- User 5 like le thread 1
    (5, 2, 0), -- User 5 dislike le thread 2
    (5, 3, 1), -- User 5 like le thread 3
    (5, 4, 0), -- User 5 dislike le thread 4
    (5, 5, 1), -- User 5 like le thread 5
    (5, 6, 0), -- User 5 dislike le thread 6
    (5, 7, 1), -- User 5 like le thread 7
    (5, 8, 0), -- User 5 dislike le thread 8
    (6, 1, 0), -- User 6 dislike le thread 1
    (6, 2, 1), -- User 6 like le thread 2
    (6, 3, 0), -- User 6 dislike le thread 3
    (6, 4, 1), -- User 6 like le thread 4
    (6, 5, 0), -- User 6 dislike le thread 5
    (6, 6, 1), -- User 6 like le thread 6
    (6, 7, 0), -- User 6 dislike le thread 7
    (6, 8, 1), -- User 6 like le thread 8
    (7, 1, 1), -- User 7 like le thread 1
    (7, 2, 0), -- User 7 dislike le thread 2
    (7, 3, 1), -- User 7 like le thread 3
    (7, 4, 0), -- User 7 dislike le thread 4
    (7, 5, 1), -- User 7 like le thread 5
    (7, 6, 0), -- User 7 dislike le thread 6
    (7, 7, 1), -- User 7 like le thread 7
    (7, 8, 0); -- User 7 dislike le thread 8

