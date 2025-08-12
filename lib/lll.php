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
function showYear(int $year): string {
    $htmlText = '<div class="year"> <br>'. strval($year) .'<br> </div> ';

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

// query to get all memberships
function getQueryMemberships(): string {
    $sqlText = "with recursive Years as ( 
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
                ;";

    return $sqlText;
}

?>