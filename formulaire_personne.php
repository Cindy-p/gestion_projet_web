<!DOCTYPE html>
<html>
    <head>
        <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="requete_serveur.js"></script>
        <script language="javascript" src="gestion_personnes.js"></script>
        <script language="javascript" src="xml.js"></script>
        <script language="javascript" src="decodage.js"></script>
    </head>
    <body>
        <div id="global">
            <?php
            include ('gestion_base.php');
            include ('fonction_projet.php');
            
            if (!empty($_GET['numero'])) { 
                $numeroProjet = $_GET['numero']; ?>
            <form>
                <table cellpadding="8">
                    <tr>
                        <td>
                            <b><label for="liste_personnes">Liste des personnes</label></b><br>
                            <select size="8" id="liste_personnes" onChange="change_personne(this);" style="height: 250px; width:200px;">
                                <option value="0">Nouveau...</option>
                                <?php affiche_liste_personnes($numeroProjet); ?>
                            </select>
                        </td>
                        <td>
                            <div id="infos_personne">
                                <script>
                                    cache_infos_personne();
                                </script>
                                <b><label for="nom_personne">Nom</label></b><br>
                                <input type="text" id="nom_personne" style="width: 200px;"/>
                                <br><br>
                                <b><label for="liste_taches">Liste des tâches effectuées</label></b><br>
                                <select size="3" id="liste_taches" style="width: 200px;"></select>
                                <br><br>
                                <input type="button" id="modifier_personne" value="Modifier" onClick="passage_lien_edite_personne();"/>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <?php } ?>
        </div>
    </body>
</html>