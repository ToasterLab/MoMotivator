SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mo_motivator`
--
CREATE DATABASE IF NOT EXISTS `mo_motivator` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mo_motivator`;

-- --------------------------------------------------------

--
-- Table structure for table `mo_lists`
--

CREATE TABLE IF NOT EXISTS `mo_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `mo_lists`
--

INSERT INTO `mo_lists` (`id`, `user_id`, `name`) VALUES
(42, 1, 'School Work'),
(43, 1, 'Fun Stuff'),
(44, 39, 'Office'),
(49, 39, 'Entertainment'),
(52, 56, 'List 1'),
(57, 58, 'MyList'),
(58, 39, 'Shopping'),
(60, 59, 'Completed'),
(63, 39, 'Birthday Party'),
(64, 39, 'Mockups'),
(65, 60, 'General');

-- --------------------------------------------------------

--
-- Table structure for table `mo_tasks`
--

CREATE TABLE IF NOT EXISTS `mo_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `duedate` date NOT NULL DEFAULT '0000-00-00',
  `former_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `mo_tasks`
--

INSERT INTO `mo_tasks` (`id`, `list_id`, `name`, `duedate`, `former_id`) VALUES
(50, 31, 'English Essay', '2014-01-31', 0),
(52, 35, 'Milk', '2014-01-25', 32),
(53, 32, 'Flowers', '2014-01-30', 0),
(54, 32, 'Loaf of Bread', '2014-02-05', 0),
(55, 35, 'Stationary for School', '2014-03-07', 32),
(56, 36, 'Pay Credit Card Bills', '2014-04-05', 0),
(57, 36, 'Work Out at Gym', '2014-02-04', 0),
(58, 36, 'Dye my Hair', '2014-02-12', 0),
(59, 36, 'Get some formal shoes for Grad Night', '2014-02-27', 0),
(60, 31, 'Handicrafts Project Submission', '2014-02-06', 0),
(61, 35, 'Prosumer Market Research', '2014-01-25', 31),
(63, 22, 'Make Videos', '0000-00-00', 0),
(64, 38, 'Visit Antartica', '0000-00-00', 39),
(65, 41, 'Pay credit card bills.', '2014-02-05', 40),
(66, 41, 'Pack Up for San Francisco Trip', '2014-02-12', 40),
(67, 41, 'Do Gardening', '2014-03-05', 40),
(68, 41, 'Prepare for Kid''s Birthday Party', '2014-02-06', 40),
(70, 39, 'Obtain Babel Fish', '0000-00-00', 38),
(71, 39, 'Purchase a Big Towel', '0000-00-00', 38),
(72, 39, 'Peruse Vogon Poetry', '0000-00-00', 38),
(73, 39, 'Hitchhike to the nearest neighbouring galaxy', '2014-01-28', 38),
(74, 39, 'Get a Towel', '0000-00-00', 38),
(75, 38, 'Don''t Panic', '0000-00-00', 0),
(76, 38, 'Keep Calm and Enjoy Life.', '0000-00-00', 0),
(80, 43, 'Borrow Gandalf''s Palantir', '0000-00-00', 0),
(81, 43, 'Simply Walk into Mordor', '2014-01-29', 0),
(82, 43, 'Try on the One Ring', '2014-01-31', 0),
(83, 43, 'Walk in Fangorn Forest', '2014-02-03', 0),
(84, 42, 'Connect 2 Tesla Coils', '2014-02-05', 0),
(85, 42, 'Dissect a Cheesecake', '2014-01-28', 0),
(86, 42, 'Mix 2 colourful solutions', '2014-01-27', 0),
(133, 41, 'Do mockups', '0000-00-00', 40),
(135, -1, 'Do work ', '0000-00-00', 0),
(136, 0, 'steal a faulty TARDIS', '0000-00-00', 0),
(137, 0, 'repair sonic screwdriver', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mo_users`
--

CREATE TABLE IF NOT EXISTS `mo_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `mo_users`
--

INSERT INTO `mo_users` (`id`, `name`, `email`, `pass`, `level`, `experience`) VALUES
(49, 'Marvin', 'paranoid@android.com', 'android', 2, 0),
(50, 'Hari Seldon', 'hari@seldon.com', 'psychohistory', 1, 50),
(56, 'George Soros', 'george@george', 'soros', 1, 1200);

-- --------------------------------------------------------
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
