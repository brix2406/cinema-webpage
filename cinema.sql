-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2026 at 05:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `screeningId` int(11) DEFAULT NULL,
  `noOfTickets` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingId`, `userId`, `screeningId`, `noOfTickets`) VALUES
(1, 1, 138, 2),
(2, 1, 33, 2);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movieId` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `lastScreening` date DEFAULT NULL,
  `trailerLink` varchar(255) DEFAULT NULL,
  `posterPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieId`, `title`, `genre`, `description`, `lastScreening`, `trailerLink`, `posterPath`) VALUES
(1, 'Clayface', 'Horror', 'A B-movie actor injects himself with a substance to keep himself relevant, only to find out that he can reshape his face and form, becoming a walking piece of clay.', '2027-04-13', 'https://www.youtube.com/watch?v=Fu3SrXI52zk', '../media/moviePosters/clayface.jpeg'),
(2, 'Wildwood', 'Animation', 'Following her brother\'s abduction, Prue sets out to rescue him in the enchanted forest of Wildwood, where the destiny of an entire hidden world depends on her choices.', '2027-02-05', 'https://www.youtube.com/watch?v=Ml8D_0G5QeU', '../media/moviePosters/wildwood.jpeg'),
(3, 'Klara and the Sun', 'Sci-Fi', 'In a dystopian future where genetic engineering has divided humans into strict social classes, an Artificial Friend named Klara tries to bond with a sick girl named Josie.', '2027-01-25', 'https://www.youtube.com/watch?v=pcUuT3CcjPM', '../media/moviePosters/klara_and_the_sun.jpeg'),
(4, 'Digger', 'Comedy', 'A disastrous drilling accident in Greenland threatens the globe, forcing oil magnate Digger Rockwell into a frantic cover-up as global chaos escalates.', '2027-02-26', 'https://www.youtube.com/watch?v=_Z5-kz1JUhw', '../media/moviePosters/digger.jpeg'),
(5, 'Forgotten Island', 'Animation', 'When they discover that the memories of their entire friendship are the price for returning home, Jo and Raissa must race to leave a mysterious island before they forget each other forever.', '2027-02-22', 'https://www.youtube.com/watch?v=aCvQc6Mt7gE', '../media/moviePosters/forgotten_island.jpeg'),
(6, 'Jailer 2', 'Action', 'Idol smugglers clash with Muthuvel Pandian after Varman\'s death as he battles a new gang and faces the changing dynamics of his family.', '2027-02-19', 'https://www.youtube.com/watch?v=4qs-GMa1ttY', '../media/moviePosters/jailer_2.jpeg'),
(7, 'Marvel Studios\' Avengers: Endgame Encore', 'Action', 'After the devastating events of Avengers: Infinity War, the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos\' actions and restore balance to the universe.', '2027-02-08', 'https://www.youtube.com/watch?v=ZeQ9Chg9_Fk', '../media/moviePosters/marvel_studios\'_avengers-_endgame_encore.jpeg'),
(8, 'Other Mommy', 'Horror', 'An eight-year-old girl living in a home with marital problems confronts a sinister entity that comes out of her closet, whom she calls Other Mommy.', '2027-02-04', 'https://www.youtube.com/watch?v=pncQkAb4ghw', '../media/moviePosters/other_mommy.jpeg'),
(9, 'Resident Evil', 'Horror', 'A medical courier on a routine delivery to Raccoon General Hospital becomes caught in the midst of a viral outbreak that transforms the city\'s inhabitants into mutated monsters.', '2027-04-18', 'https://www.youtube.com/watch?v=tpvFiLlqaDY', '../media/moviePosters/resident_evil.jpeg'),
(10, 'Shaun the Sheep: The Beast of Mossy Bottom', 'Animation', 'When Shaun turns mad scientist to fix a problem, things rapidly spiral out of control with the Farmer missing and a wild beast roaming the woods of Mossingham.', '2027-04-01', 'https://www.youtube.com/watch?v=WDPloiT8x_g', '../media/moviePosters/shaun_the_sheep-_the_beast_of_mossy_bottom.jpeg'),
(11, 'Street Fighter', 'Action', 'Set in 1993, estranged fighters Ryu and Ken Masters are thrown back into combat when the mysterious Chun-Li recruits them for the next World Warrior Tournament.', '2027-02-02', 'https://www.youtube.com/watch?v=7C3iceq5kS8', '../media/moviePosters/street_fighter.jpeg'),
(12, 'The Mage', 'Horror', 'Garbage collector Lan Pui Ching discovers a hanging corpse that unearths a dark secret from her past, revealing a series of suspicious deaths driven by supernatural forces.', '2027-04-07', 'https://www.youtube.com/watch?v=rGc4fRuXnR0', '../media/moviePosters/the_mage.jpeg'),
(13, 'The Odyssey', 'Adventure', 'After the Trojan War, King Odysseus faces a long adventure full of danger as he attempts to return home to his wife Penelope and son Telemachus.', '2027-03-17', 'https://www.youtube.com/watch?v=53n0CgYE3nI', '../media/moviePosters/the_odyssey.jpeg'),
(14, 'The Sandbox', 'Documentary', 'A chilling look at intense, inescapable surveillance and control, exposing how modern systems watch, track, and confine the lives of citizens and migrants.', '2027-01-26', 'https://www.youtube.com/watch?v=OAUp6HWIFRE', '../media/moviePosters/the_sandbox.jpeg'),
(15, 'Verity', 'Thriller', 'Struggling writer Lowen Ashleigh is hired to complete the remaining books of a successful series after the original author, Verity Crawford, is unable to finish them, uncovering unsettling secrets at the Crawford estate.', '2027-01-25', 'https://www.youtube.com/watch?v=x03GVx8KXl0', '../media/moviePosters/verity.jpeg'),
(16, 'Whalefall', 'Thriller', 'Searching for his deceased father\'s remains off the California coast, young diver Jay is swallowed by a sperm whale and trapped inside with only one hour of oxygen left.', '2027-02-02', 'https://www.youtube.com/watch?v=zNxZSHIuWDk', '../media/moviePosters/whalefall.jpeg'),
(17, 'PAW Patrol: The Dino Movie', 'Animation', 'The PAW Patrol lands on a mysterious dinosaur island after a storm, where they meet a stranded pup named Rex and must stop Humdinger\'s reckless mining from triggering a volcano.', '2027-02-18', 'https://www.youtube.com/watch?v=nZ1RAVSs76E', '../media/moviePosters/paw_patrol-_the_dino_movie.jpeg'),
(18, 'By Any Means', 'Crime', 'A notorious mafia hitman and a young Black FBI agent team up to investigate the murders of civil rights leaders in 1966 Mississippi.', '2027-02-20', 'https://www.youtube.com/watch?v=vXw2FP4f7DY', '../media/moviePosters/by_any_means.jpeg'),
(19, 'Charlie Harper', 'Romance', 'Harper and Charlie try to build a life together across a non-linear timeline as Harper strives to carve out a career as a chef while Charlie struggles to find his path.', '2027-03-27', 'https://www.youtube.com/watch?v=9d2eZ2r3Y-c', '../media/moviePosters/charlie_harper.jpeg'),
(20, 'Heart of the Beast', 'Adventure', 'After a harrowing plane crash, Special Forces officer James Belmont and his combat dog, Odin, find themselves stranded deep in the Alaskan wilderness in a brutal fight for survival.', '2027-04-09', 'https://www.youtube.com/watch?v=Ni2T9Uj8tSM', '../media/moviePosters/heart_of_the_beast.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `screeningRooms`
--

CREATE TABLE `screeningRooms` (
  `roomId` int(11) NOT NULL,
  `noOfSeats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screeningRooms`
--

INSERT INTO `screeningRooms` (`roomId`, `noOfSeats`) VALUES
(1, 75),
(2, 100),
(3, 125),
(4, 150),
(5, 175);

-- --------------------------------------------------------

--
-- Table structure for table `screenings`
--

CREATE TABLE `screenings` (
  `screeningId` int(11) NOT NULL,
  `roomId` int(11) DEFAULT NULL,
  `movieId` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `startTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screenings`
--

INSERT INTO `screenings` (`screeningId`, `roomId`, `movieId`, `startDate`, `startTime`) VALUES
(1, 3, 1, '2026-11-02', '10:00:00'),
(2, 1, 1, '2026-11-07', '10:00:00'),
(3, 2, 1, '2026-11-10', '20:00:00'),
(4, 5, 1, '2026-11-02', '18:00:00'),
(5, 3, 1, '2026-11-08', '18:15:00'),
(6, 3, 1, '2026-11-03', '21:15:00'),
(7, 2, 1, '2026-11-01', '18:15:00'),
(8, 5, 1, '2026-11-04', '10:30:00'),
(9, 3, 1, '2026-11-03', '13:45:00'),
(10, 1, 1, '2026-11-07', '16:45:00'),
(11, 2, 2, '2026-11-07', '12:15:00'),
(12, 3, 2, '2026-11-05', '10:00:00'),
(13, 2, 2, '2026-11-06', '16:00:00'),
(14, 5, 2, '2026-11-05', '14:00:00'),
(15, 1, 2, '2026-11-02', '17:45:00'),
(16, 5, 2, '2026-11-06', '12:00:00'),
(17, 4, 2, '2026-11-09', '10:45:00'),
(18, 2, 2, '2026-11-07', '16:30:00'),
(19, 2, 2, '2026-11-02', '18:00:00'),
(20, 3, 2, '2026-11-02', '15:45:00'),
(21, 1, 3, '2026-11-01', '21:45:00'),
(22, 2, 3, '2026-11-03', '18:45:00'),
(23, 3, 3, '2026-11-06', '16:15:00'),
(24, 1, 3, '2026-11-06', '10:45:00'),
(25, 2, 3, '2026-11-09', '12:30:00'),
(26, 1, 3, '2026-11-05', '13:30:00'),
(27, 5, 3, '2026-11-08', '22:00:00'),
(28, 4, 3, '2026-11-10', '14:15:00'),
(29, 4, 3, '2026-11-10', '21:15:00'),
(30, 3, 3, '2026-11-01', '12:00:00'),
(31, 1, 4, '2026-11-10', '17:00:00'),
(32, 4, 4, '2026-11-09', '18:45:00'),
(33, 3, 4, '2026-11-06', '19:30:00'),
(34, 3, 4, '2026-11-10', '21:15:00'),
(35, 5, 4, '2026-11-01', '16:00:00'),
(36, 3, 4, '2026-11-02', '13:15:00'),
(37, 5, 4, '2026-11-06', '16:45:00'),
(38, 5, 4, '2026-11-08', '14:45:00'),
(39, 1, 4, '2026-11-03', '19:45:00'),
(40, 5, 4, '2026-11-09', '11:45:00'),
(41, 2, 5, '2026-11-03', '15:45:00'),
(42, 4, 5, '2026-11-02', '11:15:00'),
(43, 4, 5, '2026-11-03', '17:00:00'),
(44, 5, 5, '2026-11-08', '13:15:00'),
(45, 5, 5, '2026-11-04', '10:30:00'),
(46, 5, 5, '2026-11-08', '21:00:00'),
(47, 4, 5, '2026-11-07', '13:00:00'),
(48, 4, 5, '2026-11-07', '15:45:00'),
(49, 3, 5, '2026-11-10', '19:15:00'),
(50, 4, 5, '2026-11-05', '12:00:00'),
(51, 5, 6, '2026-11-05', '10:30:00'),
(52, 3, 6, '2026-11-08', '19:15:00'),
(53, 5, 6, '2026-11-02', '12:45:00'),
(54, 1, 6, '2026-11-06', '15:30:00'),
(55, 1, 6, '2026-11-07', '14:15:00'),
(56, 2, 6, '2026-11-06', '17:00:00'),
(57, 5, 6, '2026-11-01', '10:00:00'),
(58, 5, 6, '2026-11-04', '14:45:00'),
(59, 2, 6, '2026-11-02', '13:45:00'),
(60, 2, 6, '2026-11-05', '15:00:00'),
(61, 1, 7, '2026-11-07', '10:15:00'),
(62, 5, 7, '2026-11-04', '17:45:00'),
(63, 3, 7, '2026-11-02', '13:45:00'),
(64, 5, 7, '2026-11-08', '16:45:00'),
(65, 3, 7, '2026-11-05', '22:00:00'),
(66, 1, 7, '2026-11-05', '19:00:00'),
(67, 4, 7, '2026-11-04', '18:00:00'),
(68, 3, 7, '2026-11-02', '18:30:00'),
(69, 1, 7, '2026-11-06', '15:45:00'),
(70, 1, 7, '2026-11-09', '19:00:00'),
(71, 3, 8, '2026-11-04', '13:45:00'),
(72, 1, 8, '2026-11-01', '18:30:00'),
(73, 1, 8, '2026-11-10', '12:00:00'),
(74, 5, 8, '2026-11-01', '11:15:00'),
(75, 4, 8, '2026-11-02', '12:00:00'),
(76, 2, 8, '2026-11-07', '17:45:00'),
(77, 2, 8, '2026-11-10', '21:00:00'),
(78, 4, 8, '2026-11-09', '20:30:00'),
(79, 1, 8, '2026-11-05', '12:30:00'),
(80, 1, 8, '2026-11-06', '12:15:00'),
(81, 1, 9, '2026-11-09', '19:45:00'),
(82, 5, 9, '2026-11-03', '14:15:00'),
(83, 3, 9, '2026-11-02', '12:30:00'),
(84, 5, 9, '2026-11-09', '17:45:00'),
(85, 1, 9, '2026-11-01', '20:30:00'),
(86, 3, 9, '2026-11-10', '14:30:00'),
(87, 2, 9, '2026-11-09', '16:00:00'),
(88, 4, 9, '2026-11-10', '15:45:00'),
(89, 1, 9, '2026-11-07', '18:15:00'),
(90, 3, 9, '2026-11-07', '17:30:00'),
(91, 4, 10, '2026-11-04', '20:00:00'),
(92, 2, 10, '2026-11-03', '14:30:00'),
(93, 1, 10, '2026-11-02', '14:15:00'),
(94, 5, 10, '2026-11-02', '13:30:00'),
(95, 3, 10, '2026-11-06', '15:15:00'),
(96, 1, 10, '2026-11-01', '18:00:00'),
(97, 1, 10, '2026-11-06', '17:15:00'),
(98, 3, 10, '2026-11-07', '13:15:00'),
(99, 4, 10, '2026-11-03', '17:15:00'),
(100, 2, 10, '2026-11-02', '11:15:00'),
(101, 3, 11, '2026-11-03', '20:15:00'),
(102, 3, 11, '2026-11-08', '10:00:00'),
(103, 3, 11, '2026-11-10', '15:15:00'),
(104, 2, 11, '2026-11-09', '13:15:00'),
(105, 1, 11, '2026-11-03', '17:15:00'),
(106, 5, 11, '2026-11-06', '15:00:00'),
(107, 5, 11, '2026-11-02', '20:45:00'),
(108, 3, 11, '2026-11-07', '11:45:00'),
(109, 5, 11, '2026-11-08', '11:30:00'),
(110, 1, 11, '2026-11-02', '20:00:00'),
(111, 4, 12, '2026-11-05', '15:30:00'),
(112, 4, 12, '2026-11-06', '16:45:00'),
(113, 1, 12, '2026-11-02', '18:45:00'),
(114, 3, 12, '2026-11-03', '18:45:00'),
(115, 5, 12, '2026-11-08', '11:30:00'),
(116, 1, 12, '2026-11-01', '22:00:00'),
(117, 4, 12, '2026-11-03', '17:00:00'),
(118, 1, 12, '2026-11-04', '15:30:00'),
(119, 2, 12, '2026-11-09', '20:30:00'),
(120, 3, 12, '2026-11-07', '13:15:00'),
(121, 2, 13, '2026-11-10', '20:30:00'),
(122, 3, 13, '2026-11-05', '10:15:00'),
(123, 5, 13, '2026-11-06', '15:00:00'),
(124, 1, 13, '2026-11-03', '20:30:00'),
(125, 4, 13, '2026-11-07', '21:30:00'),
(126, 1, 13, '2026-11-04', '16:00:00'),
(127, 4, 13, '2026-11-02', '16:00:00'),
(128, 2, 13, '2026-11-10', '20:00:00'),
(129, 2, 13, '2026-11-10', '10:15:00'),
(130, 1, 13, '2026-11-08', '17:45:00'),
(131, 5, 14, '2026-11-02', '20:30:00'),
(132, 4, 14, '2026-11-09', '21:45:00'),
(133, 4, 14, '2026-11-03', '16:45:00'),
(134, 1, 14, '2026-11-04', '11:15:00'),
(135, 3, 14, '2026-11-01', '13:30:00'),
(136, 4, 14, '2026-11-02', '19:45:00'),
(137, 2, 14, '2026-11-04', '22:00:00'),
(138, 3, 14, '2026-11-07', '10:45:00'),
(139, 3, 14, '2026-11-10', '20:15:00'),
(140, 3, 14, '2026-11-05', '21:45:00'),
(141, 2, 15, '2026-11-05', '11:45:00'),
(142, 2, 15, '2026-11-07', '15:15:00'),
(143, 3, 15, '2026-11-03', '13:00:00'),
(144, 2, 15, '2026-11-06', '15:15:00'),
(145, 1, 15, '2026-11-02', '12:45:00'),
(146, 2, 15, '2026-11-10', '13:15:00'),
(147, 4, 15, '2026-11-07', '11:45:00'),
(148, 2, 15, '2026-11-09', '16:30:00'),
(149, 1, 15, '2026-11-07', '19:30:00'),
(150, 3, 15, '2026-11-04', '19:45:00'),
(151, 1, 16, '2026-11-08', '11:30:00'),
(152, 5, 16, '2026-11-03', '11:30:00'),
(153, 4, 16, '2026-11-08', '10:15:00'),
(154, 4, 16, '2026-11-07', '11:30:00'),
(155, 4, 16, '2026-11-09', '15:45:00'),
(156, 1, 16, '2026-11-06', '11:00:00'),
(157, 5, 16, '2026-11-01', '19:00:00'),
(158, 4, 16, '2026-11-03', '10:15:00'),
(159, 3, 16, '2026-11-09', '12:00:00'),
(160, 3, 16, '2026-11-10', '10:45:00'),
(161, 3, 17, '2026-11-02', '13:15:00'),
(162, 2, 17, '2026-11-02', '14:45:00'),
(163, 1, 17, '2026-11-02', '16:15:00'),
(164, 2, 17, '2026-11-04', '15:45:00'),
(165, 3, 17, '2026-11-09', '17:00:00'),
(166, 1, 17, '2026-11-08', '15:45:00'),
(167, 1, 17, '2026-11-08', '15:30:00'),
(168, 5, 17, '2026-11-08', '11:45:00'),
(169, 3, 17, '2026-11-06', '12:00:00'),
(170, 5, 17, '2026-11-08', '17:00:00'),
(171, 4, 18, '2026-11-04', '10:15:00'),
(172, 5, 18, '2026-11-02', '17:45:00'),
(173, 4, 18, '2026-11-05', '10:30:00'),
(174, 3, 18, '2026-11-07', '10:00:00'),
(175, 3, 18, '2026-11-10', '19:45:00'),
(176, 3, 18, '2026-11-05', '12:00:00'),
(177, 2, 18, '2026-11-10', '10:30:00'),
(178, 4, 18, '2026-11-05', '17:30:00'),
(179, 3, 18, '2026-11-09', '11:30:00'),
(180, 1, 18, '2026-11-02', '16:00:00'),
(181, 2, 19, '2026-11-07', '14:00:00'),
(182, 1, 19, '2026-11-03', '12:15:00'),
(183, 5, 19, '2026-11-03', '10:00:00'),
(184, 1, 19, '2026-11-08', '16:30:00'),
(185, 4, 19, '2026-11-10', '18:00:00'),
(186, 1, 19, '2026-11-02', '20:00:00'),
(187, 1, 19, '2026-11-07', '10:30:00'),
(188, 5, 19, '2026-11-05', '16:00:00'),
(189, 4, 19, '2026-11-03', '14:00:00'),
(190, 4, 19, '2026-11-08', '13:00:00'),
(191, 2, 20, '2026-11-05', '18:30:00'),
(192, 4, 20, '2026-11-01', '18:45:00'),
(193, 4, 20, '2026-11-06', '18:30:00'),
(194, 1, 20, '2026-11-02', '20:00:00'),
(195, 1, 20, '2026-11-04', '14:45:00'),
(196, 3, 20, '2026-11-06', '16:30:00'),
(197, 5, 20, '2026-11-02', '14:15:00'),
(198, 5, 20, '2026-11-05', '12:30:00'),
(199, 2, 20, '2026-11-03', '19:00:00'),
(200, 3, 20, '2026-11-05', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `email`, `password`) VALUES
(1, 'Elias Brix Lauridsen', 'eliasbrix01@gmail.com', '$2y$10$rGJxVUrsdA0dnJ36vSP9OO9lx7ge/E/CG8hMZ6o9xoI5l69c66Gqe'),
(2, 'elias brix', 'elias@brixlauridsen.dk.dk.dk.dk.dk', '$2y$10$gZq3Q6/O775lQ1AyXbFRAexrNJLag.02qk642lIS0mxP5bK4Q3hqG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `screeningId` (`screeningId`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieId`);

--
-- Indexes for table `screeningRooms`
--
ALTER TABLE `screeningRooms`
  ADD PRIMARY KEY (`roomId`);

--
-- Indexes for table `screenings`
--
ALTER TABLE `screenings`
  ADD PRIMARY KEY (`screeningId`),
  ADD KEY `roomId` (`roomId`),
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `screeningRooms`
--
ALTER TABLE `screeningRooms`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `screenings`
--
ALTER TABLE `screenings`
  MODIFY `screeningId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`screeningId`) REFERENCES `screenings` (`screeningId`) ON DELETE CASCADE;

--
-- Constraints for table `screenings`
--
ALTER TABLE `screenings`
  ADD CONSTRAINT `screenings_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `screeningRooms` (`roomId`) ON DELETE CASCADE,
  ADD CONSTRAINT `screenings_ibfk_2` FOREIGN KEY (`movieId`) REFERENCES `movies` (`movieId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
