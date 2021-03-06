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
            include ('fonction_projet.php');
            ?>
            <form>
                <table cellpadding="8">
                    <tr>
                        <td>
                            <b><label for="liste_projets">Liste des projets</label></b><br>
                            <select size="8" id="liste_projets" onChange="change_projet(this);" style="height: 250px;">
                                <option value="0">Nouveau...</option>
                                <?php affiche_liste_projets(); ?>
                            </select>
                        </td>
                        <td>
                            <div id="infos_projet">
                                <script>
                                    cache_infos_projet();
                                </script>
                                
                                <b><label for="nom_projet">Nom</label></b><br>
                                <input type="text" id="nom_projet" style="width: 200px;"/>
                                <br><br>
                                <b><label for="description_projet">Description</label></b><br>
                                <textarea id="description_projet" style="width: 400px; height: 150px;"></textarea>
                                <br><br>
                                <input type="button" id="modifier_projet" value="Modifier" onClick="passage_lien_edite_projet();"/>
                                <input type="button" id="selectionner_projet" value="Sélectionner"/>
                            </div>
                        </td>
                        <!-- <td>
                            <b><label for="liste_taches">Tâche(s)</label></b><br>
                            <select size="8" id="liste_taches" onChange="change_tache(this);"></select>
                        </td>
                        <td>
                            <input id="ajouter_tache" type="button" value="Ajouter une tâche" disabled="disabled" onClick="self.location.href='edite_tache_v2.php?numeroTache=14'"/><br>
                            <input id="modifier_tache" type="button" value="Modifier la tâche" disabled="disabled" onClick="passage_lien_edite_tache();"/>
                        </td> -->
                    </tr>
                    
                    <!--
                    <tr>
                        <td colspan="2">
                            <b><label for="nom_tache">Nom</label></b><br>
                            <input id="nom_tache" type="text" size="20" maxlength="20" disabled="disabled"/><br>
                            <b><label for="duree_tache">Durée</label></b><br>
                            <input id="duree_tache" type="text" size="4" maxlength="4" disabled="disabled"/> 
                        </td>
                    </tr>
                    -->
                </table>
            </form>
        </div>
    </body>
</html>

