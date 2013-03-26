<!DOCTYPE html>
<html>
    <head>
        <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="requete_serveur.js"></script>
        <script language="javascript" src="gestion_projets.js"></script>
        <script language="javascript" src="xml.js"></script>
        <script language="javascript" src="decodage.js"></script>
    </head>
    <body>
        <div id="global">
            <?php
            include ('gestion_base.php');
            ?>

            <form>
                <table>
                    <tr>
                        <td>
                            <b><label for="liste_projets">Projet(s)</label></b><br>
                            <select size="8" id="liste_projets" onChange="change_projet(this);">
                                <?php
                                    $req = 'select * from PROJET';
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
                                        echo '<option value="'. $row["projet_numero"] .'">'.$row["projet_nom"].'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <b><label for="liste_taches">Tâche(s)</label></b><br>
                            <select size="8" id="liste_taches" onChange="change_tache(this);"></select>
                        </td>
                        <td>
                            <input id="ajouter_tache" type="button" value="Ajouter une tâche" disabled="disabled" onClick="self.location.href='edite_tache_v2.php?numeroTache=14'"/><br>
                            <input id="modifier_tache" type="button" value="Modifier la tâche" disabled="disabled" onClick="passage_lien_edite_tache();"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b><label for="nom_tache">Nom</label></b><br>
                            <input id="nom_tache" type="text" size="20" maxlength="20" disabled="disabled"/><br>
                            <b><label for="duree_tache">Durée</label></b><br>
                            <input id="duree_tache" type="text" size="4" maxlength="4" disabled="disabled"/> 
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>

