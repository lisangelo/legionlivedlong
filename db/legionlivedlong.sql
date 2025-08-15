with recursive Years as ( 
  select year(curdate()) as current  
  union all 
  select current - 1 from Years where current > 1958 
) 
select 
Years.current, 
(
  select name 
  from charactersnames 
  where id_character = c.id_character
  and year <= Years.current
  order by year desc 
  limit 1
) as name,
c.real_name, c.year_first_appearance, c.link_wikipedia, 
(
  select pic 
  from characterspics 
  where id_character = c.id_character
  and year <= Years.current
  order by year desc 
  limit 1
) as pic, 
m.year_initial as since,
mer.description as ending_reason
from memberships m
join Years 
on 1 = 1
inner join characters c 
on c.id_character = m.id_character
left join membershipsendingreasons mer
on mer.id_endingreason = m.id_endingreason
where m.year_initial <= Years.current
and (
  m.year_final >= Years.current
  or m.year_final is null
)
order by Years.current, c.id_character
;