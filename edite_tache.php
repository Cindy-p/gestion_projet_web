<?php
include ('gestion_base.php');
?>
<form action="enregistre_tache.php" method="post">
    Creer une tache<br><br>
    <?php
        $req = 'select MAX(tache_numero)+1 as "numero_tache" from tache';
        $result = mysql_query($req);

        if (!$result) {
            echo "Impossible d'exécuter la requête $sql : ". mysql_error();
            exit();
        }

        if (mysql_num_rows($result) == 0) {
            echo "La requête $sql ne renvoit aucune ligne.";
            exit();
        }

        $row = mysql_fetch_assoc($result);
        echo '<input type="hidden" name="numeroTache" value="' . $row["numero_tache"] . '"/>';
    ?>
    <table>
        <tr>
            <td>Nom</td>
            <td>
                <input type="text" name="nomTache"/>
            </td>
        </tr>
        <tr>
            <td>Duree</td>
            <td>
                <input type="text" name="dureeTache"/>
            </td>
        </tr>
        <tr>
            <td>Projet</td>
            <td>
                <select size="5" style="width:200px;" name="numeroProjet">
                    <option value="0">Choisir un projet</option>
                    <?php
                        $req1 = 'select * from projet';
                        $result1 = mysql_query($req1);

                        if (!$result1) {
                            echo "Impossible d'exécuter la requête $sql1 : ". mysql_error();
                            exit();
                        }

                        if (mysql_num_rows($result1) == 0) {
                            echo "La requête $sql1 ne renvoit aucune ligne.";
                            exit();
                        }

                        while ($row = mysql_fetch_assoc($result1)) {
                            echo '<option value="'. $row["projet_numero"] .'">'.$row["projet_nom"].'</option>';                            
                        }
                        
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="Valider"/>
</form>
