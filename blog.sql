-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `blog`;
CREATE DATABASE `blog` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blog`;

DROP TABLE IF EXISTS `autori`;
CREATE TABLE `autori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `autori`;
INSERT INTO `autori` (`id`, `jmeno`) VALUES
(1,	'Kryštof Špulák'),
(2,	'Admin Adminovič'),
(3,	'Lupin Zavoněl');

DROP TABLE IF EXISTS `clanky`;
CREATE TABLE `clanky` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nadpis` varchar(255) NOT NULL,
  `obsah` text NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_autora` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`id_autora`),
  CONSTRAINT `clanky_ibfk_1` FOREIGN KEY (`id_autora`) REFERENCES `autori` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `clanky`;
INSERT INTO `clanky` (`id`, `nadpis`, `obsah`, `datum`, `id_autora`) VALUES
(1,	'Blog',	'Blog je webová aplikace obsahující příspěvky většinou jednoho editora na jedné webové stránce. Nejčastěji, nikoli však nezbytně, bývají zobrazovány v obráceném chronologickém pořadí, (tj. nejnovější nahoře). Autor se nazývá blogger (někteří Češi píší pouze jedno g), veškeré blogy a jejich vzájemné vztahy blogosféra.\r\n<br><br>\r\nSlovo „blog“ vzniklo stažením anglického „web log“, což v češtině zhruba znamená „webový zápisník“, a zkrácením slova „weblog“.\r\n<br><br>\r\nWeblogy tvoří nesmírně široké a diferencované textové a žánrové pole, takže pokusy o stručnou vyčerpávající definici formálními kritérii bývají neúspěšné: spektrum sahá od osobních „deníčků“ po oficiální zpravodajství firem, sdělovacích prostředků a politických kampaní, často je žánrové určení blogů publicistické (causerie, anotace, fejetony, vzpomínky, recenze, glosy, cestopisy a různě kombinované žánrové hybridy); do weblogu může přispívat stejně tak jediný autor, malá skupina přátel nebo široká komunita. Mnoho weblogů umožňuje přidávat komentáře k jednotlivým příspěvkům, takže kolem nich vzniká čtenářská komunita; jiné jsou neinteraktivní.',	'2018-04-06 10:39:06',	2),
(2,	'Článek',	'Článek je literární žánr, který v závislosti na svém obsahu může spadat do literárního stylu odborného či publicistického.\r\n<br><br>\r\nOdborný článek patří ve své oblasti k jednomu z kratších stylů. Snaží se stručně a uceleně podat vědecké poznatky, a to s ohledem na možnosti adresáta.\r\n<br><br>\r\nPublicistický článek obsahuje jasné, věcné, logické a srozumitelné vyjádření myšlenky nebo popis události. Je výsledkem subjektivního přístupu autora k dané problematice i k výrazovým a jazykovým prostředkům. Hledá souvislosti, příčiny, následky a analyzuje, třídí a zobecňuje.\r\n<br><br>\r\nObsahem článku jsou:\r\n<br>\r\n - základní myšlenka (teze)\r\n<br>\r\n - argumentace\r\n<br>\r\n - závěry\r\n<br><br>\r\nV laickém pojetí může slovo článek znamenat téměř jakýkoli útvar v novinách kromě zprávy.',	'2018-04-08 23:23:53',	1),
(3,	'Ahoj',	'Velmi pěkný článek',	'2018-04-11 22:02:14',	3);

DROP TABLE IF EXISTS `komentare`;
CREATE TABLE `komentare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clanku` int(11) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `obsah` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_clanku` (`id_clanku`),
  CONSTRAINT `komentare_ibfk_1` FOREIGN KEY (`id_clanku`) REFERENCES `clanky` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `komentare`;
INSERT INTO `komentare` (`id`, `id_clanku`, `autor`, `obsah`) VALUES
(1,	1,	'Karel',	'super článek!'),
(2,	1,	'Pavel',	'nic moc'),
(3,	2,	'Franta',	'meh'),
(7,	1,	'Tomáš',	'yaaay');

-- 2018-04-11 20:18:22
