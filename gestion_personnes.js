function change_personne(liste) {
    var numPersonne = liste.options[liste.selectedIndex].value;
    var req = null;
    
    req = requete_serveur();
    
    if (numPersonne != 0) {
        var url = "infos_personne.php?numero=" + numPersonne;
    }
    
    if (req != null) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    affiche_infos_personne(req);
                }
            }
        }
    }
    req.open("GET", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(null);
}

function affiche_infos_personne(req) {
    var docRecu = req.responseXML;
    if (docRecu == null)
        return;
    
    var personne = docRecu.getElementsByTagName('personne')[0];
    
    document.getElementById('infos_personne').style.visibility = "visible";
    document.getElementById('nom_personne').disabled = true;
    document.getElementById('liste_taches').disabled = true;
    document.getElementById('nom_personne').value = texteDepuisXml(personne, 'nom');
    
    var liste_taches = document.getElementById('liste_taches');
    liste_taches.length = 0;
    var les_taches = docRecu.getElementsByTagName('tache');
    var i;
    for (i = 0; i < les_taches.length; i++) {
        liste_taches.length++;
        var tache = les_taches[i];
        liste_taches.options[i].value = valeurDepuisXml(tache, 'numero');
        liste_taches.options[i].text = texteDepuisXml(tache, 'nom');
    }
}

function cache_infos_personne() {
    document.getElementById('infos_personne').style.visibility = "hidden";
}

function passage_lien_edite_personne() {
    var liste_personnes = document.getElementById("liste_personnes");
    self.location.href = 'edite_personne.php?numero=' + liste_personnes.options[liste_personnes.selectedIndex].value;
}