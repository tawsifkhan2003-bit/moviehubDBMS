-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 28, 2026 at 03:23 PM
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
-- Database: `moviehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `Actors`
--

CREATE TABLE `Actors` (
  `actor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `average_rating` decimal(3,2) DEFAULT NULL,
  `individual_awards` text DEFAULT NULL,
  `role_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Actors`
--

INSERT INTO `Actors` (`actor_id`, `name`, `birth_date`, `gender`, `nationality`, `average_rating`, `individual_awards`, `role_type`) VALUES
(1, 'Leonardo DiCaprio', '1974-11-11', 'Male', 'American', 9.00, 'Academy Award – Best Actor (2016)', 'Lead'),
(2, 'Joseph Gordon-Levitt', '1981-02-17', 'Male', 'American', 9.00, 'None recorded in current dataset', 'Support'),
(3, 'Tom Hardy', '1977-09-15', 'Male', 'British', 8.93, 'None recorded in current dataset', 'Antagonist'),
(4, 'Matthew McConaughey', '1969-11-04', 'Male', 'American', 8.83, 'Academy Award – Best Actor (2014)', 'Lead'),
(5, 'Timothee Chalamet', '1995-12-27', 'Male', 'American', 9.14, 'None recorded in current dataset', 'Lead'),
(6, 'Zendaya', '1996-09-01', 'Female', 'American', 9.14, 'Primetime Emmy Award – Outstanding Lead Actress (2020, 2022)', 'Lead'),
(7, 'Harrison Ford', '1942-07-13', 'Male', 'American', 8.57, 'None recorded in current dataset', 'Support'),
(8, 'Ryan Gosling', '1980-11-12', 'Male', 'Canadian', 8.25, 'None recorded in current dataset', 'Lead'),
(9, 'Sam Worthington', '1976-08-02', 'Male', 'Australian', 8.75, 'None recorded in current dataset', 'Lead'),
(10, 'Zoe Saldana', '1978-06-19', 'Female', 'American', 9.00, 'None recorded in current dataset', 'Lead'),
(11, 'Elijah Wood', '1981-01-28', 'Male', 'American', 9.14, 'None recorded in current dataset', 'Lead'),
(12, 'Ian McKellen', '1939-05-25', 'Male', 'British', 9.19, 'None recorded in current dataset', 'Support'),
(13, 'Margot Robbie', '1990-07-02', 'Female', 'Australian', 8.75, 'None recorded in current dataset', 'Lead'),
(14, 'Saoirse Ronan', '1994-04-12', 'Female', 'Irish', 8.75, 'None recorded in current dataset', 'Support'),
(15, 'Song Kang-ho', '1967-01-17', 'Male', 'South Korean', 9.33, 'Cannes Film Festival – Best Actor (2007)', 'Lead'),
(16, 'Robert De Niro', '1943-08-17', 'Male', 'American', 8.88, 'Academy Award – Best Supporting Actor (1975, 1981)', 'Lead'),
(17, 'John Travolta', '1954-02-18', 'Male', 'American', 8.75, 'Golden Globe – Best Actor (1996)', 'Lead'),
(18, 'Robert Downey Jr.', '1965-04-04', 'Male', 'American', 9.00, 'Academy Award – Best Supporting Actor (2024)', 'Lead'),
(19, 'Chris Evans', '1981-06-13', 'Male', 'American', 9.10, 'None recorded in current dataset', 'Lead'),
(20, 'Scarlett Johansson', '1984-11-22', 'Female', 'American', 9.10, 'None recorded in current dataset', 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `Awards`
--

CREATE TABLE `Awards` (
  `award_id` int(11) NOT NULL,
  `award_name` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Awards`
--

INSERT INTO `Awards` (`award_id`, `award_name`, `organization`, `category`) VALUES
(1, 'Academy Award', 'Academy of Motion Picture Arts and Sciences', 'Best Picture'),
(2, 'Academy Award', 'Academy of Motion Picture Arts and Sciences', 'Best Director'),
(3, 'Golden Globe', 'Hollywood Foreign Press Association', 'Best Motion Picture'),
(4, 'BAFTA', 'British Academy', 'Best Film'),
(5, 'BAFTA', 'British Academy', 'Best Director'),
(6, 'Critics Choice', 'Critics Choice Association', 'Best Picture'),
(7, 'Saturn Award', 'Academy of Science Fiction', 'Best Science Fiction Film'),
(8, 'SAG Award', 'Screen Actors Guild', 'Outstanding Cast'),
(9, 'Cannes Award', 'Cannes Film Festival', 'Palme d’Or'),
(10, 'Grammy Award', 'Recording Academy', 'Best Soundtrack');

-- --------------------------------------------------------

--
-- Table structure for table `Directors`
--

CREATE TABLE `Directors` (
  `director_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `average_rating` decimal(3,2) DEFAULT NULL,
  `individual_awards` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Directors`
--

INSERT INTO `Directors` (`director_id`, `name`, `birth_date`, `nationality`, `average_rating`, `individual_awards`) VALUES
(1, 'Christopher Nolan', '1970-07-30', 'British', 8.93, 'Academy Award – Best Director (2024)'),
(2, 'Denis Villeneuve', '1967-10-03', 'Canadian', 8.94, 'None recorded in current dataset'),
(3, 'Steven Spielberg', '1946-12-18', 'American', 9.00, 'Academy Awards – Best Director (1994, 1999)'),
(4, 'James Cameron', '1954-08-16', 'Canadian', 9.00, 'Academy Award – Best Director (1998)'),
(5, 'Peter Jackson', '1961-10-31', 'New Zealander', 9.19, 'Academy Award – Best Director (2004)'),
(6, 'Greta Gerwig', '1983-08-04', 'American', 8.75, 'None recorded in current dataset'),
(7, 'Bong Joon-ho', '1969-09-14', 'South Korean', 9.33, 'Academy Award – Best Director (2020)'),
(8, 'Martin Scorsese', '1942-11-17', 'American', 8.92, 'Academy Award – Best Director (2007)'),
(9, 'Quentin Tarantino', '1963-03-27', 'American', 8.75, 'Academy Award – Best Original Screenplay (1995, 2013)'),
(10, 'Jon Favreau', '1966-10-19', 'American', 8.50, 'None recorded in current dataset'),
(11, 'Anthony Russo', '1970-02-03', 'American', 9.10, 'None recorded in current dataset'),
(12, 'Joe Russo', '1971-07-18', 'American', 9.10, 'None recorded in current dataset');

-- --------------------------------------------------------

--
-- Table structure for table `Franchises`
--

CREATE TABLE `Franchises` (
  `franchise_id` int(11) NOT NULL,
  `franchise_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Franchises`
--

INSERT INTO `Franchises` (`franchise_id`, `franchise_name`, `description`) VALUES
(1, 'The Lord of the Rings', 'Fantasy film series based on the novels of J.R.R. Tolkien'),
(2, 'Avatar', 'Science fiction film series set on Pandora'),
(3, 'Marvel Cinematic Universe', 'Shared superhero film universe'),
(4, 'Jurassic Park', 'Science fiction adventure franchise'),
(5, 'Dune', 'Science fiction film series based on the Dune novels');

-- --------------------------------------------------------

--
-- Table structure for table `Genres`
--

CREATE TABLE `Genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Genres`
--

INSERT INTO `Genres` (`genre_id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(7, 'Comedy'),
(8, 'Crime'),
(3, 'Drama'),
(6, 'Fantasy'),
(4, 'Science Fiction'),
(5, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `Movies`
--

CREATE TABLE `Movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `release_date` date DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `box_office` decimal(15,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster_url` varchar(500) DEFAULT NULL,
  `trailer_url` varchar(500) DEFAULT NULL,
  `age_rating` varchar(20) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Released'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movies`
--

INSERT INTO `Movies` (`movie_id`, `title`, `release_date`, `duration_minutes`, `language`, `country`, `budget`, `box_office`, `description`, `poster_url`, `trailer_url`, `age_rating`, `status`) VALUES
(1, 'Inception', '2010-07-16', 148, 'English', 'USA', 160000000.00, 839000000.00, 'A thief enters dreams to steal and plant ideas.', 'assets/posters/1.svg', 'https://www.youtube.com/embed/YoHD9XEInc0', 'PG-13', 'Released'),
(2, 'Interstellar', '2014-11-07', 169, 'English', 'USA', 165000000.00, 731000000.00, 'Explorers travel through space to find a new home for humanity.', 'assets/posters/2.svg', 'https://www.youtube.com/embed/zSWdZVtXT7E', 'PG-13', 'Released'),
(3, 'Dune', '2021-10-22', 155, 'English', 'USA', 165000000.00, 402000000.00, 'A young noble becomes involved in a struggle over a desert planet.', 'assets/posters/3.svg', 'https://www.youtube.com/embed/n9xhJrPXop4', 'PG-13', 'Released'),
(4, 'Blade Runner 2049', '2017-10-06', 164, 'English', 'USA', 150000000.00, 267000000.00, 'A future police officer discovers a hidden secret.', 'assets/posters/4.svg', 'https://www.youtube.com/embed/gCcx85zbxz4', 'R', 'Released'),
(5, 'Jurassic Park', '1993-06-11', 127, 'English', 'USA', 63000000.00, 1030000000.00, 'Scientists bring dinosaurs back to life in a theme park.', 'assets/posters/5.svg', 'https://www.youtube.com/embed/lc0UehYemQA', 'PG-13', 'Released'),
(6, 'Avatar', '2009-12-18', 162, 'English', 'USA', 237000000.00, 2923000000.00, 'A marine becomes involved in the conflict on Pandora.', 'assets/posters/6.svg', 'https://www.youtube.com/embed/5PSNL1qE6VY', 'PG-13', 'Released'),
(7, 'The Lord of the Rings: The Fellowship of the Ring', '2001-12-19', 178, 'English', 'New Zealand', 93000000.00, 898000000.00, 'A hobbit begins a dangerous journey to destroy a powerful ring.', 'assets/posters/7.svg', 'https://www.youtube.com/embed/V75dMMIW2B4', 'PG-13', 'Released'),
(8, 'The Lord of the Rings: The Two Towers', '2002-12-18', 179, 'English', 'New Zealand', 94000000.00, 947000000.00, 'The fellowship faces new threats across Middle-earth.', 'assets/posters/8.svg', 'https://www.youtube.com/embed/YersIyzsOpc', 'PG-13', 'Released'),
(9, 'Barbie', '2023-07-21', 114, 'English', 'USA', 145000000.00, 1446000000.00, 'Barbie leaves her perfect world and discovers the real world.', 'assets/posters/9.svg', 'https://www.youtube.com/embed/pBk4NYhWNMM', 'PG-13', 'Released'),
(10, 'Parasite', '2019-05-30', 132, 'Korean', 'South Korea', 11400000.00, 258000000.00, 'Two families become connected through deception and class conflict.', 'assets/posters/10.svg', 'https://www.youtube.com/embed/5xH0HfJHsaY', 'R', 'Released'),
(11, 'Goodfellas', '1990-09-19', 145, 'English', 'USA', 25000000.00, 47000000.00, 'The rise and fall of a man involved in organized crime.', 'assets/posters/11.svg', 'https://www.youtube.com/embed/2ilzidi_J8Q', 'R', 'Released'),
(12, 'Pulp Fiction', '1994-10-14', 154, 'English', 'USA', 8500000.00, 214000000.00, 'Several interconnected stories unfold in Los Angeles.', 'assets/posters/12.svg', 'https://www.youtube.com/embed/yMXB9u4z8Ic', 'R', 'Released'),
(13, 'Iron Man', '2008-05-02', 126, 'English', 'USA', 140000000.00, 585000000.00, 'A billionaire builds a powerful armored suit.', 'assets/posters/13.svg', 'https://www.youtube.com/embed/8ugaeA-nMTc', 'PG-13', 'Released'),
(14, 'Avengers: Endgame', '2019-04-26', 181, 'English', 'USA', 356000000.00, 2798000000.00, 'Heroes attempt to reverse the destruction caused by Thanos.', 'assets/posters/14.svg', 'https://www.youtube.com/embed/TcMBFSGVi1c', 'PG-13', 'Released'),
(15, 'The Avengers', '2012-05-04', 143, 'English', 'USA', 220000000.00, 1518000000.00, 'A group of superheroes joins together to save Earth.', 'assets/posters/15.svg', 'https://www.youtube.com/embed/eOrNdBpGMv8', 'PG-13', 'Released'),
(16, 'Dune: Part Two', '2024-03-01', 166, 'English', 'USA', 190000000.00, 711000000.00, 'Paul Atreides joins the Fremen and prepares for war.', 'assets/posters/16.svg', 'https://www.youtube.com/embed/U2Qp5pL3ovA', 'PG-13', 'Released'),
(17, 'The Lord of the Rings: The Return of the King', '2003-12-17', 201, 'English', 'New Zealand', 94000000.00, 1146000000.00, 'The final battle for Middle-earth begins.', 'assets/posters/17.svg', 'https://www.youtube.com/embed/r5X-hFf6Bwo', 'PG-13', 'Released'),
(18, 'Avatar: The Way of Water', '2022-12-16', 192, 'English', 'USA', 350000000.00, 2320000000.00, 'The Sully family seeks safety among the oceans of Pandora.', 'assets/posters/18.svg', 'https://www.youtube.com/embed/d9MyW72ELq0', 'PG-13', 'Released'),
(19, 'Jurassic World', '2015-06-12', 124, 'English', 'USA', 150000000.00, 1671000000.00, 'A new dinosaur theme park faces a dangerous outbreak.', 'assets/posters/19.svg', 'https://www.youtube.com/embed/RFinNxS5KN4', 'PG-13', 'Released'),
(20, 'The Departed', '2006-10-06', 151, 'English', 'USA', 90000000.00, 291000000.00, 'An undercover police officer and a criminal informant hide their identities.', 'assets/posters/20.svg', 'https://www.youtube.com/embed/ioJhqmMCLuE', 'R', 'Released');

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Actors`
--

CREATE TABLE `Movie_Actors` (
  `movie_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `character_name` varchar(100) DEFAULT NULL,
  `billing_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Actors`
--

INSERT INTO `Movie_Actors` (`movie_id`, `actor_id`, `character_name`, `billing_order`) VALUES
(1, 1, 'Cobb', 1),
(1, 2, 'Arthur', 2),
(1, 3, 'Eames', 3),
(2, 3, 'Mann', 2),
(2, 4, 'Cooper', 1),
(3, 5, 'Paul Atreides', 1),
(3, 6, 'Chani', 2),
(4, 7, 'Rick Deckard', 1),
(4, 8, 'K', 2),
(5, 7, 'Dr. Alan Grant', 1),
(5, 11, 'Tim', 2),
(6, 9, 'Jake Sully', 1),
(6, 10, 'Neytiri', 2),
(7, 11, 'Frodo', 1),
(7, 12, 'Gandalf', 2),
(8, 11, 'Frodo', 1),
(8, 12, 'Gandalf', 2),
(9, 13, 'Barbie', 1),
(9, 14, 'Sasha', 2),
(10, 15, 'Kim Ki-taek', 1),
(11, 16, 'Jimmy Conway', 1),
(12, 16, 'Marsellus Wallace', 2),
(12, 17, 'Vincent Vega', 1),
(13, 18, 'Tony Stark', 1),
(14, 18, 'Tony Stark', 1),
(14, 19, 'Steve Rogers', 2),
(14, 20, 'Natasha Romanoff', 3),
(15, 18, 'Tony Stark', 1),
(15, 19, 'Steve Rogers', 2),
(15, 20, 'Natasha Romanoff', 3),
(16, 5, 'Paul Atreides', 1),
(16, 6, 'Chani', 2),
(17, 11, 'Frodo', 1),
(17, 12, 'Gandalf', 2),
(18, 9, 'Jake Sully', 1),
(18, 10, 'Neytiri', 2),
(19, 7, 'Henry Wu', 2),
(19, 9, 'Owen Grady', 1),
(20, 16, 'Frank Costello', 1),
(20, 18, 'Colin Sullivan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Awards`
--

CREATE TABLE `Movie_Awards` (
  `movie_id` int(11) NOT NULL,
  `award_id` int(11) NOT NULL,
  `award_year` int(11) NOT NULL,
  `result` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Awards`
--

INSERT INTO `Movie_Awards` (`movie_id`, `award_id`, `award_year`, `result`) VALUES
(1, 1, 2011, 'Nominated'),
(1, 2, 2011, 'Nominated'),
(1, 7, 2011, 'Won'),
(2, 1, 2015, 'Nominated'),
(2, 7, 2015, 'Won'),
(3, 1, 2022, 'Nominated'),
(3, 2, 2022, 'Nominated'),
(3, 7, 2022, 'Won'),
(5, 1, 1994, 'Won'),
(5, 2, 1994, 'Nominated'),
(6, 1, 2010, 'Nominated'),
(6, 7, 2010, 'Won'),
(7, 1, 2002, 'Nominated'),
(7, 4, 2002, 'Won'),
(9, 1, 2024, 'Nominated'),
(9, 3, 2024, 'Won'),
(10, 1, 2020, 'Won'),
(10, 2, 2020, 'Nominated'),
(10, 9, 2019, 'Won'),
(11, 1, 1991, 'Nominated'),
(11, 2, 1991, 'Nominated'),
(12, 1, 1995, 'Won'),
(12, 2, 1995, 'Nominated'),
(14, 1, 2020, 'Nominated'),
(14, 8, 2020, 'Won'),
(16, 1, 2025, 'Nominated'),
(16, 7, 2025, 'Won'),
(17, 1, 2004, 'Won'),
(17, 2, 2004, 'Won'),
(20, 1, 2007, 'Nominated');

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Directors`
--

CREATE TABLE `Movie_Directors` (
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  `director_role` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Directors`
--

INSERT INTO `Movie_Directors` (`movie_id`, `director_id`, `director_role`, `start_date`, `end_date`) VALUES
(1, 1, 'Lead Director', '2009-01-01', '2010-03-01'),
(2, 1, 'Lead Director', '2012-01-01', '2014-03-01'),
(3, 2, 'Lead Director', '2019-01-01', '2021-05-01'),
(4, 2, 'Lead Director', '2016-01-01', '2017-04-01'),
(5, 3, 'Lead Director', '1992-01-01', '1993-03-01'),
(6, 4, 'Lead Director', '2007-01-01', '2009-05-01'),
(7, 5, 'Lead Director', '1999-01-01', '2001-07-01'),
(8, 5, 'Lead Director', '2000-01-01', '2002-07-01'),
(9, 6, 'Lead Director', '2021-01-01', '2023-02-01'),
(10, 7, 'Lead Director', '2018-01-01', '2019-02-01'),
(11, 8, 'Lead Director', '1989-01-01', '1990-05-01'),
(12, 9, 'Lead Director', '1993-01-01', '1994-05-01'),
(13, 10, 'Lead Director', '2007-01-01', '2008-03-01'),
(14, 11, 'Co-Director', '2017-01-01', '2019-02-01'),
(14, 12, 'Co-Director', '2017-01-01', '2019-02-01'),
(15, 11, 'Lead Director', '2010-01-01', '2012-02-01'),
(15, 12, 'Replacement Director', '2011-06-01', '2012-02-01'),
(16, 2, 'Lead Director', '2022-01-01', '2024-01-01'),
(17, 5, 'Lead Director', '2001-01-01', '2003-07-01'),
(18, 4, 'Lead Director', '2017-01-01', '2022-04-01'),
(19, 10, 'Lead Director', '2013-01-01', '2015-03-01'),
(20, 8, 'Lead Director', '2005-01-01', '2006-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Franchises`
--

CREATE TABLE `Movie_Franchises` (
  `movie_id` int(11) NOT NULL,
  `franchise_id` int(11) NOT NULL,
  `sequence_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Franchises`
--

INSERT INTO `Movie_Franchises` (`movie_id`, `franchise_id`, `sequence_number`) VALUES
(3, 5, 1),
(5, 4, 1),
(6, 2, 1),
(7, 1, 1),
(8, 1, 2),
(13, 3, 1),
(14, 3, 3),
(15, 3, 2),
(16, 5, 2),
(17, 1, 3),
(18, 2, 2),
(19, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Genres`
--

CREATE TABLE `Movie_Genres` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Genres`
--

INSERT INTO `Movie_Genres` (`movie_id`, `genre_id`) VALUES
(1, 1),
(1, 4),
(1, 5),
(2, 2),
(2, 3),
(2, 4),
(3, 2),
(3, 3),
(3, 4),
(4, 3),
(4, 4),
(4, 5),
(5, 2),
(5, 4),
(5, 5),
(6, 1),
(6, 2),
(6, 4),
(7, 2),
(7, 6),
(8, 2),
(8, 6),
(9, 3),
(9, 7),
(10, 3),
(10, 5),
(11, 3),
(11, 8),
(12, 3),
(12, 8),
(13, 1),
(13, 4),
(14, 1),
(14, 2),
(14, 4),
(15, 1),
(15, 2),
(15, 4),
(16, 2),
(16, 3),
(16, 4),
(17, 2),
(17, 6),
(18, 2),
(18, 3),
(18, 4),
(19, 2),
(19, 4),
(19, 5),
(20, 3),
(20, 5),
(20, 8);

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Studios`
--

CREATE TABLE `Movie_Studios` (
  `movie_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `studio_role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Studios`
--

INSERT INTO `Movie_Studios` (`movie_id`, `studio_id`, `studio_role`) VALUES
(1, 1, 'Production'),
(1, 7, 'Distribution'),
(2, 1, 'Production'),
(2, 7, 'Distribution'),
(3, 1, 'Production'),
(3, 2, 'Distribution'),
(4, 1, 'Production'),
(4, 7, 'Distribution'),
(5, 2, 'Production'),
(5, 3, 'Distribution'),
(6, 3, 'Distribution'),
(6, 4, 'Production'),
(7, 2, 'Distribution'),
(7, 5, 'Production'),
(8, 2, 'Distribution'),
(8, 5, 'Production'),
(9, 3, 'Production'),
(9, 8, 'Co-Production'),
(10, 7, 'Distribution'),
(10, 8, 'Production'),
(11, 1, 'Distribution'),
(11, 7, 'Production'),
(12, 1, 'Distribution'),
(12, 7, 'Production'),
(13, 1, 'Distribution'),
(13, 6, 'Production'),
(14, 1, 'Distribution'),
(14, 6, 'Production'),
(15, 1, 'Distribution'),
(15, 6, 'Production'),
(16, 1, 'Production'),
(16, 2, 'Distribution'),
(17, 2, 'Distribution'),
(17, 5, 'Production'),
(18, 3, 'Distribution'),
(18, 4, 'Production'),
(19, 2, 'Production'),
(19, 4, 'Co-Production'),
(20, 1, 'Distribution'),
(20, 7, 'Production');

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Writers`
--

CREATE TABLE `Movie_Writers` (
  `movie_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `writing_role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Writers`
--

INSERT INTO `Movie_Writers` (`movie_id`, `writer_id`, `writing_role`) VALUES
(1, 1, 'Screenwriter'),
(2, 1, 'Screenwriter'),
(2, 2, 'Co-Writer'),
(3, 3, 'Screenwriter'),
(3, 4, 'Co-Writer'),
(4, 3, 'Screenwriter'),
(5, 5, 'Screenwriter'),
(6, 6, 'Screenwriter'),
(7, 7, 'Screenwriter'),
(8, 7, 'Screenwriter'),
(9, 8, 'Screenwriter'),
(10, 9, 'Screenwriter'),
(11, 10, 'Screenwriter'),
(12, 10, 'Screenwriter'),
(13, 11, 'Screenwriter'),
(14, 12, 'Screenwriter'),
(15, 12, 'Screenwriter'),
(16, 3, 'Screenwriter'),
(16, 4, 'Co-Writer'),
(17, 7, 'Screenwriter'),
(18, 6, 'Screenwriter'),
(19, 11, 'Screenwriter'),
(20, 10, 'Screenwriter');

-- --------------------------------------------------------

--
-- Table structure for table `Production_Studios`
--

CREATE TABLE `Production_Studios` (
  `studio_id` int(11) NOT NULL,
  `studio_name` varchar(100) NOT NULL,
  `country` varchar(80) DEFAULT NULL,
  `founded_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Production_Studios`
--

INSERT INTO `Production_Studios` (`studio_id`, `studio_name`, `country`, `founded_year`) VALUES
(1, 'Warner Bros.', 'USA', 1923),
(2, 'Universal Pictures', 'USA', 1912),
(3, 'Paramount Pictures', 'USA', 1912),
(4, '20th Century Studios', 'USA', 1935),
(5, 'New Line Cinema', 'USA', 1967),
(6, 'Marvel Studios', 'USA', 1993),
(7, 'Columbia Pictures', 'USA', 1924),
(8, 'A24', 'USA', 2012);

-- --------------------------------------------------------

--
-- Table structure for table `Ratings`
--

CREATE TABLE `Ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `review` text DEFAULT NULL,
  `rating_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Ratings`
--

INSERT INTO `Ratings` (`rating_id`, `user_id`, `movie_id`, `rating`, `review`, `rating_date`) VALUES
(1, 1, 1, 9.0, 'Excellent movie', '2025-01-05'),
(2, 2, 1, 8.5, 'Very impressive', '2025-01-07'),
(3, 3, 1, 9.5, 'Amazing experience', '2025-01-10'),
(4, 1, 2, 9.0, 'Excellent science fiction', '2025-01-12'),
(5, 4, 2, 8.5, 'Very emotional', '2025-01-15'),
(6, 5, 2, 9.0, 'Great movie', '2025-01-18'),
(7, 2, 3, 9.5, 'Excellent direction', '2025-01-20'),
(8, 6, 3, 9.0, 'Fantastic movie', '2025-01-22'),
(9, 7, 3, 8.5, 'Really enjoyable', '2025-01-25'),
(10, 3, 4, 8.0, 'Good science fiction', '2025-02-01'),
(11, 8, 4, 8.5, 'Very interesting', '2025-02-03'),
(12, 1, 5, 9.5, 'Classic masterpiece', '2025-02-05'),
(13, 4, 5, 9.0, 'Excellent adventure', '2025-02-08'),
(14, 9, 5, 8.5, 'Great performances', '2025-02-10'),
(15, 2, 6, 9.0, 'Amazing world', '2025-02-12'),
(16, 5, 6, 9.5, 'Beautiful movie', '2025-02-15'),
(17, 3, 7, 9.5, 'Brilliant fantasy', '2025-02-18'),
(18, 6, 7, 9.0, 'Amazing film', '2025-02-20'),
(19, 7, 7, 9.5, 'Excellent', '2025-02-22'),
(20, 1, 8, 9.0, 'Great sequel', '2025-02-25'),
(21, 7, 8, 8.5, 'Interesting story', '2025-02-27'),
(22, 4, 9, 8.5, 'Very entertaining', '2025-03-01'),
(23, 8, 9, 9.0, 'Excellent performance', '2025-03-03'),
(24, 2, 10, 9.5, 'Outstanding film', '2025-03-05'),
(25, 5, 10, 9.0, 'Brilliant story', '2025-03-07'),
(26, 9, 10, 9.5, 'Excellent', '2025-03-09'),
(27, 3, 11, 8.5, 'Excellent crime drama', '2025-03-12'),
(28, 6, 11, 9.0, 'Very powerful', '2025-03-14'),
(29, 1, 12, 9.0, 'Classic film', '2025-03-16'),
(30, 4, 12, 8.5, 'Very entertaining', '2025-03-18'),
(31, 7, 13, 8.5, 'Great superhero movie', '2025-03-20'),
(32, 10, 13, 9.0, 'Loved it', '2025-03-22'),
(33, 2, 14, 9.5, 'Epic conclusion', '2025-03-25'),
(34, 5, 14, 9.0, 'Amazing', '2025-03-27'),
(35, 9, 14, 9.5, 'Excellent superhero film', '2025-03-29'),
(36, 3, 15, 8.5, 'Very entertaining', '2025-03-30'),
(37, 8, 15, 9.0, 'Great superhero team', '2025-04-02'),
(38, 1, 16, 9.5, 'Fantastic sequel', '2025-04-05'),
(39, 6, 16, 9.0, 'Excellent', '2025-04-07'),
(40, 10, 16, 9.5, 'Very impressive', '2025-04-09'),
(41, 4, 17, 9.5, 'Perfect conclusion', '2025-04-11'),
(42, 7, 17, 9.0, 'Fantastic fantasy', '2025-04-13'),
(43, 9, 17, 9.5, 'Masterpiece', '2025-04-15'),
(44, 2, 18, 9.0, 'Beautiful visuals', '2025-04-17'),
(45, 5, 18, 8.5, 'Great sequel', '2025-04-19'),
(46, 3, 19, 8.5, 'Fun adventure', '2025-04-21'),
(47, 10, 19, 8.0, 'Good movie', '2025-04-23'),
(48, 1, 20, 9.0, 'Excellent crime drama', '2025-04-25'),
(49, 4, 20, 8.5, 'Very good', '2025-04-27'),
(50, 6, 20, 9.0, 'Strong performances', '2025-04-29'),
(51, 8, 1, 9.0, 'Great rewatch', '2025-05-01'),
(52, 9, 3, 9.0, 'Very impressive', '2025-05-03'),
(53, 10, 20, 9.5, 'Excellent film', '2025-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `join_date` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `favorite_movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `username`, `email`, `join_date`, `password`, `favorite_movie_id`) VALUES
(1, 'moviefan1', 'moviefan1@example.com', '2024-01-10', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 3),
(2, 'cinema_lover', 'cinema@example.com', '2024-02-15', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 3),
(3, 'filmexpert', 'filmexpert@example.com', '2024-03-20', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 7),
(4, 'hollywoodfan', 'hollywood@example.com', '2024-04-12', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 9),
(5, 'movienight', 'movienight@example.com', '2024-05-18', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 10),
(6, 'filmstudent', 'filmstudent@example.com', '2024-06-25', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 14),
(7, 'cinephile', 'cinephile@example.com', '2024-07-10', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 16),
(8, 'moviecritic', 'moviecritic@example.com', '2024-08-14', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 20),
(9, 'actionfan', 'actionfan@example.com', '2024-09-05', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 6),
(10, 'scififan', 'scififan@example.com', '2024-10-21', '$2y$12$W16aLQmVxwNg.lWeT/M9qOKFaSA1i0dTcZeXuMn2KhfKTKuZsHiui', 18);

-- --------------------------------------------------------

--
-- Table structure for table `Writers`
--

CREATE TABLE `Writers` (
  `writer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nationality` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Writers`
--

INSERT INTO `Writers` (`writer_id`, `name`, `nationality`) VALUES
(1, 'Christopher Nolan', 'British'),
(2, 'Jonathan Nolan', 'British-American'),
(3, 'Denis Villeneuve', 'Canadian'),
(4, 'Jon Spaihts', 'American'),
(5, 'Steven Spielberg', 'American'),
(6, 'James Cameron', 'Canadian'),
(7, 'Peter Jackson', 'New Zealander'),
(8, 'Greta Gerwig', 'American'),
(9, 'Bong Joon-ho', 'South Korean'),
(10, 'Quentin Tarantino', 'American'),
(11, 'Jon Favreau', 'American'),
(12, 'Anthony Russo', 'American');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Actors`
--
ALTER TABLE `Actors`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `Awards`
--
ALTER TABLE `Awards`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `Directors`
--
ALTER TABLE `Directors`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `Franchises`
--
ALTER TABLE `Franchises`
  ADD PRIMARY KEY (`franchise_id`),
  ADD UNIQUE KEY `franchise_name` (`franchise_name`);

--
-- Indexes for table `Genres`
--
ALTER TABLE `Genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `genre_name` (`genre_name`);

--
-- Indexes for table `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `Movie_Actors`
--
ALTER TABLE `Movie_Actors`
  ADD PRIMARY KEY (`movie_id`,`actor_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `Movie_Awards`
--
ALTER TABLE `Movie_Awards`
  ADD PRIMARY KEY (`movie_id`,`award_id`,`award_year`),
  ADD KEY `award_id` (`award_id`);

--
-- Indexes for table `Movie_Directors`
--
ALTER TABLE `Movie_Directors`
  ADD PRIMARY KEY (`movie_id`,`director_id`),
  ADD KEY `director_id` (`director_id`);

--
-- Indexes for table `Movie_Franchises`
--
ALTER TABLE `Movie_Franchises`
  ADD PRIMARY KEY (`movie_id`,`franchise_id`),
  ADD KEY `franchise_id` (`franchise_id`);

--
-- Indexes for table `Movie_Genres`
--
ALTER TABLE `Movie_Genres`
  ADD PRIMARY KEY (`movie_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `Movie_Studios`
--
ALTER TABLE `Movie_Studios`
  ADD PRIMARY KEY (`movie_id`,`studio_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `Movie_Writers`
--
ALTER TABLE `Movie_Writers`
  ADD PRIMARY KEY (`movie_id`,`writer_id`),
  ADD KEY `writer_id` (`writer_id`);

--
-- Indexes for table `Production_Studios`
--
ALTER TABLE `Production_Studios`
  ADD PRIMARY KEY (`studio_id`),
  ADD UNIQUE KEY `studio_name` (`studio_name`);

--
-- Indexes for table `Ratings`
--
ALTER TABLE `Ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`movie_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `favorite_movie_id` (`favorite_movie_id`);

--
-- Indexes for table `Writers`
--
ALTER TABLE `Writers`
  ADD PRIMARY KEY (`writer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Actors`
--
ALTER TABLE `Actors`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Awards`
--
ALTER TABLE `Awards`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Directors`
--
ALTER TABLE `Directors`
  MODIFY `director_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Franchises`
--
ALTER TABLE `Franchises`
  MODIFY `franchise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Genres`
--
ALTER TABLE `Genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Movies`
--
ALTER TABLE `Movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Production_Studios`
--
ALTER TABLE `Production_Studios`
  MODIFY `studio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Ratings`
--
ALTER TABLE `Ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Writers`
--
ALTER TABLE `Writers`
  MODIFY `writer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Movie_Actors`
--
ALTER TABLE `Movie_Actors`
  ADD CONSTRAINT `movie_actors_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_actors_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `Actors` (`actor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Movie_Awards`
--
ALTER TABLE `Movie_Awards`
  ADD CONSTRAINT `movie_awards_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_awards_ibfk_2` FOREIGN KEY (`award_id`) REFERENCES `Awards` (`award_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Movie_Directors`
--
ALTER TABLE `Movie_Directors`
  ADD CONSTRAINT `movie_directors_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_directors_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `Directors` (`director_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Movie_Franchises`
--
ALTER TABLE `Movie_Franchises`
  ADD CONSTRAINT `movie_franchises_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_franchises_ibfk_2` FOREIGN KEY (`franchise_id`) REFERENCES `Franchises` (`franchise_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Movie_Genres`
--
ALTER TABLE `Movie_Genres`
  ADD CONSTRAINT `movie_genres_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `Genres` (`genre_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Movie_Studios`
--
ALTER TABLE `Movie_Studios`
  ADD CONSTRAINT `movie_studios_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_studios_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `Production_Studios` (`studio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Movie_Writers`
--
ALTER TABLE `Movie_Writers`
  ADD CONSTRAINT `movie_writers_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_writers_ibfk_2` FOREIGN KEY (`writer_id`) REFERENCES `Writers` (`writer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ratings`
--
ALTER TABLE `Ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_favorite_movie` FOREIGN KEY (`favorite_movie_id`) REFERENCES `Movies` (`movie_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
