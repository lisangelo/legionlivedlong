CREATE TABLE `worlds` (
  `id_world` integer PRIMARY KEY,
  `name` varchar(100) NOT NULL
);
CREATE TABLE `years` (
  `id_year` integer PRIMARY KEY,
  `obs` text
);
alter table characters add column id_world integer;
ALTER TABLE `characters` ADD FOREIGN KEY (`id_world`) REFERENCES `worlds` (`id_world`);
insert into worlds values(1, 'Earth');
insert into worlds values(2, 'Kripton');
insert into worlds values(3, 'Titan');
insert into worlds values(4, 'Braal'); -- cosmic boy
insert into worlds values(5, 'Winath'); -- lightning boy
insert into worlds values(6, 'Durla'); -- chameleon
update characters set id_world = 4 where id_character = 1;
update characters set id_world = 3 where id_character = 2;
update characters set id_world = 5 where id_character = 3;
update characters set id_world = 2 where id_character = 4;
update characters set id_world = 6 where id_character = 5;
update characters set id_world = 1 where id_character = 6;
update characters set id_world = 1 where id_character = 7;
insert into years values (1958, 'All begins here! The pranks I mean. Superboy in');
insert into years values (1959, 'New uniforms, same old prank');
insert into years values (1960, 'Meet new members Chameleon, Colossal and Invisible Kid. Better luck next time Supergirl');

