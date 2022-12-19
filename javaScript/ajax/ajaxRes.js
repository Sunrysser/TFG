function cambEst(id, estado, tlf) {
    //si el numero de tlf tiene el simbolo '+' lo cambiamos por un caracter cualquiera (en este caso la P) para poder enviarlo por get en la url
    tlf = String(tlf).replace('+','P');

    //creamos una nueva pericion http usando xml
    var xmlhttp = new XMLHttpRequest();

    //en cuanto cambie el estado de la peticion creada anteriormente ejecutamos una funcion
    xmlhttp.onreadystatechange = function() {
        //si el estado es positivo y el estado tambien rellenamos el div con la respuesta que da el archivo php que se abre mas abajo
        if (this.readyState == 4 && this.status == 200) document.getElementById("ajaxDiv").innerHTML = this.responseText;
    };
    //ejecutamos un archivo php
    xmlhttp.open("GET","cambiarEstadoR.php?estado="+estado+"&id="+id+"&tlf="+String(tlf),true);
    xmlhttp.send();
}