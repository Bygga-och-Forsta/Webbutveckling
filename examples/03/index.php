<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Veckorapporten</title>
    <link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <header id="header-top">
        <h1 id="logo"><a href="index.php">Veckorapporten</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Hem</a></li>
                <li><a href="new.php">Ny</a></li>
            </ul>
        </nav>
    </header>

    <div id="page-container">
        <?php
            $dbh = new PDO('mysql:host=localhost;dbname=veckorapporten', "användarnamn", "lösenord");
            $sql = "SELECT id, title, body, date FROM journals";
            foreach($dbh->query($sql) as $row):
        ?>
        <article>
            <h2 class="article-title"><?php echo $row['title']; ?></h2>
            <p class="actions">
                <a href="delete.php?id=<?php echo $row['id']; ?>">Radera</a>
                &nbsp;
                <a href="edit.php?id=<?php echo $row['id']; ?>">Redigera</a>
                &nbsp;
                <span class="date"><?php echo $row['date']; ?></span>
            </p>
            <p class="content">
                <?php echo $row['body']; ?>
            </p>
        </article>
        <?php endforeach; ?>

        <footer id="footer-bottom">
            <p>Copyright &copy; 2015 Fabian Bakkum</p>
        </footer>
    </div>
</body>
</html>
