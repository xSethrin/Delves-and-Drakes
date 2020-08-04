-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 10:48 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delves_and_drakes`
--

-- --------------------------------------------------------

--
-- Table structure for table `adventurers`
--

CREATE TABLE `adventurers` (
  `user_id` int(100) NOT NULL,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `module_id` int(100) DEFAULT NULL,
  `state_id` int(100) DEFAULT NULL,
  `character_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='This table is for the users to login ';

--
-- Dumping data for table `adventurers`
--

INSERT INTO `adventurers` (`user_id`, `username`, `password`, `module_id`, `state_id`, `character_id`) VALUES
(3, 'Sethrin', '$2y$10$CITlgoeukGmAsKd0f3RgS.9faXpDtGptnvJSG8IC/q5a84jFkO7ou', 1, 31, 1),
(4, 'karin', '$2y$10$XNXnYYpAR.jPtfdy6clpB.Ao3Hjp5t..Yogru8AQGyhbKFeqoksBy', 1, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `character_id` int(100) NOT NULL,
  `character_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `character_race` varchar(255) COLLATE utf8_bin NOT NULL,
  `character_class` varchar(255) COLLATE utf8_bin NOT NULL,
  `strength` int(100) NOT NULL,
  `dexterity` int(100) NOT NULL,
  `constitution` int(100) NOT NULL,
  `intelligence` int(100) NOT NULL,
  `wisdom` int(100) NOT NULL,
  `charisma` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`character_id`, `character_name`, `character_race`, `character_class`, `strength`, `dexterity`, `constitution`, `intelligence`, `wisdom`, `charisma`) VALUES
(1, 'Astara', 'Elven', 'Mage', 9, 14, 10, 18, 15, 15),
(2, 'Durgro', 'Orc', 'Warrior', 20, 15, 18, 8, 8, 13),
(3, 'Reven', 'Human', 'Thief ', 13, 18, 12, 10, 10, 18),
(4, 'Gregor', 'Dwarven', 'Paladin', 17, 8, 14, 10, 15, 18),
(5, 'Telissa', 'Gnome', 'Cleric', 10, 9, 14, 15, 18, 15),
(6, 'Kailen', 'Half-Elven', 'Druid', 13, 15, 12, 16, 17, 12),
(7, 'Klemek', 'Undead', 'Archer', 12, 17, 14, 10, 11, 8);

-- --------------------------------------------------------

--
-- Table structure for table `checks`
--

CREATE TABLE `checks` (
  `check_id` int(100) NOT NULL,
  `stat` varchar(255) COLLATE utf8_bin NOT NULL,
  `threshold` int(100) NOT NULL,
  `pass` int(100) NOT NULL,
  `fail` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checks`
--

INSERT INTO `checks` (`check_id`, `stat`, `threshold`, `pass`, `fail`) VALUES
(1, 'dexterity ', 15, 18, 17),
(2, 'intelligence', 15, 20, 19),
(3, 'strength', 15, 26, 27);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(100) NOT NULL,
  `module_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`) VALUES
(1, 'Meladron\'s Keep');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(100) NOT NULL,
  `option_text` text COLLATE utf8_bin,
  `chance` int(2) DEFAULT NULL,
  `check_id` int(100) DEFAULT NULL,
  `state_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_text`, `chance`, `check_id`, `state_id`) VALUES
(1, 'Enter tavern ', 0, 0, 2),
(2, 'Seek village elder', 0, 0, 3),
(3, 'Attack Citizens', NULL, NULL, 4),
(4, 'Talk to the orc', NULL, NULL, 5),
(5, 'Talk to the gnome', NULL, NULL, 6),
(6, 'Talk to the elf', NULL, NULL, 7),
(7, 'Attacking him', NULL, NULL, 8),
(8, 'Asking him for work', NULL, NULL, 9),
(9, 'Order a drink', NULL, NULL, 10),
(10, 'Ask about rumors', NULL, NULL, 10),
(11, 'Flirt with the orc', NULL, NULL, 11),
(12, 'Ask for work', NULL, NULL, 12),
(13, 'Flirt with the elf', NULL, NULL, 13),
(14, 'Ask for work', NULL, NULL, 14),
(15, 'Continue', NULL, NULL, 15),
(16, 'Enter the front door', NULL, NULL, 16),
(17, 'Climb the wall', 1, 1, NULL),
(18, 'Search for another entrance', 1, 2, NULL),
(19, 'Enter 1st door', NULL, NULL, 21),
(20, 'Climb stairs', NULL, NULL, 22),
(21, 'Enter 2nd door', NULL, NULL, 23),
(22, 'Continue', NULL, NULL, 22),
(25, 'Continue', NULL, NULL, 16),
(26, 'Continue', NULL, NULL, 23),
(27, 'Call out to her', NULL, NULL, 24),
(28, 'Attack her', NULL, NULL, 25),
(29, 'Continue', NULL, NULL, 28),
(30, 'Attack', 1, 3, NULL),
(31, 'Run', NULL, NULL, 27),
(32, 'Continue', NULL, NULL, 28),
(33, 'Attack', NULL, NULL, 29),
(34, 'Dodge', NULL, NULL, 30),
(35, 'Continue', NULL, NULL, 31);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `module_id` int(11) DEFAULT NULL,
  `state_id` int(100) NOT NULL,
  `state_text` text COLLATE utf8_bin,
  `option_1` int(100) DEFAULT NULL,
  `option_2` int(100) DEFAULT NULL,
  `option_3` int(100) DEFAULT NULL,
  `option_4` int(100) DEFAULT NULL,
  `state_image` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`module_id`, `state_id`, `state_text`, `option_1`, `option_2`, `option_3`, `option_4`, `state_image`) VALUES
