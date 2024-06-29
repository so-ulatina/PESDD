

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let Idmodalidad = tr.getElementsByClassName("Id_modalidad")[0].innerHTML;
                let Descripcion = tr.getElementsByClassName("Descripcion")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_modalidade").value = Idmodalidad.trim();
                document.getElementById("Descripcione").value = Descripcion.trim();
                document.getElementById("Id_modalidade").readOnly = true;
                document.getElementById("Estadoe").value = estado.trim();

            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');

                let Idmodalidad = tr.getElementsByClassName("Id_modalidad")[0].innerHTML;
                let Descripcion = tr.getElementsByClassName("Descripcion")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;
               

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_modalidadel").value = Idmodalidad.trim();
                document.getElementById("Descripcionel").value = Descripcion.trim();
                document.getElementById("Estadoel").value = estado.trim();

                //Hacer campos no editables al eliminar

                document.getElementById("Id_modalidadel").readOnly = true;
                document.getElementById("Descripcionel").readOnly = true;
                document.getElementById("Estadoel").readOnly = true; 

            }



        })

    };


function agregar() {

    $popupContainer = document.querySelector('.popup-container-agregar');

    $popupContainer.classList.add('active');
}



function agregarCerrar() {
    $popupContainer.classList.remove('active');
}



function editarCerrar() {
    $popupContainer.classList.remove('active');
}

 /// ----------------  Inicio Obtener fecha actual ---------------------

    function getCurrentDateAndTime() {
        const dateTime = new Date();
        return dateTime.toLocaleString();
    }

    // Asignar un elemento de html para asi desplegar la fecha actual
    const dateDisplay = document.getElementById("date-container");

    // Asignar el innerHTML a un elemento para asi desplegar la fecha actual
    dateDisplay.innerHTML = getCurrentDateAndTime();


/// ----------------  Fin Obtener fecha actual ---------------------




