-- Insérer des catégories
INSERT INTO category (title, description, created, edited)
VALUES ('PHP', 'Discussion sur le langage PHP', NOW(), NOW()),
       ('JavaScript', 'Discussion sur JavaScript et ses frameworks', NOW(), NOW()),
       ('HTML', 'Discussion sur HTML', NOW(), NOW()),
       ('CSS', 'Discussion sur CSS', NOW(), NOW());

-- Insérer des utilisateurs avec mots de passe hashés
INSERT INTO user (pseudo, email, password, roles, created, edited)
VALUES 
    ('user1', 'user1@example.com', '$2y$10$Q7Og0I49TWhqINZnW0lLEufiWM/NfAKmE0BqLmDblhQyJTTtEexwK','[]', NOW(), NOW()),
    ('user2', 'user2@example.com', '$2y$10$0JExGgWfL8RFQ8f/HujAne8Cj1sUSr9Vd17qQjBSMzRu7AnJnYFvW', '[]', NOW(), NOW()),
    ('admin', 'admin@example.com', '$2y$10$jN7PNU5rYPHJbyhj6iy9rOZbw3vEK/NH4C8CzYl0XIfMJYd/u3CFa', '[]', NOW(), NOW());

-- Insérer des threads
INSERT INTO thread (status, title, description, main, created, edited, user_id)
VALUES ('open', 'Problème de boucle infinie en PHP', 'J''ai un problème avec une boucle PHP', 'Je suis en train de coder une boucle en PHP et elle semble entrer dans une boucle infinie. Quelqu''un peut-il m''aider ?', NOW(), NOW(), 1),
       ('closed', 'Meilleurs frameworks JavaScript', 'Quels sont les meilleurs frameworks JavaScript actuellement ?', 'Je cherche à commencer un nouveau projet et je me demande quels sont les frameworks JavaScript les plus populaires et les mieux adaptés.', NOW(), NOW(), 2),
       ('open', 'Comment centrer un élément en CSS ?', 'J''ai du mal à centrer un élément en CSS, pouvez-vous m''aider ?', 'Je travaille sur un projet HTML/CSS et je veux centrer un élément horizontalement et verticalement, mais ça ne fonctionne pas comme prévu.', NOW(), NOW(), 3);

-- Insérer des réponses
INSERT INTO response (main, created, edited, thread_id, user_id)
VALUES 
    ('Vous devriez vérifier votre condition de sortie de boucle.', NOW(), NOW(), 1, 2),
    ('Je suis d''accord, assurez-vous également de nettoyer vos variables après utilisation.', NOW(), NOW(), 1, 3),
    ('Angular est très populaire en ce moment.', NOW(), NOW(), 2, 1),
    ('React est également une excellente option pour le développement front-end.', NOW(), NOW(), 2, 3),
    ('Pour centrer un élément en CSS, utilisez la propriété `margin: auto;`.', NOW(), NOW(), 3, 3),
    ('Vous pouvez également utiliser flexbox pour centrer des éléments de manière plus flexible.', NOW(), NOW(), 3, 1);

-- Insérer les votes pour les réponses
INSERT INTO response_vote (user_id, response_id, vote)
VALUES 
    (1, 1, 1),
    (2, 2, 1),
    (2, 2, -1),
    (3, 3, 1),
    (1, 4, 1),
    (1, 4, -1),
    (3, 5, 1),
    (1, 6, 1);

-- Insérer les votes pour les threads
INSERT INTO thread_vote (user_id, thread_id, vote)
VALUES 
    (2, 1, 1),
    (1, 2, 1),
    (3, 3, 1);

-- Insérer les votes pour les threads
INSERT INTO category_thread (category_id, thread_id)
VALUES 
    (1, 1),
    (3, 1),
    (2, 2),
    (4, 3),
    (3, 3),
    (2, 3);