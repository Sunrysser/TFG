function showProd(str) {
    //si el string que llega esta vacio acabamos la funcion y dejamos todo vacio
    if (str == ""){
      document.getElementById("prods").innerHTML = "";
      return;
    } 

    //si correctamente recibimos un argumento valido
	else{
        //creamos una nueva pericion http usando xml
        var xmlhttp = new XMLHttpRequest();

        //en cuanto cambie el estado de la peticion creada anteriormente ejecutamos una funcion
        xmlhttp.onreadystatechange = function() {
            //si el estado es positivo y el estado tambien rellenamos el div con la respuesta que da el archivo php que se abre mas abajo
            if (this.readyState == 4 && this.status == 200) document.getElementById("prods").innerHTML = this.responseText;
        };
        xmlhttp.open("GET","../consulta.php?cat="+str,true);
        xmlhttp.send();
    }
}

function showPed(str) {
    //si el string que llega esta vacio acabamos la funcion y dejamos todo vacio
    if (str == ""){
      document.getElementById("peds").innerHTML = "";
      return;
    } 

    //si correctamente recibimos un argumento valido
	else{
        //creamos una nueva pericion http usando xml
        var xmlhttp = new XMLHttpRequest();

        //en cuanto cambie el estado de la peticion creada anteriormente ejecutamos una funcion
        xmlhttp.onreadystatechange = function() {
            //si el estado es positivo y el estado tambien rellenamos el div con la respuesta que da el archivo php que se abre mas abajo
            if (this.readyState == 4 && this.status == 200) document.getElementById("peds").innerHTML = this.responseText;
        };
        xmlhttp.open("GET","../consultaPeds.php?estado="+str,true);
        xmlhttp.send();
    }
}

function showRes(str) {
    //si el string que llega esta vacio acabamos la funcion y dejamos todo vacio
    if (str == ""){
        document.getElementById("reses").innerHTML = "";
        return;
    } 

    //si correctamente recibimos un argumento valido
    else{
        //creamos una nueva pericion http usando xml
        var xmlhttp = new XMLHttpRequest();

        //en cuanto cambie el estado de la peticion creada anteriormente ejecutamos una funcion
        xmlhttp.onreadystatechange = function() {
            //si el estado es positivo y el estado tambien rellenamos el div con la respuesta que da el archivo php que se abre mas abajo
            if (this.readyState == 4 && this.status == 200) document.getElementById("reses").innerHTML = this.responseText;
        };
        xmlhttp.open("GET","../consultaRes.php?estado="+str,true);
        xmlhttp.send();
    }
}