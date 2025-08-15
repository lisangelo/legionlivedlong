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

    <h1>Legion Lived Long!</h1>
    <p>All formations since 1958.</p>
            
    <?php

        include "./lib/lll.php";

        $servername = getDBServerName();
        $username = getDBUserName();
        $password = getDBUserPass();
        $dbname = getDBName();

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Year Combo
            echo "Go to ";
            echo '<select id="yearSelector"'.'> ';
            $stmt = $conn->query(getQueryYearsSelect());
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                echo createYearSelect($row["option"]);
            }
            echo '</select> <br> ';
            echo PHP_EOL;

            // Memberships
            $stmt = $conn->query(getQueryMemberships());
            $new_year = "";    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if ($row["current"] != $new_year) {
                    echo PHP_EOL;
                    echo showYear($row["current"], $row["obs"]);
                    $new_year = $row["current"];
                }
                echo showSmallPicture($row["pic"], $row["name"], $row["name"], $row["link_wikipedia"]);
            }                

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    ?>

    <script>

        // Theme
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-theme');
        });

        // Year Selector
        document.getElementById('yearSelector').addEventListener('change', function() {
            var selectedAnchor = this.value;
            if (selectedAnchor) {
                window.location = selectedAnchor;
            }
        });

    </script>

</body>
</html>
    

