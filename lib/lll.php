<?php

// showing a small picture
// $picture - image localization 
// $title - image title
// $alternative - image text to be showed as a tip
// $link - url to external page 
function showSmallPicture(string $picture, string $title, string $alternative, string $link): string { 
    $htmlText = '<div class="small-pic"> '
                .'<a target="_blank" rel="noopener noreferrer" href="'.$link.'"> '
                .'<img src="./images/'.$picture.'" title="'.$title.'" alt="'.$alternative.'"> '
               .'</a> '
               .'</div> ';

    return $htmlText;
}

// anchor to year 
// $year - selected year
function showYear(int $year, string $obs): string {
    $htmlText = '<div class="year" > '
            .'<a id="'.strval($year).'"';
    if ($obs != null) {
        $htmlText .= ' title="'. $obs . '" ';
     }
     $htmlText .= '>' 
                . strval($year) 
                .'</a><br> </div> ';
         

    return $htmlText;
}

// creates an option in combo year 
// $year - selected year
function createYearSelect(int $year): string {
    $htmlText = '<option value="#'.strval($year).'">'
                . strval($year) 
                .'</option> ';

            
    return $htmlText;
}

// get database server name
function getDBServerName(): string {
    $name = "localhost";
    return $name;
}

// get database user name 
function getDBUserName():string {
    $name = "saturngirl";
    return $name;
}

// get database user password
function getDBUserPass():string {
    $pass = "imraardeen";
    return $pass;
}

// get database name
function getDBName():string {
    $name = "legion";
    return $name;
}

// query to get all option years
function getQueryYearsSelect(): string {
    $sqlText = "with recursive YearsLinks as ( 
                select year(curdate()) as option  
                union all 
                select option - 1 from YearsLinks where option > 1958 
                ) 
                select option
                from YearsLinks
                order by option
                ;";

    return $sqlText;
}

// query to get all memberships
function getQueryMemberships(): string {
    $sqlText = "with recursive y as ( 
                select year(curdate()) as current  
                union all 
                select current - 1 from y where current > 1958 
                ) 
                select 
                y.current,
                ifnull(( select obs
                  from years 
                  where id_year = y.current
                ), '') as obs, 
                (
                select name 
                from charactersnames 
                where id_character = c.id_character
                and year <= y.current
                order by year desc 
                limit 1
                ) as name,
                c.real_name, c.year_first_appearance, c.link_wikipedia, 
                (
                select pic 
                from characterspics 
                where id_character = c.id_character
                and year <= y.current
                order by year desc 
                limit 1
                ) as pic, 
                m.year_initial as since,
                mer.description as ending_reason
                from memberships m
                join y 
                on 1 = 1
                inner join characters c 
                on c.id_character = m.id_character
                left join membershipsendingreasons mer
                on mer.id_endingreason = m.id_endingreason
                where m.year_initial <= y.current
                and (
                m.year_final >= y.current
                or m.year_final is null
                )
                order by y.current, c.id_character
                ;";

    return $sqlText;
}
