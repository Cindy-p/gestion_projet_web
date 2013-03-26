function valeurDepuisXml(entite, champ) {
    return entite.getElementsByTagName(champ)[0].firstChild.nodeValue;
}

function texteDepuisXml(entite, champ) {
    var texte = decode_html(entite.getElementsByTagName(champ)[0].firstChild.nodeValue);
    return texte;
}


