/*function change_projet(liste) {
    var numProj = liste.options[liste.selectedIndex].value; // on récupère la valeur du projet sélectionné dans la liste
    var req = null;
    document.getElementById('liste_taches').length = 0;
    document.getElementById('nom_tache').value = '';
    document.getElementById('duree_tache').value = '';
    req = requete_serveur();
    var url = "infos_taches.php?projet=" + numProj;
    
    if (req != null) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    affiche_les_taches(req);
                }
            }
        }
    }
    req.open("GET", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(null);
}*/

/*function affiche_les_taches(req) {
    var docRecu = req.responseXML; // texte qu'il va falloir parcourir en recherchant les données balisées. autrement responseText qui peut être affiché avec alert ou attribué à un constituant de la page (division ou zone de texte) en affectant innerhttp
    if (docRecu == null)
        return;
    var liste_taches = document.getElementById('liste_taches');
    liste_taches.length = 1;
    liste_taches.options[0].value = 0;
    liste_taches.options[0].text = "Choisir une tâche";
    var les_taches = docRecu.getElementsByTagName('tache');
    var i;
    for(i = 0 ; i < les_taches.length ; i++) {
        liste_taches.length++;
        var tache = les_taches[i];
        liste_taches.options[i+1].value = valeurDepuisXml(tache, 'numero');
        liste_taches.options[i+1].text = texteDepuisXml(tache, 'nom');
    }
    
    document.getElementById('ajouter_tache').disabled = false;
    document.getElementById('modifier_tache').disabled = true;
}

function change_tache(liste) {
    var numTache = liste.options[liste.selectedIndex].value; // on récupère la valeur du projet sélectionné dans la liste
    var req = null;
    document.getElementById('nom_tache').value = '';
    document.getElementById('duree_tache').value = '';
    
    req = requete_serveur();
    var url = "infos_tache.php?numero=" + numTache;
    
    if (req != null) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    affiche_nom_duree(req);
                }
            }
        }
    }
    req.open("GET", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(null);
}

function affiche_nom_duree(req) {
    var docRecu = req.responseXML;
    if (docRecu == null)
        return;
    
    var tache = docRecu.getElementsByTagName('tache')[0];
    
    document.getElementById('nom_tache').value = texteDepuisXml(tache, 'nom');
    document.getElementById('duree_tache').value = valeurDepuisXml(tache, 'duree');
    document.getElementById('ajouter_tache').disabled = true;
    document.getElementById('modifier_tache').disabled = false;
}*/

function change_projet(liste) {
    var numProjet = liste.options[liste.selectedIndex].value;
    var req = null;
    document.getElementById('nom_projet').value = '';
    document.getElementById('description_projet').value = '';
    
    req = requete_serveur();
    
    if (numProjet != 0) {
        var url = "infos_projet.php?numero=" + numProjet;
    }
    
    if (req != null) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    affiche_infos_projet(req);
                }
            }
        }
    }
    req.open("GET", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(null);
}

function affiche_infos_projet(req) {
    var docRecu = req.responseXML;
    if (docRecu == null)
        return;
    
    var projet = docRecu.getElementsByTagName('projet')[0];
    
    document.getElementById('infos_projet').style.visibility = "visible";
    document.getElementById('nom_projet').disabled = true;
    document.getElementById('description_projet').disabled = true;
    document.getElementById('nom_projet').value = texteDepuisXml(projet, 'nom');
    document.getElementById('description_projet').value = texteDepuisXml(projet, 'description');
}

function cache_infos_projet() {
    document.getElementById('infos_projet').style.visibility = "hidden";
}

function passage_lien_edite_projet() {
    var numProjet = document.getElementById('liste_projets').options[document.getElementById('liste_projets').selectedIndex].value;
    self.location.href = 'edite_projet.php?numero=' + numProjet;
}