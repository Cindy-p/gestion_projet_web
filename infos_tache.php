<?php
    if (isset($_GET['numero'])) {
        header('Content-type: text/xml');
        include('gestion_base.php');
        include('ecrire_xml.php');

            $ordreSQL = "select * from TACHE where tache_numero = " . $_GET['numero'];
            $ResTac = mysql_query($ordreSQL, $conn);
            if($tache = mysql_fetch_array($ResTac, MYSQL_ASSOC)) {
                    echo "<tache>";
                    ecrire_xml_ent("numero", $tache['tache_numero']);
                    ecrire_xml_txt("nom",    $tache['tache_nom']);
                    ecrire_xml_ent("duree",  $tache['tache_duree']);
                    echo "</tache>";
            }
            mysql_free_result($ResTac);
    }
?>
