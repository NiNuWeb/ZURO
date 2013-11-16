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

INSERT INTO `news` (`id`, `title`, `body`, `date`, `users_id`) VALUES
(1, 'My First News is', 'Gingerbread marshmallow sesame snaps sweet cupcake cheesecake cupcake carrot cake. Cookie apple pie tart cookie lemon drops cheesecake bonbon tootsie roll. Carrot cake brownie chocolate marzipan. Sesame snaps chocolate cake toffee fruitcake jujubes unerdwear.com candy canes bear claw. Sweet topping bonbon donut. Chocolate cake chocolate bar apple pie icing biscuit gummi bears pie halvah biscuit. Chocolate bar chocolate bar jelly gummies powder muffin wafer applicake pie. Gummi bears cookie fruitcake tootsie roll. Lollipop marshmallow sweet roll cotton candy muffin carrot cake soufflé chupa chups sesame snaps. Unerdwear.com powder chocolate chocolate cake applicake. Liquorice jujubes marzipan dessert macaroon gummi bears carrot cake candy canes. Lemon drops danish oat cake lollipop apple pie gummi bears tiramisu dessert.', '2013-11-14 20:34:10', 1),
(2, 'My Second News is', 'Carrot cake unerdwear.com wafer. Soufflé wafer candy canes sweet candy cheesecake macaroon cookie. Toffee chupa chups apple pie. Marshmallow marzipan pie jelly-o donut chocolate bar. Biscuit gingerbread unerdwear.com. Soufflé tart dragée pastry. Apple pie dragée cupcake cupcake. Danish unerdwear.com soufflé tart liquorice oat cake chocolate bar. Gummies chocolate gingerbread muffin. Pastry croissant gummies dessert. Jujubes dragée sweet roll. Caramels marzipan brownie toffee macaroon donut gummi bears sugar plum. Pie bonbon topping bear claw sugar plum.\nAnd What About Now.', '2013-11-14 21:59:31', 1),
(3, 'My Third News is', 'Chocolate bar chocolate croissant pudding jujubes candy biscuit gummies. Candy canes toffee jujubes fruitcake toffee lollipop icing. Topping pie jelly. Carrot cake bonbon pastry marzipan bear claw. Jujubes danish jelly-o tootsie roll chocolate toffee ice cream tootsie roll. Pie chocolate bar croissant gummies cookie. Toffee cake pie gummi bears sweet sesame snaps jujubes. Bonbon toffee chocolate bar lemon drops bonbon applicake pastry macaroon. Lemon drops pastry muffin cheesecake chocolate cake brownie chocolate bar sugar plum pudding. Wafer biscuit candy canes caramels topping halvah pudding bonbon chupa chups. Cotton candy liquorice icing ice cream candy canes pastry. Chocolate bar bonbon liquorice jelly-o.', '2013-11-14 22:00:28', 2),
(4, 'My Fourth News is', 'Cotton candy fruitcake icing apple pie jelly-o donut dessert. Bonbon croissant wafer biscuit. Fruitcake cake pastry brownie dessert icing candy. Macaroon brownie sesame snaps biscuit marzipan donut jelly cake powder. Biscuit cotton candy bear claw liquorice jelly beans. Chocolate bar croissant biscuit croissant apple pie jelly apple pie. Unerdwear.com sesame snaps apple pie cheesecake bear claw. Bear claw icing cheesecake cheesecake danish jelly beans sesame snaps. Wafer sweet roll tiramisu fruitcake cookie sweet. Macaroon toffee chocolate bar dragée macaroon macaroon lollipop jelly-o. Chupa chups fruitcake muffin caramels cupcake halvah topping sweet roll halvah. Tootsie roll carrot cake pie jelly-o jelly-o pastry.', '2013-11-14 22:10:01', 2);