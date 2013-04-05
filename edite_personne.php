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
                $numeroPersonne = $_GET['numero'];
                
                // On récupère le nom de la personne
                $req = 'select personne_nom from personne where personne_numero = ' . $numeroPersonne;
                $result = mysql_query($req);
                
                verification_erreur_requete($req, $result);

                $personne = mysql_fetch_assoc($result);
                $nom = $personne['personne_nom'];
                
                mysql_free_result($result);
                
                // On récuoère les tâches effectuées par la personne
                $req = '';
                
                
            }
            ?>
            <form>
                <input type="hidden" name="numero_personne" value="<?php if (isset($numeroPersonne)) { echo $numeroPersonne; } else { echo '0'; } ?>"/>
                <b><label for="nom_personne">Nom*</label></b><br>
                <input type="text" name="nom_personne" id="nom_personne" value="<?php if (isset($numeroPersonne)) { echo $nom; } ?>" style="width: 200px;" onKeyUp="verifNom(this);"/>
                <br><br>
                <div id="liste_deroulante_checkbox">
                    <?php
                    $req = 'select tache_numero, tache_nom from tache';
                    $result = mysql_query($req);

                    while ($row = mysql_fetch_assoc($result)) {
                        echo '<input type="checkbox" name="opt'. $row['tache_numero'] . '" value="'. utf8_encode($row['tache_nom']) .'">'. utf8_encode($row['tache_nom']) .'<br>';
                    }
                    mysql_free_result($result);

                    ?>
                </div>
                <p>* : champ obligatoire</p>
                <input type="button" value="Valider" onClick="enregistrer(this.form);"/>
                <input type="button" value="Retour" onClick="self.location.href='formulaire_personne.php'"/>
            </form>
        </div>
    </body>
</html>