<?php
    if (isset($_GET['numero'])) {
        header('Content-type: text/xml');
        include('gestion_base.php');
        include('ecrire_xml.php');
        
        $ordreSQL = "select * from personne where personne_numero = " . $_GET['numero'];
        $ResTac = mysql_query($ordreSQL, $conn);
        
        while($row = mysql_fetch_array($ResTac, MYSQL_ASSOC)) {
            echo "<personne>";
            ecrire_xml_ent("numero", $row['personne_numero']);
            ecrire_xml_txt("nom", $row['personne_nom']);
            
            $ordreSQL2 = "select tache_numero,(select tache_nom from tache where tache_numero = af.tache_numero and projet_numero = ";
            $ordreSQL2 .= $_GET['numero'];
            $ordreSQL2 .= ") as \"tache_nom\" from affectation af where personne_numero = ";
            $ordreSQL2 .= $row['personne_numero'];
            $ResTac2 = mysql_query($ordreSQL2);
            
            while ($row2 = mysql_fetch_array($ResTac2, MYSQL_ASSOC)) {
                echo '<tache>';
                ecrire_xml_ent("numero", $row2['tache_numero']);
                ecrire_xml_txt("nom", $row2['tache_nom']);
                echo '</tache>';
            }
            mysql_free_result($ResTac2);
            echo "</personne>";
        }
        mysql_free_result($ResTac);
    }
?>
