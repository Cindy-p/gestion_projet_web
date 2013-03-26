function requete_serveur() {
    var xhr = null;
    try {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (exception) { 
        xhr = new XMLHttpRequest();
    }
    return xhr;
}


