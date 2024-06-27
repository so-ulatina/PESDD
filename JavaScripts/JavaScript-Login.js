const container = document.getElementById('container');
const IniciarSesion1Btn = document.getElementById('IniciarSesion1');
const SalirBtn = document.getElementById('Salir');
let error = document.getElementById('error');

if (error) {
    container.classList.add("active");                  // mientras haya error mantener el toogle a la izqui

    SalirBtn.addEventListener('click', () => {
        container.classList.remove("active");          /// Pone toggle a la derecha
    });

    IniciarSesion1Btn.addEventListener('click', () => {
        container.classList.add("active");              // Pone toggle a la izquierda
    });


} else { 

    IniciarSesion1Btn.addEventListener('click', () => {
        container.classList.add("active");              // Pone toggle a la izquierda
    });

    
    SalirBtn.addEventListener('click', () => {
        container.classList.remove("active");          /// Pone toggle a la derecha
    });

}


