<?php

function affiche_liste_projets() {
    $req = 'select * from PROJET';
    $result = mysql_query($req);

    verification_erreur_requete($req, $result);

    while ($row = mysql_fetch_assoc($result)) {
        echo '<option value="'. $row["projet_numero"] .'">'.$row["projet_nom"].'</option>';
    }
}

function verification_erreur_requete($req, $result) {
    if (!$result) {
        echo "Impossible d'exécuter la requête $req : ". mysql_error();
        exit();
    }

    if (mysql_num_rows($result) == 0) {
        echo "La requête $req ne renvoit aucune ligne.";
        exit();
    }
}

?>
