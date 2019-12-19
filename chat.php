<?php session_start();
    $id_session=$_SESSION['id'];
    try {
        $bdd=new PDO('mysql:host=localhost;dbname=tp_chat; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('eruer : '.$e->getMessage());
    }
    include("envoie.php");
    $repoonseNameUser=$bdd->query("SELECT nom, prenom, imageProfile FROM membre WHERE id=$id_session");
    $nomUser=$repoonseNameUser->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styleChat.css">
        <title>Messagerie</title>
        <script src="http://code.jquery.com/jquery-latest.js" > </script>
        <script>
            var refreshId = setInterval(function(){
                $('#msg').fadeOut("slow").load('div.php').fadeIn("slow");
            }, 10000);
        </script>
    </head>
    <body>
        <header>
            <div><img src="logo.png" alt="logo"></div>
            <div id="photoNom">
                <h1>
                    <?php
                    echo htmlspecialchars(strtoupper($nomUser['nom'])).' '. htmlspecialchars(ucfirst($nomUser['prenom']));
                    $repoonseNameUser->closeCursor();
                    ?>
                </h1>
                <img src="<?php echo $nomUser['imageProfile']; ?>" alt="profile" class="photoProfile">
            </div>
        </header>
        <section>
            <div id="centre">
                <div id="msg">
                    <?php
                        $repoonse=$bdd->query("SELECT m.imageProfile imageProfile, c.msg msg,  DATE_FORMAT(c.date_msg,'%d/%m/%y %Hh%i') AS date_msg 
                        FROM membre m 
                        INNER JOIN chat c 
                        ON m.id=c.membre
                        ORDER BY date_msg DESC
                        LIMIT 20");
                        while ($donnees=$repoonse->fetch()) {
                    ?>
                        <p id="toto">
                            <img src="<?php echo $donnees['imageProfile']?>" alt="profile" class="photochat">
                            <em><?php echo(' le '.htmlspecialchars($donnees['date_msg']).'</br>'); ?></em>
                            <?php echo(htmlspecialchars($donnees['msg'])); ?>
                        </p>
                    <?php
                        }
                    ?>
                </div>
                <form action="" method="POST">
                    <textarea name="message" id="message" cols="30" rows="2" placeholder="Ecrire ....."></textarea>
                    <p><input type="submit" value="Envoyer" id="btn" name="btn" ></p>
                </form>
            </div>
        </section>
    </body>
</html>