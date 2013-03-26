<?php
    
include ('gestion_base.php');

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
    echo $row["projet_numero"].'<br>';
    echo $row["projet_nom"].'<br>';
    echo $row["projet_description"]. '<br><br>';
}

?>
