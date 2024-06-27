

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let Idcedula = tr.getElementsByClassName("Id_cedula")[0].innerHTML;
                let IdDocente = tr.getElementsByClassName("Id_Docente")[0].innerHTML;
                let Idcarrera = tr.getElementsByClassName("Id_carrera")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Apellido1 = tr.getElementsByClassName("Apellido1")[0].innerHTML;
                let Apellido2 = tr.getElementsByClassName("Apellido2")[0].innerHTML;
                let NivelAcademico = tr.getElementsByClassName("Id_NivelAcademico")[0].innerHTML;
                let Correo = tr.getElementsByClassName("Correo")[0].innerHTML;
                let Celular = tr.getElementsByClassName("Celular")[0].innerHTML;
                let Fecha_Nacimiento = tr.getElementsByClassName("Fecha_Nacimiento")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;




                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_cedulae").value = Idcedula.trim();
                document.getElementById("Id_Docentee").value = IdDocente.trim();
                document.getElementById("Estadoe").value = estado.trim();


                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de categoria obtenido de la base de datos)

                var cat = document.getElementsByClassName("Carrera-" + Idcarrera.trim());
                cat[0].selected = 'selected';

                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de categoria obtenido de la base de datos)

                var cat = document.getElementsByClassName("NivelAcademico-" + NivelAcademico.trim());
                cat[0].selected = 'selected';



                document.getElementById("Nombree").value = Nombre.trim();
                document.getElementById("Apellido1e").value = Apellido1.trim();
                document.getElementById("Apellido2e").value = Apellido2.trim();
                document.getElementById("Correoe").value = Correo.trim();
                document.getElementById("Celulare").value = Celular.trim();
                document.getElementById("Fecha_Nacimientoe").value = Fecha_Nacimiento.trim();
                document.getElementById("Id_cedulae").readOnly = true;

            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let Idcedula = tr.getElementsByClassName("Id_cedula")[0].innerHTML;
                let IdDocente = tr.getElementsByClassName("Id_Docente")[0].innerHTML;
                let Idcarrera = tr.getElementsByClassName("Id_carrera")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Apellido1 = tr.getElementsByClassName("Apellido1")[0].innerHTML;
                let Apellido2 = tr.getElementsByClassName("Apellido2")[0].innerHTML;
                let NivelAcademico = tr.getElementsByClassName("Id_NivelAcademico")[0].innerHTML;
                let Correo = tr.getElementsByClassName("Correo")[0].innerHTML;
                let Celular = tr.getElementsByClassName("Celular")[0].innerHTML;
                let Fecha_Nacimiento = tr.getElementsByClassName("Fecha_Nacimiento")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;


                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_cedulael").value = Idcedula.trim();
                document.getElementById("Id_Docenteel").value = IdDocente.trim();
                document.getElementById("Id_carrerael").value = Idcarrera.trim();
                document.getElementById("Nombreel").value = Nombre.trim();
                document.getElementById("Apellido1el").value = Apellido1.trim();
                document.getElementById("Apellido2el").value = Apellido2.trim();
                document.getElementById("Nivel_Academicoel").value = NivelAcademico.trim();
                document.getElementById("Correoel").value = Correo.trim();
                document.getElementById("Celularel").value = Celular.trim();
                document.getElementById("Fecha_Nacimientoel").value = Fecha_Nacimiento.trim();
                document.getElementById("Estadoel").value = estado.trim();

                //Hacer campos no editables al eliminar

                document.getElementById("Id_cedulael").readOnly = true;
                document.getElementById("Id_Docenteel").readOnly = true;
                document.getElementById("Id_carrerael").readOnly = true;
                document.getElementById("Nombreel").readOnly = true;
                document.getElementById("Apellido1el").readOnly = true;
                document.getElementById("Apellido2el").readOnly = true;
                document.getElementById("Id_NivelAcademicoel").readOnly = true;
                document.getElementById("Correoel").readOnly = true;
                document.getElementById("Celularel").readOnly = true;
                document.getElementById("Fecha_Nacimientoel").readOnly = true;
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




