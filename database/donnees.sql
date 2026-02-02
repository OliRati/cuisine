-- Adminer 5.4.1 MySQL 8.0.44 dump

USE cuisine;

INSERT INTO `cuisiniers` (`id_cuisinier`, `nom`, `specialite`, `email`, `password`, `avatar`) VALUES
(1,	'Paul',	'desserts',	'paul@example.com',	'$2y$10$g7WHJa2q1DbvgfcWokNZt./XE3zaOM9c3W5WpgOcU0VBvjsTA7TCi',	'./assets/avatars/1-avatar_admin.png'),
(3,	'Martin',	'entrées',	'martin@example.com',	'$2y$10$EbgTyd22T5aj.xywc340ref4Yp5gk6oXERmOE8Jhz8Uo1jMJ4WYPK',	''),
(6,	'jules',	'Desserts',	'jules@example.com',	'$2y$10$IBKkfHpsvhZR/URk/GzUNOQQ/6w89Z5OBEcHO96e0P1xaQUrA7fFW',	'');

INSERT INTO `plats` (`id_plat`, `nom`, `type`, `description`, `id_cuisinier`, `id_categorie`) VALUES
(3,	'Lasagnes',	'plat principal',	'Couches fines de pâtes avec une farce a base de viandes.',	1,	1),
(4,	'Pomme salardaises',	'Plat principal',	'Un assemblage de pommes de terre rôties avec des lardons fumés.',	1,	1),
(5,	'Frites',	'Legumes',	'Faire frire des pommes de terre dans de l&#039;huile.',	1,	1),
(7,	'Daube de boeuf',	'Plat d&#039;hivers',	'Un plat en sauce parfait pour les longues soirées d&quot;hiver',	1,	1),
(9,	'Saucisse aux lentilles',	'Plat principal',	'Un plat simple et efficace. Rapide à préparer',	3,	1);

-- 2026-02-02 15:32:53 UTC
