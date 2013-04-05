function change_tache(liste) {
    var numTache = liste.options[liste.selectedIndex].value;
    var req = null;
    document.getElementById('nom_tache').value = '';
    document.getElementById('duree_tache').value = '';
    
    req = requete_serveur();
    
    if (numTache != 0) {
        var url = "infos_tache.php?numero=" + numTache;
    }
    
    if (req != null) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    affiche_infos_tache(req);
                }
            }
        }
    }
    req.open("GET", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(null);
}

function affiche_infos_tache(req) {
    var docRecu = req.responseXML;
    if (docRecu == null)
        return;
    
    var tache = docRecu.getElementsByTagName('tache')[0];
    
    document.getElementById('infos_tache').style.visibility = "visible";
    document.getElementById('nom_tache').disabled = true;
    document.getElementById('duree_tache').disabled = true;
    document.getElementById('liste_predecesseurs').disabled = true;
    document.getElementById('liste_successeurs').disabled = true;
    document.getElementById('nom_tache').value = texteDepuisXml(tache, 'nom');
    document.getElementById('duree_tache').value = valeurDepuisXml(tache, 'duree');
    
    var liste_predecesseurs = document.getElementById('liste_predecesseurs');
    liste_predecesseurs.length = 0;
    var les_predecesseurs = docRecu.getElementsByTagName('predecesseur');
    var i;
    for (i = 0; i < les_predecesseurs.length ; i++) {
        liste_predecesseurs.length++;
        var predecesseur = les_predecesseurs[i];
        liste_predecesseurs.options[i].value = i;
        liste_predecesseurs.options[i].text = texteDepuisXml(predecesseur, 'nom');
    }
    
    var liste_successeurs = document.getElementById("liste_successeurs");
    liste_successeurs.length = 0;
    var les_successeurs = docRecu.getElementsByTagName('successeur');
    var j;
    for (j = 0; j < les_successeurs.length; j++) {
        liste_successeurs.length++;
        var successeur = les_successeurs[j];
        liste_successeurs.options[j].value = j;
        liste_successeurs.options[j].text = texteDepuisXml(successeur, 'nom');
    }
}

function cache_infos_tache() {
    document.getElementById('infos_tache').style.visibility = "hidden";
}

function passage_lien_edite_tache() {
    var liste_taches = document.getElementById("liste_taches");
    self.location.href = 'edite_tache_v2.php?numeroTache=' + liste_taches.options[liste_taches.selectedIndex].value;
}
