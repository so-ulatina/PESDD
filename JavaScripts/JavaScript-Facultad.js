﻿

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let IdFacultad = tr.getElementsByClassName("Id_Facultad")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Facultade").value = IdFacultad.trim();
                document.getElementById("Nombree").value = Nombre.trim();
                document.getElementById("Estadoe").value = estado.trim();
                document.getElementById("Id_Facultade").readOnly = true;

            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');



                let IdFacultad = tr.getElementsByClassName("Id_Facultad")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;
               

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Facultadel").value = IdFacultad.trim();
                document.getElementById("Nombreel").value = Nombre.trim();
                document.getElementById("Estadoel").value = estado.trim();

                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Facultadel").readOnly = true;
                document.getElementById("Nombreel").readOnly = true;
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




