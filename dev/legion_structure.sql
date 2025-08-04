// Use DBML to define your database structure
// Docs: https://dbml.dbdiagram.io/docs

Table characters {
  id_character integer [primary key]
  real_name varchar(100) [not null]
  year_first_appearance integer [not null]
  link_wikipedia varchar(200)
}

Table charactersnames {
  id_character integer [not null]
  name varchar(100) [not null]
  year integer [not null]
}

Table characterspics {
  id_character integer [not null]
  year integer [not null]
  pic varchar(100)
}

Table memberships {
  id_character integer [not null]
  year_initial integer [not null]
  year_final integer 
  id_endingreason integer 
}

Table membershipsendingreasons {
  id_endingreason integer [not null]
  description varchar(100) [not null]
}

Ref: "characters"."id_character" < "charactersnames"."id_character"

Ref: "characters"."id_character" < "characterspics"."id_character"

Ref: "characters"."id_character" < "memberships"."id_character"
