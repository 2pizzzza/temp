<?php
$DB_HOST = "localhost";
$DB_PORT = "5432";
$DB_USER = "postgres";
$DB_PASSWORD = "postgres";
$database = "chat_x";
$connect = pg_connect("host=$DB_HOST port=$DB_PORT dbname=$database user=$DB_USER password=$DB_PASSWORD");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Light Grey</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/core.css">
    <meta name="viewport"
          content="width=1200px, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<div class="wrapper">
    <div class="cards">
        <div class="container">
            <div class="cards_inner">

                <?php
                $query = "SELECT * FROM news";
                $result = pg_query($connect, $query);

                if (!$result) {
                    die("Ошибка выполнения запроса.");
                }

                while ($row = pg_fetch_assoc($result)) {
                    echo "
                            <div class='card'>
                                      <h3>{$row['title']}</h3>
                                     <p>{$row['content']}</p>
                                      <a href='details.php?id={$row['id']}'>more</a>
                             </div>";
                }
                pg_free_result($result);

                ?>
            </div>
        </div>
    </div>

    <div class="page_content">
        <div class="container">
            <div class="inner_page_content">
                <div class="updates">
                    <h4>Latest Update</h4>

                    <?php
                    $res = pg_query($connect, "SELECT * FROM news");

                    while ($myrow = pg_fetch_assoc($res)) {
                        printf(' 
                            <article class="mews_cont">
                                <div class="news">
                                    <img src="%s" alt="small_picture">
                                    <div class="text-content">
                                        <h6>%s</h6>
                                        <p>%s</p>
                                    </div>
                                </div>
                                <div class="gray_line"></div>
                                <span class="date">June 18, 2048</span>
                            </article>
                        ', $myrow['img'], $myrow['title'], $myrow['content']);
                    }

                    // Освобождаем ресурсы
                    pg_free_result($res);
                    ?>

                   </div>
</body>
</html>