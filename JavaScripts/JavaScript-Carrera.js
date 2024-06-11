

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let IdCarrera = tr.getElementsByClassName("Id_Carrera")[0].innerHTML;
                let nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let IdFacultad = tr.getElementsByClassName("Id_Facultad")[0].innerHTML;
                let Idsede = tr.getElementsByClassName("Id_sede")[0].innerHTML;
                

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Carrerae").value = IdCarrera.trim();
                document.getElementById("Nombree").value = nombre.trim();


                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de carrera obtenido de la base de datos)
                var fac = document.getElementsByClassName("Facultad-" + IdFacultad.trim());
                fac[0].selected = 'selected';


                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de sede obtenido de la base de datos)
                var sede = document.getElementsByClassName("Sede-" + Idsede.trim());
                sede[0].selected = 'selected';


            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let IdCarrera = tr.getElementsByClassName("Id_Carrera")[0].innerHTML;
                let nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let IdFacultad = tr.getElementsByClassName("Id_Facultad")[0].innerHTML;
                let Idsede = tr.getElementsByClassName("Id_sede")[0].innerHTML;
               

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Carrerael").value = IdCarrera.trim();
                document.getElementById("Nombreel").value = nombre.trim();
                document.getElementById("Id_Facultadel").value = IdFacultad.trim();
                document.getElementById("Id_sedeel").value = Idsede.trim();
               
                document.getElementById("Id_Carrerael").readOnly = true;
                document.getElementById("Nombreel").readOnly = true;
                document.getElementById("Id_Facultadel").readOnly = true;
                document.getElementById("Id_sedeel").readOnly = true;


               


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




