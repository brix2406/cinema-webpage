<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'cinema';


@$db = new mysqli($host, $user, $pass);
if ($db->connect_errno) {
    exit("Connection failed: " . $db->connect_error);
}
$db->query("CREATE DATABASE IF NOT EXISTS `$dbname`");

$db->select_db($dbname);


$moviesTableExisted = $db->query("SHOW TABLES LIKE 'movies'")->num_rows > 0;

$queries = [
    "CREATE TABLE IF NOT EXISTS users (
        userId INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        password VARCHAR(255)
    )",
    "CREATE TABLE IF NOT EXISTS movies (
        movieId INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        genre VARCHAR(255),
        description TEXT,
        lastScreening DATE,
        trailerLink VARCHAR(255),
        posterPath VARCHAR(255)
    )",
    "CREATE TABLE IF NOT EXISTS screeningRooms (
        roomId INT AUTO_INCREMENT PRIMARY KEY,
        noOfSeats INT
    )",
    "CREATE TABLE IF NOT EXISTS screenings (
        screeningId INT AUTO_INCREMENT PRIMARY KEY,
        roomId INT,
        movieId INT,
        startDate DATE,
        startTime TIME,
        FOREIGN KEY (roomId) REFERENCES screeningRooms(roomId) ON DELETE CASCADE,
        FOREIGN KEY (movieId) REFERENCES movies(movieId) ON DELETE CASCADE
    )",
    "CREATE TABLE IF NOT EXISTS bookings (
        bookingId INT AUTO_INCREMENT PRIMARY KEY,
        userId INT,
        screeningId INT,
        noOfTickets INT,
        FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE,
        FOREIGN KEY (screeningId) REFERENCES screenings(screeningId) ON DELETE CASCADE
    )"
];

foreach ($queries as $query) {
    $db->query($query);
}

if (!$moviesTableExisted) {
    $insertMovies = [
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Clayface', 'Horror', 'A B-movie actor injects himself with a substance to keep himself relevant, only to find out that he can reshape his face and form, becoming a walking piece of clay.', '2027-04-13', 'https://www.youtube.com/watch?v=Fu3SrXI52zk', '../media/moviePosters/clayface.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Wildwood', 'Animation', 'Following her brother\'s abduction, Prue sets out to rescue him in the enchanted forest of Wildwood, where the destiny of an entire hidden world depends on her choices.', '2027-02-05', 'https://www.youtube.com/watch?v=Ml8D_0G5QeU', '../media/moviePosters/wildwood.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Klara and the Sun', 'Sci-Fi', 'In a dystopian future where genetic engineering has divided humans into strict social classes, an Artificial Friend named Klara tries to bond with a sick girl named Josie.', '2027-01-25', 'https://www.youtube.com/watch?v=pcUuT3CcjPM', '../media/moviePosters/klara_and_the_sun.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Digger', 'Comedy', 'A disastrous drilling accident in Greenland threatens the globe, forcing oil magnate Digger Rockwell into a frantic cover-up as global chaos escalates.', '2027-02-26', 'https://www.youtube.com/watch?v=_Z5-kz1JUhw', '../media/moviePosters/digger.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Forgotten Island', 'Animation', 'When they discover that the memories of their entire friendship are the price for returning home, Jo and Raissa must race to leave a mysterious island before they forget each other forever.', '2027-02-22', 'https://www.youtube.com/watch?v=aCvQc6Mt7gE', '../media/moviePosters/forgotten_island.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Jailer 2', 'Action', 'Idol smugglers clash with Muthuvel Pandian after Varman\'s death as he battles a new gang and faces the changing dynamics of his family.', '2027-02-19', 'https://www.youtube.com/watch?v=4qs-GMa1ttY', '../media/moviePosters/jailer_2.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Marvel Studios\' Avengers: Endgame Encore', 'Action', 'After the devastating events of Avengers: Infinity War, the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos\' actions and restore balance to the universe.', '2027-02-08', 'https://www.youtube.com/watch?v=ZeQ9Chg9_Fk', '../media/moviePosters/marvel_studios\'_avengers-_endgame_encore.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Other Mommy', 'Horror', 'An eight-year-old girl living in a home with marital problems confronts a sinister entity that comes out of her closet, whom she calls Other Mommy.', '2027-02-04', 'https://www.youtube.com/watch?v=pncQkAb4ghw', '../media/moviePosters/other_mommy.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Resident Evil', 'Horror', 'A medical courier on a routine delivery to Raccoon General Hospital becomes caught in the midst of a viral outbreak that transforms the city\'s inhabitants into mutated monsters.', '2027-04-18', 'https://www.youtube.com/watch?v=tpvFiLlqaDY', '../media/moviePosters/resident_evil.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Shaun the Sheep: The Beast of Mossy Bottom', 'Animation', 'When Shaun turns mad scientist to fix a problem, things rapidly spiral out of control with the Farmer missing and a wild beast roaming the woods of Mossingham.', '2027-04-01', 'https://www.youtube.com/watch?v=WDPloiT8x_g', '../media/moviePosters/shaun_the_sheep-_the_beast_of_mossy_bottom.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Street Fighter', 'Action', 'Set in 1993, estranged fighters Ryu and Ken Masters are thrown back into combat when the mysterious Chun-Li recruits them for the next World Warrior Tournament.', '2027-02-02', 'https://www.youtube.com/watch?v=7C3iceq5kS8', '../media/moviePosters/street_fighter.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('The Mage', 'Horror', 'Garbage collector Lan Pui Ching discovers a hanging corpse that unearths a dark secret from her past, revealing a series of suspicious deaths driven by supernatural forces.', '2027-04-07', 'https://www.youtube.com/watch?v=rGc4fRuXnR0', '../media/moviePosters/the_mage.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('The Odyssey', 'Adventure', 'After the Trojan War, King Odysseus faces a long adventure full of danger as he attempts to return home to his wife Penelope and son Telemachus.', '2027-03-17', 'https://www.youtube.com/watch?v=53n0CgYE3nI', '../media/moviePosters/the_odyssey.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('The Sandbox', 'Documentary', 'A chilling look at intense, inescapable surveillance and control, exposing how modern systems watch, track, and confine the lives of citizens and migrants.', '2027-01-26', 'https://www.youtube.com/watch?v=OAUp6HWIFRE', '../media/moviePosters/the_sandbox.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Verity', 'Thriller', 'Struggling writer Lowen Ashleigh is hired to complete the remaining books of a successful series after the original author, Verity Crawford, is unable to finish them, uncovering unsettling secrets at the Crawford estate.', '2027-01-25', 'https://www.youtube.com/watch?v=x03GVx8KXl0', '../media/moviePosters/verity.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Whalefall', 'Thriller', 'Searching for his deceased father\'s remains off the California coast, young diver Jay is swallowed by a sperm whale and trapped inside with only one hour of oxygen left.', '2027-02-02', 'https://www.youtube.com/watch?v=zNxZSHIuWDk', '../media/moviePosters/whalefall.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('PAW Patrol: The Dino Movie', 'Animation', 'The PAW Patrol lands on a mysterious dinosaur island after a storm, where they meet a stranded pup named Rex and must stop Humdinger\'s reckless mining from triggering a volcano.', '2027-02-18', 'https://www.youtube.com/watch?v=nZ1RAVSs76E', '../media/moviePosters/paw_patrol-_the_dino_movie.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('By Any Means', 'Crime', 'A notorious mafia hitman and a young Black FBI agent team up to investigate the murders of civil rights leaders in 1966 Mississippi.', '2027-02-20', 'https://www.youtube.com/watch?v=vXw2FP4f7DY', '../media/moviePosters/by_any_means.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Charlie Harper', 'Romance', 'Harper and Charlie try to build a life together across a non-linear timeline as Harper strives to carve out a career as a chef while Charlie struggles to find his path.', '2027-03-27', 'https://www.youtube.com/watch?v=9d2eZ2r3Y-c', '../media/moviePosters/charlie_harper.jpeg')",
        "INSERT INTO movies (title, genre, description, lastScreening, trailerLink, posterPath) VALUES ('Heart of the Beast', 'Adventure', 'After a harrowing plane crash, Special Forces officer James Belmont and his combat dog, Odin, find themselves stranded deep in the Alaskan wilderness in a brutal fight for survival.', '2027-04-09', 'https://www.youtube.com/watch?v=Ni2T9Uj8tSM', '../media/moviePosters/heart_of_the_beast.jpeg')"
    ];

    foreach ($insertMovies as $insertQuery) {
        $db->query($insertQuery);
    }
}


