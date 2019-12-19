<?php
    try {
        $bdd=new PDO('mysql:host=localhost;dbname=tp_chat; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('eruer : '.$e->getMessage());
    }

    $repoonse=$bdd->query("SELECT m.imageProfile imageProfile, c.msg msg,  DATE_FORMAT(c.date_msg,'%d/%m/%y %Hh%i') AS date_msg 
                                               FROM membre m 
                                               INNER JOIN chat c 
                                               ON m.id=c.membre
                                               ORDER BY date_msg DESC
                                               LIMIT 20");
    while ($donnees=$repoonse->fetch()) {
?>
    <p>
        <img src="<?php echo $donnees['imageProfile']?>" alt="profile" class="photochat">
        <em><?php echo(' le '.htmlspecialchars($donnees['date_msg']).'</br>'); ?></em>
        <?php echo(htmlspecialchars($donnees['msg'])); ?>
    </p>
<?php
    }
?>