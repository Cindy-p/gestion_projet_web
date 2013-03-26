<?php
function ecrire_xml_txt($nomBalise, $valeur) {
    printf("<" . $nomBalise . "><![CDATA[%s]]></" . $nomBalise . ">", htmlentities($valeur));
}

function ecrire_xml_ent($nomBalise, $valeur) {
    printf("<" . $nomBalise . ">%d</" . $nomBalise . ">", $valeur);
}
?>
