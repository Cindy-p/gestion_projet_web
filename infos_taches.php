<?php
if (isset($_GET['projet'])) {
    header('Content-type: text/XML');
    include('ecrire_xml.php');
    include('gestion_base.php');
    
    echo '<taches>';
    $req = 'select * from tache where projet_numero = '. $_GET['projet'];
    $result = mysql_query($req);
    while ($row = mysql_fetch_assoc($result)) {
        echo '<tache>';
        ecrire_xml_ent('numero', $row['tache_numero']);
        ecrire_xml_txt('nom', $row['tache_nom']);
        ecrire_xml_ent('duree', $row['tache_duree']);
        echo '</tache>';
    }
    echo '</taches>';
}

?>
