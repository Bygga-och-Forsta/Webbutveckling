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
        <article>
            <h2 class="article-title">Radera veckorapport</h2>
            <form method="post">
                <p class="content">
                <?php
                    if(isset($_POST['submit'])) {
                        try {
                            $dbh = new PDO('mysql:host=localhost;dbname=veckorapporten', "användarnamn", "lösenord");
                            $stmt = $dbh->prepare("DELETE FROM journals WHERE id = :id");
                            $stmt->bindParam(':id', $_GET['id']);
                            $stmt->execute();
                            header('Location: index.php');
                        } catch(PDOException $e) {
                            echo '<p style="color: red;">Ett fel inträffade!</p>';
                        }
                    }
                ?>
                    <p>Är du säker att du vill ta bort posten?</p>
                    <input name="submit" type="submit" value="Radera" />
                </p>
            </form>
        </article>

        <footer id="footer-bottom">
            <p>Copyright &copy; 2015 Fabian Bakkum</p>
        </footer>
    </div>
</body>
</html>
