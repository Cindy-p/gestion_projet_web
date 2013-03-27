<!DOCTYPE html>
<html>
    <head>
        <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include ('gestion_base.php');
        include ('fonction_projet.php');
        ?>
        <div id="global">
            <?php
            if (isset($_GET['numero'])) {
                $numeroProjet = $_GET['numero'];
                
                $req = 'select projet_nom, projet_description from projet where projet_numero=' . $numeroProjet;
                $result = mysql_query($req);

                verification_erreur_requete($req, $result);

                $projet = mysql_fetch_assoc($result);
                $nom = $projet['projet_nom'];
                $description = utf8_encode($projet['projet_description']);
            }
            ?>
            <form>
                <b><label for="nom_projet">Nom</label></b><br>
                <input type="text" id="nom_projet" value="<?php if (isset($numeroProjet)) { echo $nom; } ?>" style="width: 200px;"/>
                <br><br>
                <b><label for="description_projet">Description</label></b><br>
                <textarea id="description_projet" style="width: 400px; height: 150px;"><?php if (isset($numeroProjet)) { echo $description; } ?></textarea>
                <br><br>
                <input type="button" value="Valider" onClick=""/>
                <input type="button" value="Retour" onClick="self.location.href='formulaire_projet.php'"/>
            </form>
        </div>
    </body>
</html>
