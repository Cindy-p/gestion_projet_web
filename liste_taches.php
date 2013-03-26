<?php

include('gestion_base.php');

if (isset($_GET['projet'])) {

    $req = 'select * from tache where projet_numero = '. $_GET['projet'];
    $result = mysql_query($req);

    if (!$result) {
        echo "Impossible d'exécuter la requête $sql : ". mysql_error();
        exit();
    }

    if (mysql_num_rows($result) == 0) {
        echo "La requête $sql ne renvoit aucune ligne.";
        exit();
    }

    while ($row = mysql_fetch_assoc($result)) {
        echo 'Numéro : '.$row['tache_numero'].'<br>';
        echo 'Nom : '.$row['tache_nom'].'<br>';
        echo 'Durée : '.$row['tache_duree'].'<br><br>';
    }
}

?>
