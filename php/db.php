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

$queries = [
    "CREATE TABLE IF NOT EXISTS users (
        userId INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255),
        birthday DATE,
        password VARCHAR(255)
    )",
    "CREATE TABLE IF NOT EXISTS movies (
        movieId INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        genre VARCHAR(255),
        description TEXT,
        lastScreening DATE,
        trailerLink VARCHAR(255);
        posterPath VARCHAR(255);
    )",
    "CREATE TABLE IF NOT EXISTS screeningRooms (
        roomId INT AUTO_INCREMENT PRIMARY KEY,
        noOfSeats INT
    )",
    "CREATE TABLE IF NOT EXISTS screenings (
        screeningId INT AUTO_INCREMENT PRIMARY KEY,
        movieId INT,
        startDate DATE,
        startTime TIME,
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
?>