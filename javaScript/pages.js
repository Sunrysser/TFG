//funcion que se encarga de pasar las paginas del menu 
function nextPage(){
    //si el numero de la pagina actual es menor que el numero de paginas total
    if (numPag<7) {
        //pasamos una pagina sumandole una al numero actual y cargando esa imagen
        ++numPag;
        menuFood.src = 'images/menu/'+numPag+'.jpg';
        pageDisplay.value= numPag+'/7';
    }

    //si el usuario esta en la ultima pagina no se pasa de pagina y se añade una animacion al boton para indicarlo al usuario
    else{
        nextButton.classList.add('shaking');
        setTimeout(()=>{nextButton.classList.remove('shaking')}, 500);
    }
}
//como la funcion de arriba
function prevPage(){
    if (numPag>1) {
        --numPag;
        menuFood.src = 'images/menu/'+numPag+'.jpg';
        pageDisplay.value= numPag+'/7';
    }

    else{
        prevButton.classList.add('shaking');
        setTimeout(()=>{prevButton.classList.remove('shaking')}, 500);
    }
}

//estas dos funciones siguientes son las mismas que arriba pero para otro sitio donde se muestra el menu tambien
function nextPageB(){
    if (numPag<7) {
        ++numPag;
        menuFoodB.src = 'images/menu/'+numPag+'.jpg';
        pageDisplayB.value= numPag+'/7';
    }

    else{
        nextButtonB.classList.add('shaking');
        setTimeout(()=>{nextButtonB.classList.remove('shaking')}, 500);
    }
}

function prevPageB(){
    if (numPag>1) {
        --numPag;
        menuFoodB.src = 'images/menu/'+numPag+'.jpg';
        pageDisplayB.value= numPag+'/7';
    }

    else{
        prevButtonB.classList.add('shaking');
        setTimeout(()=>{prevButtonB.classList.remove('shaking')}, 500);
    }
}

//funcion que se encarga de enseñar otra vista del menu
function showMenuB() {
    console.log(menuBigDiv);
    if (menuBigDiv.style.display == 'none') {
        menuBigDiv.style.display = 'flex';
        console.log('abriendo');
    }

    else{
        menuBigDiv.style.display = 'none';
    }
}

//un eventlistener para sacar y esconder el menu hamburguesa
botonNav.addEventListener('click', function () {
    if (header.style.left == '100%') {
        header.style.left = '50%';
        header.style.boxShadow = '0.5px 0 5px #171717';
        divEncima.style.display = 'block';
        navB.classList.toggle('open');
    }

    else{
        header.style.left = '100%';
        header.style.boxShadow = '0 0 0 0';
        divEncima.style.display = 'none';
        navB.classList.toggle('open');
        console.log('cerrando');
    }
});