(1, 1, 'Finally, after a long day of walking on the roads, you have reached your destination, Oakdale village. The village is not very large and after making it to the center you can see most of it. You decide to...  ', 1, 2, 3, NULL, 'images/village.png'),
(1, 2, 'You enter the tavern and look around.  Many people are sitting around, laughing and drinking.  As you continue to look around you see a big muscular Orc wearing in leather serving drinks behind the bar.  In the corner you see a shifty eyed gnome wearing black robes drinking alone. You also notice an elven maiden with long blonde hair looking right at you.  Naturally you decide to...', 4, 5, 6, NULL, 'images/village.png'),
(1, 3, 'After asking around, you are pointed to the elder\'s home. When you arrive at his dwelling you knock on the door.  After a few moment the elder opens the door to greet you. He is an old human, with long gray hair, and a long beard.  \"Yes young one?  How may I help you?\" You respond to him by...', 7, 8, NULL, NULL, 'images/village.png'),
(1, 4, 'You begin attacking and killing villagers. The ones that see begin screaming for help and running away.  Soon guards show up and start to fight back. You are able to kill a few of them but more keep coming.  Eventually you feel a sharp pain in your back.  You look down and see a sword protruding from your chest.  Slowly, your mind fades and everything goes black.  You are dead.', NULL, NULL, NULL, NULL, 'images/village.png'),
(1, 5, 'As you approach the large orc he smiles and says to you \"Hello good looking! What can Daddy Regnor get you?\" In response you...', 9, 10, 11, NULL, 'images/village.png'),
(1, 6, 'You walk up to the gnome. He glances over at you for a moment then continues to drink. After a moment of ignoring you he turns to you and yells, \"What do you want!\"', 12, NULL, NULL, NULL, 'images/village.png'),
(1, 7, 'As you walk up to the elven woman she looks at you in the eyes with a smile on her face. \"Why hello there\" she says in a sultry voice. \"My name is Nysandra.\" You respond to the beautiful elf by...', 13, 14, NULL, NULL, 'images/village.png'),
(1, 8, 'You attempt to attack the elder.  Before you can hit him however, a bright light flashes and blinds you. \"You take me for an old feeble man do you?\" the elder questions.  Before you vision returns you feel an intense heat.  The elder is casting fire magic on you.  Your body catches fire and you die.', NULL, NULL, NULL, NULL, 'images/village.png'),
(1, 9, 'The old man smiles at you. \"Ah, you are an adventurer.  The world could use more of you.\"  He continues to tell you about strange occurrences in the village.  It seems people have been disappearing at night.  The elder has no idea where the people are going.  He suggests you start your search by looking for the old keep out in the woods.', 15, NULL, NULL, NULL, 'images/village.png'),
(1, 10, 'Regnor pours you a drink. He begins to tell you about how recently villagers have been disappearing at night, and no one knows where they have gone.  After you finish your drink you ask him where he thinks the missing villagers could be.  He tells you of an old keep in the forest nearby.  You decide to look for this keep.', 15, NULL, NULL, NULL, 'images/village.png'),
(1, 11, 'You begin to flirt back to Regnor.  He smiles at you and pours you a drink. \"Here, this one is on Daddy.\" He begins to tell you about how recently villagers have been disappearing at night, and no one knows where they have gone.  After you finish your drink you ask him where he thinks the missing villagers could be.  He tells you of an old keep in the forest nearby.  You decide to look for this keep. ', 15, NULL, NULL, NULL, 'images/village.png'),
(1, 12, 'The gnome yells at you, \"What?! What do you think I am?  Some sort of employer?  Go pester someone else!\"  Before you get to walk away he stops you and asks you where you are from.  After finding out you are not from the village he grins.  He introduces himself as Valdrin. He goes on and tells you about how villagers have gone missing.  He requests you to look for them in an old keep in the woods, and promises he will pay you for your work.', 15, NULL, NULL, NULL, 'images/village.png'),
(1, 13, 'You flirt with the elf. She smiles and buys you a drink.  After having a few drinks too many, you decide to leave the tavern with Nysandra. After walking the streets and laughing with the elf she throws her arms around you and begins kissing your neck.  Suddenly, you feel a sharp pain in your neck, and you realize Nysandra is a vampire. Your vision starts to fade, and you die.', NULL, NULL, NULL, NULL, 'images/village.png'),
(1, 14, 'Nysandra laughs, \"Why not have a drink with me first?\" She smiles and buys you a drink.  After having a few drinks too many, you decide to leave the tavern with Nysandra. After walking the streets and laughing with the elf she throws her arms around you and begins kissing your neck.  Suddenly, you feel a sharp pain in your neck, and you realize Nysandra is a vampire. Your vision starts to fade, and you die.', NULL, NULL, NULL, NULL, 'images/village.png'),
(1, 15, 'After searching the woods for a few hours, you finally find the old keep.  You were told the keep was abandoned but to your surprise you see candlelight coming from some of the windows.  You decide to...', 16, 17, 18, NULL, 'images/outside.png'),
(1, 16, 'You enter the front door. However, to your surprise you see no one in the entrance. You see two doors and a flight of stairs. You decided to...', 19, 20, 21, NULL, 'images/inside.png'),
(1, 17, 'You start climbing the wall. However, half way up you loose your grip and fall.  You are dead. (Dexterity Check Fail)', NULL, NULL, NULL, NULL, 'images/outside.png'),
(1, 18, 'You start climbing the wall. Eventually you come to a window and enter it.', 22, NULL, NULL, NULL, 'images/outside.png'),
(1, 19, 'You are unable to find any entrance, so you decide your best bet is to enter the front door (Int fail)', 25, NULL, NULL, NULL, 'images/outside.png'),
(1, 20, 'You find a small stone with a rune on it. Being smart you know to invoke magic on it.  The rune starts to glow and part of the wall vanishes revealing a secret entrance.', 26, NULL, NULL, NULL, 'images/outside.png'),
(1, 21, 'You open the door to a dark room.  After entering the room, you hear a faint sound.  Suddenly the floor under your feet opens and you fall to your death.', NULL, NULL, NULL, NULL, 'images/inside.png'),
(1, 22, 'After your climb, when you enter the room you see a woman sitting next to a fire.  She is turned away from you. The mysterious woman does not seem to notice you so you...', 27, 28, NULL, NULL, 'images/inside.png'),
(1, 23, 'You enter a room filled with cells. However, instead of prisoners all you see are corpses. Looks, like you found out where all the villagers went. Upon closer inspection you notice each body has wounds on their necks. Vampires. You see a door leading up some stairs and decide to enter it.', 29, NULL, NULL, NULL, 'images/inside.png'),
(1, 24, 'You call out to the women. She jumps out of her chair obviously startled. Instantly she lunches at you baring fangs. She is a vampire. You...', 30, 31, NULL, NULL, 'images/inside.png'),
(1, 25, 'Without waiting to find out who the women is, you attack her. She falls out of her chair and into the fire. Almost instantly she burst into ashes. She was a vampire. You feel relieved that you didn\'t take a moment to talk to her. Looking around you see a door and decide to go through it.', 32, NULL, NULL, NULL, 'images/inside.png'),
(1, 26, 'Luckily you are strong. You are able to strike a blow with your weapon and the vampire falls to the ground, you attack her once more, just to be safe, and she burst into ash. Looking around you see a door and decide to go through it.', 32, NULL, NULL, NULL, 'images/inside.png'),
(1, 27, 'You are too weak. The vampire grabs you and bits your neck. You can feel the life being drained from you and you die. ', NULL, NULL, NULL, NULL, 'images/inside.png'),
(1, 28, 'As you enter the room you see a slender pale elf standing over a table with a dead woman laying on it, his most recent victim.  Slowly, he turns around and looks at you with a smile. \"Did that little gnome, Valdrin send me a snack? Or was it my faithful daughter Nysandra. She is always finding stupid adventures at the tavern... No... Not her. She would have killed you herself. It matters not, regardless now you die!\" As he lunges at you, you decide to...', 33, 34, NULL, NULL, 'images/inside.png'),
(1, 29, 'You land a hit on him.  But it is not enough. He turns to you ready to attack. Luckily, you are too quick and get in another hit and the old vampire falls to the ground.', 35, NULL, NULL, NULL, 'images/inside.png'),
(1, 30, 'You dodge his attack, quickly you strike back while his guard is down, and he falls to the ground.', 35, NULL, NULL, NULL, 'images/inside.png'),
(1, 31, 'As the vampire lays on the ground he begins to plea for his life. You care not and strike a final blow and he bursts to ash. Knowing you killed the vampire you leave the keep to find Valdrin and Nysandra in hopes of bringing justice to the village of Oakdale.\r\n\r\nTHE END', NULL, NULL, NULL, NULL, 'images/inside.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adventurers`
--
ALTER TABLE `adventurers`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `module_id` (`module_id`,`state_id`,`character_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `character_id` (`character_id`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`character_id`);

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `check_id` (`check_id`,`state_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `option_1` (`option_1`,`option_2`,`option_3`,`option_4`),
  ADD KEY `option_3` (`option_3`),
  ADD KEY `states_ibfk_3` (`option_2`),
  ADD KEY `states_ibfk_5` (`option_4`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adventurers`
--
ALTER TABLE `adventurers`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
