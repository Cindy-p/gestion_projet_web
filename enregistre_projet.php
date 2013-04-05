<?php
include ('gestion_base.php');

if ($_POST['numero'] == 0) { // Ajout d'une nouvelle tâche
    echo 'Tache insérée : en cours...';
}
else { // Modification d'une tâche déjà existante
    $req = "update projet set";
    $req .= " projet_nom = '" . $_POST['nom'] . "',";
    $req .= " projet_description = '" . $_POST['description'] . "'";
    $req .= " where projet_numero = " . $_POST['numero'];
    
    if (mysql_query($req)) {
        echo "Le projet a bien été modifié.";
    }
    else {
        echo "Une erreur s'est produite dans la modification du projet.";
    }
}

?>