$roomCheck = $db->query("SELECT COUNT(*) AS total FROM screeningRooms");
if ($roomCheck) {
    $roomRow = $roomCheck->fetch_assoc();
    if ((int) $roomRow['total'] === 0) {
        $db->query("INSERT INTO screeningRooms (noOfSeats) VALUES (75), (100), (125), (150), (175)");
    }
}


$screeningsCheck = $db->query("SELECT COUNT(*) AS total FROM screenings");
if ($screeningsCheck) {
    $screeningsRow = $screeningsCheck->fetch_assoc();
    if ((int) $screeningsRow['total'] === 0) {
        $moviesResult = $db->query("SELECT movieId FROM movies");
        $roomsResult = $db->query("SELECT roomId FROM screeningRooms");

        $roomIds = [];
        if ($roomsResult) {
            while ($room = $roomsResult->fetch_assoc()) {
                $roomIds[] = (int) $room['roomId'];
            }
        }

        if ($moviesResult && $moviesResult->num_rows > 0 && !empty($roomIds)) {
            $timeSlots = [];
            for ($hour = 10; $hour <= 21; $hour++) {
                foreach (['00', '15', '30', '45'] as $min) {
                    $timeSlots[] = sprintf('%02d:%s:00', $hour, $min);
                }
            }
            $timeSlots[] = '22:00:00';

            $year = date('Y');
            $stmt = $db->prepare("INSERT INTO screenings (roomId, movieId, startDate, startTime) VALUES (?, ?, ?, ?)");

            while ($movie = $moviesResult->fetch_assoc()) {
                $movieId = (int) $movie['movieId'];
                for ($i = 0; $i < 10; $i++) {
                    $day = rand(1, 10);
                    $startDate = sprintf('%s-11-%02d', $year, $day);
                    $startTime = $timeSlots[array_rand($timeSlots)];
                    $roomId = $roomIds[array_rand($roomIds)];

                    $stmt->bind_param("iiss", $roomId, $movieId, $startDate, $startTime);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }
    }
}
?>