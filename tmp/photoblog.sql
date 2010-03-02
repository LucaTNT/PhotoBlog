-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generato il: 02 Mar, 2010 at 12:35 PM
-- Versione MySQL: 5.1.37
-- Versione PHP: 5.2.10-2ubuntu6.4
-- 
-- Database: `photoblog`
-- 

-- --------------------------------------------------------

-- 
-- Struttura della tabella `photoblog_comments`
-- 

CREATE TABLE `photoblog_comments` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `date` int(15) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_email` varchar(255) NOT NULL,
  `author_www` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `post_id` int(15) NOT NULL DEFAULT '-1',
  `image_id` int(15) NOT NULL DEFAULT '-1',
  `approved` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dump dei dati per la tabella `photoblog_comments`
-- 


-- --------------------------------------------------------

-- 
-- Struttura della tabella `photoblog_config`
-- 

CREATE TABLE `photoblog_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dump dei dati per la tabella `photoblog_config`
-- 

INSERT INTO `photoblog_config` VALUES ('language', 'italian', 'PhotoBlog default language');
INSERT INTO `photoblog_config` VALUES ('template', 'default', 'Default template');
INSERT INTO `photoblog_config` VALUES ('charset', 'UTF-8', 'The charset used by pages. Should be left to UTF-8');
INSERT INTO `photoblog_config` VALUES ('posts_per_page', '10', 'Number of posts per page in index');
INSERT INTO `photoblog_config` VALUES ('site_name', 'PhotoBlog', 'Site name, shown for example in header');
INSERT INTO `photoblog_config` VALUES ('site_description', 'The best photoblogging platform', 'Site description, shown in header');
INSERT INTO `photoblog_config` VALUES ('show_generation_time', '1', '1 shows page generation time, 0 doesn''t');
INSERT INTO `photoblog_config` VALUES ('permalink_scheme', '%date_year/%date_month/%date_day/%post_title', 'The scheme defining the permalink. See documentation for further explaination');
INSERT INTO `photoblog_config` VALUES ('date_format', '%d/%m/%Y', 'Date format (using PHP''s date() function syntax)');
INSERT INTO `photoblog_config` VALUES ('time_format', '%H:%m', 'Time format (using PHP''s date() function syntax)');
INSERT INTO `photoblog_config` VALUES ('small_thumb_rows_in_index', '2', 'Number of rows of little thumbs under the big one in posts');
INSERT INTO `photoblog_config` VALUES ('small_thumb_per_row_in_index', '3', 'Number of small thumbs in each row in posts');
INSERT INTO `photoblog_config` VALUES ('small_thumb_size', '125', 'The lenght (in pixels) of the long side of small thumbnails (i.e. gallery covers)');
INSERT INTO `photoblog_config` VALUES ('resample_thumbnails', '1', 'If set to 1 uses the resample function to resize thumbnails (much better quality but slower)');
INSERT INTO `photoblog_config` VALUES ('thumbnail_quality', '95', 'The quality of thumbnails, from 0 to 100, default 95 (Affects ONLY jpeg thumbnails)');
INSERT INTO `photoblog_config` VALUES ('big_thumb_size', '400', 'The lenght (in pixels) of the long side of big thumbnails (i.e. gallery covers)');
INSERT INTO `photoblog_config` VALUES ('lightbox', '1', 'Enable "lightbox" effect to show images');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `photoblog_galleries`
-- 

CREATE TABLE `photoblog_galleries` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1023) NOT NULL,
  `date` int(15) NOT NULL,
  `password` varchar(47) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dump dei dati per la tabella `photoblog_galleries`
-- 

INSERT INTO `photoblog_galleries` VALUES (1, 'First gallery', 'La prima galleria', 1233413788, '');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `photoblog_images`
-- 

CREATE TABLE `photoblog_images` (
  `id` int(63) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(63) NOT NULL,
  `gallery_cover` int(1) NOT NULL DEFAULT '0',
  `caption` varchar(1023) NOT NULL,
  `date` int(15) NOT NULL,
  `place` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `path` varchar(511) NOT NULL,
  `filetype` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dump dei dati per la tabella `photoblog_images`
-- 

INSERT INTO `photoblog_images` VALUES (1, 1, 1, 'A lake', 1235147244, 'The lake', 'lake', 'includes/writable/galleries/2009/02/20/1/picture_1.jpg', 'jpg');
INSERT INTO `photoblog_images` VALUES (2, 1, 0, 'A nice drop', 1235147244, 'A glass of water', 'drop|glass', 'includes/writable/galleries/2009/02/20/1/picture_2.jpg', 'jpg');
INSERT INTO `photoblog_images` VALUES (3, 1, 0, 'Some Fishes', 1243791244, 'The Sea', 'fish|sea|water', 'includes/writable/galleries/2009/02/20/1/picture_3.jpg', 'jpg');
INSERT INTO `photoblog_images` VALUES (4, 1, 0, 'A Cyber Drop', 1243791244, 'A fantasy lake', 'lake|fantasy|drop|water', 'includes/writable/galleries/2009/02/20/1/picture_4.jpg', 'jpg');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `photoblog_plugin`
-- 

CREATE TABLE `photoblog_plugin` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL,
  `description` varchar(255) NOT NULL,
  `filename` varchar(63) NOT NULL,
  `enabled` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dump dei dati per la tabella `photoblog_plugin`
-- 

INSERT INTO `photoblog_plugin` VALUES (1, 'Test of dummy hook', 'This plugins prints "Yes, I am useless" at the "dummy" hook', 'dummy.php', 0);

-- --------------------------------------------------------

-- 
-- Struttura della tabella `photoblog_posts`
-- 

CREATE TABLE `photoblog_posts` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` mediumtext NOT NULL,
  `html` text NOT NULL,
  `date` int(15) NOT NULL,
  `password` varchar(47) NOT NULL,
  `tags` text NOT NULL,
  `allow_comments` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dump dei dati per la tabella `photoblog_posts`
-- 

INSERT INTO `photoblog_posts` VALUES (1, 'P&ograve;st di prova #1', 'Hic provae postus est.\r\n[GALLERY=1]\r\nS''&eacute; capito, insomma.\r\n[GALLERY=123]\r\nCordiali saluti, messere', '', 1228679023, '', 'test|prova|inutile|latino', 1);
INSERT INTO `photoblog_posts` VALUES (2, 'Post di riprova #2', 'Hic secundus provae postus est.\r\n\r\nS''&eacute; capito, insomma. 2\r\n\r\nCordiali saluti, messere 2', '56hihnoyno', 1231003652, '', 'test|prova|inutile|latino|2', 1);
