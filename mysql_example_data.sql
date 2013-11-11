SET NAMES utf8;

INSERT INTO `list` (`id`, `title`) VALUES
(1, 'Work'),
(2, 'Home'),
(3, 'Fan Site');

INSERT INTO `pages` (`id`, `title`, `text`, `slug`, `position`) VALUES
(1, 'Home', 'This is Home page', 'home', 1),
(2, 'About', 'This is page About ??? ...', 'about', 2),
(3, 'Products', 'This is the product page of this concern.\nList of items goes here.\nWhoooah', 'products', 3);

-- username = password f.e. password for adminer is adminer etc. --
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `email_code`, `active`, `role`, `profile`) VALUES
(1, 'adminer', '$2a$07$hd5m61puutm6px1aimg61OXlSmvIF.EuX2tZYDrqcKJ0BNsrKzf6C', 'Franz', 'Jozef II', 'franz@jozef.sk', NULL, 1, 'admin', 'Administrator'),
(2, 'editor', '$2a$07$du1f8fyrgb8exdrmxyjcpuMWPwUCHBGhvV2QRHRVV9.f0ka0ns4xW', NULL, NULL, 'editor@editor.sk', NULL, 1, 'editor', NULL);

INSERT INTO `task` (`id`, `text`, `created`, `done`, `users_id`, `list_id`) VALUES
(1, 'Get Milk', '2013-11-06 12:30:00', 0, 1, 1),
(2, 'Go to post office', '2013-11-06 12:35:50', 0, 2, 2),
(3, 'Buy Sodastream', '2013-11-06 15:00:42', 0, 1, 3),
(4, 'Do Homework', '2013-11-06 15:02:05', 1, 2, 1);