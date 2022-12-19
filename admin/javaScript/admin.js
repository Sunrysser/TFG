//event listeners que se encargan de enseñar y esconder las listas de enlaces del menu del admin
desplegables.forEach(element => {
    element.addEventListener('click', function () {
        Array.from(element.parentElement.childNodes).forEach(hijo =>{
            console.log(hijo);
            if (hijo.tagName == 'UL') {
                hijo.classList.toggle('abierto');
            }

            if (hijo.tagName == 'I' && !(hijo.id == 'esteNo')) {
                hijo.classList.toggle('fa-chevron-down');
                hijo.classList.toggle('fa-chevron-up');
            }
        });
    });
});

desplegables2.forEach(element => {
    element.addEventListener('click', function () {
        Array.from(element.parentElement.childNodes).forEach(hijo =>{
            console.log(hijo);
            if (hijo.tagName == 'UL') {
                hijo.classList.toggle('abierto');
            }

            if (hijo.tagName == 'I' && !(hijo.id == 'esteNo')) {
                hijo.classList.toggle('fa-chevron-down');
                hijo.classList.toggle('fa-chevron-up');
                console.log(hijo.id);
            }
        });
    });
});

//event listener que se encarga de el menu hamburguesa
botonNav.addEventListener('click', function () {
    console.log('botonNAv');
    if (header.style.right == '100%') {
        header.style.right = '50%';
        header.style.boxShadow = '0.5px 0 5px #171717';
        divEncima.style.display = 'block';
        navB.style.left = '52%';
        navB.classList.toggle('open');
    }

    else{
        header.style.right = '100%';
        header.style.boxShadow = '0 0 0 0';
        divEncima.style.display = 'none';
        navB.style.left = '3%';
        navB.classList.toggle('open');
        console.log('cerrando');
    }
});