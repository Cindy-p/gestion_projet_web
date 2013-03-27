<?php

function affiche_liste_projets() {
    $req = 'select * from PROJET';
    $result = mysql_query($req);

    verification_erreur_requete($req, $result);

    while ($row = mysql_fetch_assoc($result)) {
        echo '<option value="'. $row["projet_numero"] .'">'.$row["projet_nom"].'</option>';
    }
}

function affiche_infos_projet($numeroProjet, $champNom, $champDescription) {
    
}

/*function recuperer_nom_projet($numero_projet) {
    $req = 'select projet_nom from projet where projet_numero =' . $numero_projet;
    $result = mysql_query($req);
    
    verification_erreur_requete($req, $result);
    
    $nom = mysql_fetch_assoc($result);
    
    return $nom;
}

function recuperer_description_projet($numero_projet) {
    $req = 'select projet_description from projet where projet_numero =' . $numero_projet;
    $result = mysql_query($req);
    
    verification_erreur_requete($req, $result);
    
    $description = mysql_fetch_assoc($result);
    
    return $description;
}*/

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
