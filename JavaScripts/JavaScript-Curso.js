

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let IdCurso = tr.getElementsByClassName("Id_Curso")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Horas = tr.getElementsByClassName("Horas")[0].innerHTML;
                let IdCategoria2 = tr.getElementsByClassName("Id_Categoria")[0].innerHTML;
                let IdCategoria = (IdCategoria2.split("-")[0]);


                let IdModalidad2 = tr.getElementsByClassName("Id_Modalidad")[0].innerHTML;
                let IdModalidad = (IdModalidad2.split("-")[0]);

                let Idcertificado2 = tr.getElementsByClassName("Id_certificado")[0].innerHTML;
                let Idcertificado = (Idcertificado2.split("-")[0]);

                let Idadministrador2 = tr.getElementsByClassName("Id_administrador")[0].innerHTML;
                let Idadministrador = (Idadministrador2.split("-")[0]);

                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;
                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Cursoe").value = IdCurso.trim();
                document.getElementById("Nombree").value = Nombre.trim();
                document.getElementById("Estadoe").value = estado.trim();
                document.getElementById("Horase").value = Horas.trim();

                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de categoria obtenido de la base de datos)

                var cat = document.getElementsByClassName("Categoria-" + IdCategoria.trim());
                cat[0].selected = 'selected';


                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de Modalidad obtenido de la base de datos)

                var mod = document.getElementsByClassName("Modalidad-" + IdModalidad.trim());
                mod[0].selected = 'selected';

                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de certificado obtenido de la base de datos)

                var cert = document.getElementsByClassName("Certificado-" + Idcertificado.trim());
                cert[0].selected = 'selected';

                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de administrador obtenido de la base de datos)

                var adm = document.getElementsByClassName("Administrador-" + Idadministrador.trim());
                adm[0].selected = 'selected';

               

            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');

                let IdCurso = tr.getElementsByClassName("Id_Curso")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Horas = tr.getElementsByClassName("Horas")[0].innerHTML;
                let IdCategoria = tr.getElementsByClassName("Id_Categoria")[0].innerHTML;
                let IdModalidad = tr.getElementsByClassName("Id_Modalidad")[0].innerHTML;
                let Idcertificado = tr.getElementsByClassName("Id_certificado")[0].innerHTML;
                let Idadministrador = tr.getElementsByClassName("Id_administrador")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;
                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup
                document.getElementById("Id_Cursoel").value = IdCurso.trim();
                document.getElementById("Nombreel").value = Nombre.trim();
                document.getElementById("Id_Categoriael").value = IdCategoria.trim();
                document.getElementById("Id_Modalidadel").value = IdModalidad.trim();
                document.getElementById("Id_certificadoel").value = Idcertificado.trim();
                document.getElementById("Id_administradorel").value = Idadministrador.trim();
                document.getElementById("Estadoel").value = estado.trim();
                document.getElementById("Horasel").value = Horas.trim();
                //hacer campos no editables al eliminar

                document.getElementById("Id_Cursoel").readOnly = true;
                document.getElementById("Nombreel").readOnly = true;
                document.getElementById("Id_Categoriael").readOnly = true;
                document.getElementById("Id_Modalidadel").readOnly = true;
                document.getElementById("Id_certificadoel").readOnly = true;
                document.getElementById("Id_administradorel").readOnly = true;
                document.getElementById("Estadoel").readOnly = true; 
                document.getElementById("Horasel").readOnly = true; 
               

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




