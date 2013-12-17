DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `code` char(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pages_translation`;
CREATE TABLE IF NOT EXISTS `pages_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pages_id` int(11) NOT NULL,
  `language_code` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `translate_id` (`pages_id`),
  KEY `locale_code` (`language_code`),
  CONSTRAINT `translate_id` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `locale_code` FOREIGN KEY (`language_code`) REFERENCES `languages` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `email_code` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(20) NOT NULL,
  `profile` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `users_id` int(10) unsigned NOT NULL,
  `list_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`list_id`,`done`,`created`),
  KEY `fk_user` (`users_id`),
  CONSTRAINT `fk_list` FOREIGN KEY (`list_id`) REFERENCES `list` (`id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `users_id` int(11) unsigned NOT NULL,
  `translated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `news_translation`;
CREATE TABLE IF NOT EXISTS `news_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) unsigned NOT NULL,
  `language_code` char(2) NOT NULL,
  `title` varchar(128) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `translation_id` (`news_id`),
  KEY `language_code` (`language_code`),
  CONSTRAINT `language_code` FOREIGN KEY (`language_code`) REFERENCES `languages` (`code`),
  CONSTRAINT `translation_id` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;