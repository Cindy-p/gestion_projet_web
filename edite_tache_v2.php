<!DOCTYPE html>
<html>
    <head>
        <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="edite_tache_v2.js"></script>
        <script language="javascript" src="requete_serveur.js"></script>
    </head>
    <body>
        <?php
        include ('gestion_base.php');
        
        if (isset($_GET['numeroTache'])) {
            $req2 = 'select tache_nom, tache_duree, projet_numero from tache where tache_numero = ' . $_GET['numeroTache'];
            $result2 = mysql_query($req2);
            
            if (!$result2) {
                echo "Impossible d'exécuter la requête $req2 : ". mysql_error();
                exit();
            }

            if (mysql_num_rows($result2) == 0) {
                echo "La requête $req2 ne renvoit aucune ligne.";
                exit();
            }
            
            while ($tache = mysql_fetch_assoc($result2)) {
                $nomTache = $tache['tache_nom'];
                $dureeTache = $tache['tache_duree'];
                $projet = $tache['projet_numero'];
            }
        }
        
        function verifSelect($name, $value){
            if (isset($_GET['numeroTache'])) {
                if ($_POST[$name] == $value)
                    echo "selected";
            }
        }
        
        ?>        
        
        <div id="global">
            <form>
                Créer une tache<br><br>
                <?php
                    $req = 'select MAX(tache_numero)+1 as "numero_tache" from tache';
                    $result = mysql_query($req);

                    if (!$result) {
                        echo "Impossible d'exécuter la requête $req : ". mysql_error();
                        exit();
                    }

                    if (mysql_num_rows($result) == 0) {
                        echo "La requête $req ne renvoit aucune ligne.";
                        exit();
                    }

                    $row = mysql_fetch_assoc($result);
                    echo '<input type="hidden" name="numeroTache" value="' . $row["numero_tache"] . '"/>';
                ?>
                <table cellpadding="4">
                    <tr>
                        <td><b><label for="nomTache">Nom</label></b></td>
                        <td>
                            <input type="text" name="nomTache" id="nomTache" value="<?php if(isset($_GET['numeroTache'])) { echo $nomTache; }?>" onKeyUp="verifNom(this);"/>
                        </td>
                    </tr>
                    <tr>
                        <td><b><label for="dureeTache">Durée</label></b></td>
                        <td>
                            <input type="text" name="dureeTache" value="<?php if(isset($_GET['numeroTache'])) { echo $dureeTache; }?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td><b><label for="numeroProjet">Projet(s)</label></b></td>
                        <td>
                            <select size="5" style="width:200px;" name="numeroProjet">
                                <option value="0">Choisir un projet</option>
                                <?php
                                    $req1 = 'select * from projet';
                                    $result1 = mysql_query($req1);

                                    if (!$result1) {
                                        echo "Impossible d'exécuter la requête $req1 : ". mysql_error();
                                        exit();
                                    }

                                    if (mysql_num_rows($result1) == 0) {
                                        echo "La requête $req1 ne renvoit aucune ligne.";
                                        exit();
                                    }

                                    while ($row = mysql_fetch_assoc($result1)) { ?>
                                        <option value="<?php echo $row["projet_numero"]; ?>" <?php if(isset($_GET['numeroTache'])) { if($row['projet_numero'] == $projet) { echo 'selected'; } } ?>> <?php echo $row["projet_nom"]; ?> </option>;                            
                                    <?php }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="button" value="Valider" onClick="enregistrer(this.form)"/>
                <input type="button" value="Retour" onClick="self.location.href='formulaire.php'"/>
            </form>
        </div>
    </body>
</html>
