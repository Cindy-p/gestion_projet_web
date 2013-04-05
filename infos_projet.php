<?php
    if (isset($_GET['numero'])) {
        header('Content-type: text/xml');
        include('gestion_base.php');
        include('ecrire_xml.php');

            $ordreSQL = "select * from projet where projet_numero = " . $_GET['numero'];
            $ResTac = mysql_query($ordreSQL, $conn);
            if($tache = mysql_fetch_array($ResTac, MYSQL_ASSOC)) {
                    echo "<projet>";
                    ecrire_xml_ent("numero", $tache['projet_numero']);
                    ecrire_xml_txt("nom",    $tache['projet_nom']);
                    ecrire_xml_txt("description",  $tache['projet_description']);
                    echo "</projet>";
            }
            mysql_free_result($ResTac);
    }
?>
