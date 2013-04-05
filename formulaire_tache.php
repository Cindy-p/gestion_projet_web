<!DOCTYPE html>
<html>
    <head>
        <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="requete_serveur.js"></script>
        <script language="javascript" src="gestion_taches.js"></script>
        <script language="javascript" src="xml.js"></script>
        <script language="javascript" src="decodage.js"></script>
    </head>
    <body>
        <div id="global">
            <?php
            include ('gestion_base.php');
            include ('fonction_projet.php');
            
            if (!empty($_GET['numero'])) {
                $numeroTache = $_GET['numero'];
            ?>
            <form>
                <table cellpadding="8">
                    <tr>
                        <td>
                            <b><label for="liste_taches">Liste des tâches du projet</label></b><br>
                            <select size="8" id="liste_taches" onChange="change_tache(this);" style="height: 250px;width: 200px;">
                                <option value="0">Nouveau...</option>
                                <?php affiche_liste_taches($numeroTache); ?>
                            </select>
                        </td>
                        <td>
                            <div id="infos_tache">
                                <script>
                                    cache_infos_tache();
                                </script>
                                
                                <b><label for="nom_tache">Nom</label></b><br>
                                <input type="text" id="nom_tache" style="width: 200px;"/>
                                <br><br>
                                <b><label for="duree_tache">Durée</label></b><br>
                                <input type="text" id="duree_tache" style="width: 40px;"/>
                                <br><br>
                                <b><label for="liste_predecesseurs">Commence à la fin de...</label></b><br>
                                <select size="3" id="liste_predecesseurs" style="width: 200px;"></select>
                                <br><br>
                                <b><label for="liste_successeurs">Commence au début de...</label></b><br>
                                <select size="3" id="liste_successeurs" style="width: 200px;"></select>
                                <br><br>
                                <input type="button" id="modifier_tache" value="Modifier" onClick="passage_lien_edite_tache();"/>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <?php } ?>
        </div>
    </body>
</html>