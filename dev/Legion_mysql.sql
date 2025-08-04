CREATE TABLE `characters` (
  `id_character` integer PRIMARY KEY,
  `real_name` varchar(100) NOT NULL,
  `year_first_appearance` integer NOT NULL,
  `link_wikipedia` varchar(200)
);

CREATE TABLE `charactersnames` (
  `id_character` integer NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` integer NOT NULL
);

CREATE TABLE `characterspics` (
  `id_character` integer NOT NULL,
  `year` integer NOT NULL,
  `pic` varchar(100)
);

CREATE TABLE `memberships` (
  `id_character` integer NOT NULL,
  `year_initial` integer NOT NULL,
  `year_final` integer,
  `id_endingreason` integer
);

CREATE TABLE `membershipsendingreasons` (
  `id_endingreason` integer NOT NULL,
  `description` varchar(100) NOT NULL
);

ALTER TABLE `charactersnames` ADD FOREIGN KEY (`id_character`) REFERENCES `characters` (`id_character`);

ALTER TABLE `characterspics` ADD FOREIGN KEY (`id_character`) REFERENCES `characters` (`id_character`);

ALTER TABLE `memberships` ADD FOREIGN KEY (`id_character`) REFERENCES `characters` (`id_character`);

ALTER TABLE `memberships` ADD FOREIGN KEY (`id_endingreason`) REFERENCES `membershipsendingreasons` (`id_endingreason`);
