<?php

include ('gestion_base.php');

if (isset($_POST['numeroTache']) and isset($_POST['nomTache']) and isset($_POST['dureeTache']) and isset($_POST['numeroProjet'])) {
    $numeroTache = $_POST['numeroTache'];
    $nomTache = $_POST['nomTache'];
    $dureeTache = $_POST['dureeTache'];
    $numeroProjet = $_POST['numeroProjet'];
    
    $sql = "insert into tache values ('$numeroTache', '$nomTache', '$dureeTache', '$numeroProjet')";
    $result = mysql_query($sql);
    
    if ($result == true) {
        echo "Insertion réalisee avec succès.";
    }
    else {
        echo "Erreur dans l'insertion de la tâche.";
    }
}

?>
