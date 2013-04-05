<!DOCTYPE html>
<html>
    <head>
        <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="edite_projet.js"></script>
        <script language="javascript" src="requete_serveur.js"></script>
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
                <input type="hidden" name="numero_projet" value="<?php if (isset($numeroProjet)) { echo $numeroProjet; } else { echo '0'; } ?>"/>
                <b><label for="nom_projet">Nom*</label></b><br>
                <input type="text" name="nom_projet" id="nom_projet" value="<?php if (isset($numeroProjet)) { echo $nom; } ?>" style="width: 200px;" onKeyUp="verifNom(this);"/>
                <br><br>
                <b><label for="description_projet">Description*</label></b><br>
                <textarea name="description_projet" id="description_projet" style="width: 400px; height: 150px;" onKeyUp="verifDescription(this);"><?php if (isset($numeroProjet)) { echo $description; } ?></textarea>
                <br>
                <p>* : champ obligatoire</p>
                <input type="button" value="Valider" onClick="enregistrer(this.form);"/>
                <input type="button" value="Retour" onClick="self.location.href='formulaire_projet.php'"/>
            </form>
        </div>
    </body>
</html>
