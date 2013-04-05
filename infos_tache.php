<?php
    if (isset($_GET['numero'])) {
        header('Content-type: text/xml');
        include('gestion_base.php');
        include('ecrire_xml.php');

        $ordreSQL = "select * from TACHE where tache_numero = " . $_GET['numero'];
        $ResTac = mysql_query($ordreSQL, $conn);
        
        while ($tache = mysql_fetch_array($ResTac, MYSQL_ASSOC)) {
            echo "<tache>";
            ecrire_xml_ent("numero", $tache['tache_numero']);
            ecrire_xml_txt("nom", $tache['tache_nom']);
            ecrire_xml_ent("duree", $tache['tache_duree']);

            $ordreSQL2 = 'select (select tache_nom from tache where tache_numero = tache_numero_predecesseur) as "predecesseur",';
            $ordreSQL2 .= '(select tache_nom from tache where tache_numero = tache_numero_successeur) as "successeur", delai, classe from contrainte where tache_numero_successeur = ';
            $ordreSQL2 .= $tache['tache_numero'];
            $ResTac2 = mysql_query($ordreSQL2);

            while($contrainte = mysql_fetch_array($ResTac2, MYSQL_ASSOC)) {
                if ($contrainte['classe'] == 1) {
                    echo '<predecesseur>';
                    ecrire_xml_txt("nom", $contrainte['predecesseur']);
                    ecrire_xml_ent("delai", $contrainte['delai']);
                    echo '</predecesseur>';
                }
                else {
                    echo '<successeur>';
                    ecrire_xml_txt("nom", $contrainte['predecesseur']);
                    ecrire_xml_ent("delai", $contrainte['delai']);
                    echo '</successeur>';
                }
            }
            mysql_free_result($ResTac2);
            echo "</tache>";  
        }
        mysql_free_result($ResTac);
    }
?>
