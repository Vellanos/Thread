# Symfony Project: Forum for Junior Developers

This project aims to develop a forum for junior developers using the PHP Symfony framework. The goal is to create a space for sharing tips, issues, and discoveries in the field of development.

## Useful SQL Commands for the Project

To check for duplicates in the intermediate tables of votes: 

```sql
SELECT user_id, response_id, COUNT(*) AS count_duplicates
FROM response_vote
GROUP BY user_id, response_id
HAVING COUNT(*) > 1;
```

To remove duplicates:

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

## Project Context

After successfully completing the PHP MVC / API + SPA project, you are now ready to discover Symfony, one of the most popular and reputable PHP frameworks of French origin.

With Symfony and its numerous tools, you will design a comprehensive forum that meets the needs of junior developers.

## Pedagogical Modalities

You have 10 half-days to complete this project, with a deadline set for 19/04/2024. The work is to be done individually.

## Evaluation Modalities

Evaluation will be done through an individual presentation including an oral presentation and a simple yet effective presentation support. The presentation should cover the following aspects:

- Project execution (design, versioning, implementation, etc.).
- Challenges encountered and solutions found (4 min).
- Areas for improvement (4 min).

## Deliverables

The expected deliverables include:

- Conceptual Data Model (CDM) of the database.
- Mockups / wireframes.
- GitHub repository containing a complete and relevant README.
- Submission on Simplonline with links to the various deliverables (ensure they are publicly accessible!).

## Performance Criteria

Performance criteria for this project are as follows:

- Adherence to the requirements.
- Absence of errors in the expected functionalities.
- Adaptation of the site to different screens (responsive design).
- Relevant organization of files and assets.
- Operational functionality of the page(s).
- Adherence to best practices in naming, indentation, and semantics.


