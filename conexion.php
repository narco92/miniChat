<?php
    session_start();    
    try {
        $bdd=new PDO('mysql:host=localhost;dbname=tp_chat; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('eruer : '.$e->getMessage());
    }
    if (isset($_POST['BConexion'])) {
        $reponse=$bdd->prepare('SELECT id, mot_de_passe FROM membre WHERE pseudo=:pseudo');
        $reponse->execute(array('pseudo'=>trim(htmlspecialchars($_POST['pseudo']))));
        $tableau=array();
        $donnees=$reponse->fetch();
        $tableau=array($donnees['mot_de_passe']);
        if (isset($donnees['mot_de_passe'])) {
            if ($donnees['mot_de_passe']==trim(htmlspecialchars($_POST['mdp']))) {
                $_SESSION['id']=htmlspecialchars($donnees['id']);
                header('Location: chat.php');
            } else {
                echo'Mot de passe incorect';
            }
        } else {
            echo 'peseudo incorect';
        }
        $reponse->closeCursor();
    } elseif (isset($_POST['BSubmit'])) {
        $reponse=$bdd->prepare('SELECT pseudo FROM membre WHERE pseudo=:pseudo');
        $reponse->execute(array('pseudo'=> trim($_POST['prePseudo'])));
        $donnees=$reponse->fetch();
            
        if (isset($donnees['pseudo'])) {
            $reponse->closeCursor();
            echo 'le pseudo existe deja';
        } else {
            if (!empty($_POST['prePseudo']) &&
                    !empty($_POST['preMdp']) &&
                    !empty($_POST['email'])&&
                    isset($_FILES['photo']) &&
                    $_FILES['photo']['error']==0) {
                if ($_FILES['photo']['size']<=100000) {
                    $infofichier=pathinfo($_FILES['photo']['name']);
                    $extension_upload=$infofichier['extension'];
                    $extension_autorisees=array('jpg','jpeg','png');
                    if (in_array($extension_upload, $extension_autorisees)) {
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/'.basename($_FILES['photo']['name']));
                        $lien='uploads/'.$_FILES['photo']['name'];
                        $reponse->closeCursor();
                        $requete=$bdd->prepare('INSERT INTO membre (pseudo, mot_de_passe, nom, prenom, email,imageProfile)
                                                        VALUES(:pseudo, :motDePasse, :nom, :prenom, :email, :imageProfile)');
                        $requete->execute(array(
                                'pseudo'=>trim($_POST['prePseudo']),
                                'motDePasse'=>trim($_POST['preMdp']),
                                'nom'=>trim($_POST['nom']),
                                'prenom'=>trim($_POST['prenom']),
                                'email'=>trim($_POST['email']),
                                'imageProfile'=>$lien
                                ));
                    }
                }
                echo "inscription reussi";
            } else {
                echo"not";
            }
        }
    }
?>