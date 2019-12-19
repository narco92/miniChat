<?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['message'])) {
            $requette=$bdd->prepare('INSERT INTO chat (msg, date_msg, membre) VALUES(:msg, NOW(), :membre)');
            $requette->execute(array(
        'msg'=>$_POST['message'],
        'membre'=>$_SESSION['id']
        ))
        or die(print_r($requette->errorInfo()));
            header('Location: chat.php');
        } else {
            header('Location: chat.php');
        }
    }
?>