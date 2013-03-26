/*function verifNom(input) {
    var nom = input.value;
    
    if (nom.length < 1) {
        document.getElementById('nomTache').style.border = "1px #ff0000 solid";
    }
}*/

function enregistrer(formulaire) {
    var req = null;
    req = requete_serveur();
    alert(req);
    var script = "enregistre_tache.php";
    var donnees = "file=" + script;
	donnees += "&numeroTache=" + formulaire.elements['numeroTache'].value;
	donnees += "&nomTache=" + formulaire.elements['nomTache'].value;
	donnees += "&dureeTache=" + formulaire.elements['dureeTache'].value;
	donnees += "&numeroProjet=" + formulaire.elements['numeroProjet'].value;
        
    if (req != null) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    afficheResultat(req);
                }
            }
        }
        req.open("POST", script , true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.send(donnees);
    }
}

function afficheResultat(req) {
    var docRecu = req.responseText;
    if (docRecu == null) return;
    alert(docRecu);
}
