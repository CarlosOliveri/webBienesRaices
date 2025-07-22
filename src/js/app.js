document.addEventListener('DOMContentLoaded',function(){

    eventListeners();
    darkMode();
})

function darkMode(){
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme:dark)');
    prefiereDarkMode.matches ? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');

    prefiereDarkMode.addEventListener('change', function(){
        prefiereDarkMode.matches ? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    })
}

function eventListeners() {
    try{
        const menuHamburg = document.querySelector(".mobile-menu");

        menuHamburg.addEventListener('click', menuResponsive);
    }catch{
        console.log("no se encontro la hamburguesa");
    }

}

function menuResponsive(){
    const navegacion = document.querySelector(".navegacion");
    console.log("menu responsive");
    navegacion.classList.toggle("mostrar");
}


