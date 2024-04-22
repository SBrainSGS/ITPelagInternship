-- Задание 44
SELECT MAX(TIMESTAMPDIFF(YEAR, birthday, NOW())) AS max_year
FROM Student s
    JOIN Student_in_class sc ON (sc.student = s.id)
    JOIN Class c ON (sc.class = c.id) WHERE c.name LIKE '10%'

-- Задание 55
DELETE FROM Company
WHERE id IN (
    SELECT company
    FROM (
             SELECT company, COUNT(*) AS num_flights
             FROM Trip
             GROUP BY company
             HAVING num_flights = (
                 SELECT COUNT(*) AS min_flights
                 FROM Trip
                 GROUP BY company
                 ORDER BY min_flights ASC
                 LIMIT 1
         )
) AS min_flight_companies
);

-- Задание 71
SELECT ROUND((COUNT(active_users) / (SELECT COUNT(*) FROM Users)) * 100, 2) AS percent
FROM (
         SELECT DISTINCT  Reservations.user_id as active_users FROM Reservations
         UNION
         SELECT DISTINCT Rooms.owner_id as active_users FROM Rooms JOIN Reservations on Reservations.room_id=Rooms.id
     ) AS combined_users;
