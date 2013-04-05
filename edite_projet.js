function verifNom(element) {
    if (element.value == 0) {
        elementAvecErreurs(element, "Le nom doit contenir au moins un caractère.");
        return false;
    }
    
    // Ne peut contenir que des chiffres, des lettres ou des apostrophes
    exprReg = /^[A-Za-z0-9 \-\']+$/;
    if (!exprReg.test(element.value)) {
        elementAvecErreurs(element, "Le nom de projet est incorrect.")
        return false;
    }
    
    elementSansErreurs(element);
    return true;
}

function verifDescription(element) {
    if (element.value == 0) {
        elementAvecErreurs(element, "La description doit contenir au moins un caractère.");
        return false;
    }
    elementSansErreurs(element);
    return true;
}

function verifTout(formulaire) {
    var ok = true;
    if (!verifNom(formulaire.elements["nom_projet"]))
        ok = false;
    
    if (!verifDescription(formulaire.elements["description_projet"]))
        ok = false;
    
    return ok;
}

function enregistrer(formulaire) {
    if (!verifTout(formulaire)) {
        alert('Certaines données sont incorrectes.');
        return;
    }
    
    var req = null;
    req = requete_serveur();
    var script = "enregistre_projet.php";
    var donnees = "file=" + script;
    donnees += "&numero=" + formulaire.elements['numero_projet'].value;
    donnees += "&nom=" + formulaire.elements['nom_projet'].value;
    donnees += "&description=" + formulaire.elements['description_projet'].value;
    
    if (req != null) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    afficheResultat(req);
                    self.location.href = 'formulaire_projet.php';
                }
            }
        }
    }
    req.open("POST", script, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(donnees);
}

function afficheResultat(req) {
    var docRecu = req.responseText;
    if (docRecu == null) {
        return;
    }
    alert(docRecu);
}

function elementAvecErreurs(element, message) {
    element.style.borderColor = "#e24e4e";
    element.style.backgroundColor = "#f5bfbf";
    element.title = message;
}

function elementSansErreurs(element) {
    element.style.borderColor = "#abadb3";
    element.style.backgroundColor = "#ffffff";
    element.title = "";
}


