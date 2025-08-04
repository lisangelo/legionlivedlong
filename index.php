<!DOCTYPE html>
<html lang="en">
    <header>
        <title>
            LLL
        </title>
    </header>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/lll.css">
    </head>    

<body>

    <button id="theme-toggle">Light/Dark</button>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-theme');
        });
    </script>


    <h1>Legion Lived Long!</h1>
    <p>All formations since 1958.</p>
            
    <?php
        $servername = "localhost";
        $username = "saturngirl";
        $password = "imraardeen";
        $dbname = "legion";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->query("with recursive Years as ( 
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
                ;");
            $new_year = "";    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if ($row["current"] != $new_year) {
                    echo '<div class="year"><br>'.$row["current"].'<br></div>';
                    $new_year = $row["current"];
                }
                echo '<div class="small-pic">';
                echo '<a target="_blank" rel="noopener noreferrer" href="'.$row["link_wikipedia"].'">';
                echo '<img src="./images/'.$row["pic"].'" title="'.$row["name"].'" alt="'.$row["name"].'">';
                echo '</a>';
                echo '</div>';
            }                

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    ?>
</body>
</html>
    


