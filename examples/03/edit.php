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
            <h2 class="article-title">Redigera veckorapport</h2>
            <form method="post">
                <p class="content">
                <?php
                    if(isset($_POST['submit'])) {
                        if(empty(trim($_POST['title'])) || empty(trim($_POST['body']))) {
                            if(empty(trim($_POST['body'])) && empty(trim($_POST['title']))) {
                                echo '<p style="color: red;">Du glömde fylla i allt.</p>';
                            } else {
                                if(empty(trim($_POST['title']))) {
                                    echo '<p style="color: red;">Du glömde fylla i titeln.</p>';
                                }

                                if(empty(trim($_POST['body']))) {
                                    echo '<p style="color: red;">Du glömde fylla i vad du har gjort idag.</p>';
                                }
                            }
                        } else {
                            try {
                                $dbh = new PDO('mysql:host=localhost;dbname=veckorapporten', "användarnamn", "lösenord");
                                $stmt = $dbh->prepare("UPDATE journals SET title = :title, body = :body WHERE id = :id");
                                $stmt->bindParam(':title', $title);
                                $stmt->bindParam(':body', $body);
                                $stmt->bindParam(':id', $_GET['id']);

                                $title = trim($_POST['title']);
                                $body = trim($_POST['body']);
                                $stmt->execute();

                                header('Location: index.php');
                            } catch(PDOException $e) {
                                echo '<p style="color: red;">Ett fel inträffade!</p>';
                            }
                        }
                    }
                ?>

                <?php
                    try {
                        $dbh = new PDO('mysql:host=localhost;dbname=veckorapporten', "användarnamn", "lösenord");
                        $stmt = $dbh->prepare("SELECT title, body, date FROM journals WHERE id = :id");
                        $stmt->bindParam(':id', $_GET['id']);
                        $stmt->execute();
                        $row = $stmt->fetch();
                    } catch(PDOException $e) {
                        echo '<p style="color: red;">Ett fel inträffade!</p>';
                    }
                ?>
                    <label for="title">Titel: &nbsp;</label>
                    <br />
                    <input id="title" name="title" type="text" value="<?php echo $row['title']; ?>" />
                    <br /><br />
                    <label for="body">Idag har jag: &nbsp;</label>
                    <br />
                    <textarea id="body" name="body"><?php echo $row['body']; ?></textarea>
                    <br />
                    <input name="submit" type="submit" value="Spara" />
                </p>
            </form>
        </article>

        <footer id="footer-bottom">
            <p>Copyright &copy; 2015 Fabian Bakkum</p>
        </footer>
    </div>
</body>
</html>
