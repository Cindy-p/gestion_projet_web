<?php

$conn = mysql_connect('localhost', 'root', '');

if (!$conn) {
    echo 'Impossible de se connecter à la base de données'. mysql_error();
}

if (!mysql_select_db('gestion_proj')) {
    echo 'Impossible de sélectionner la base gestion_proj'. mysql_error();
}

?>
