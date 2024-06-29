

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let IdCursosMatriculados = tr.getElementsByClassName("Id_cursos_matriculados")[0].innerHTML;
                let Idcedula = tr.getElementsByClassName("Id_cedula")[0].innerHTML;
                let Idcuatrimestre2 = tr.getElementsByClassName("Id_cuatrimestre")[0].innerHTML;
                let Idcuatrimestre = (Idcuatrimestre2.split("-")[0]);

                let Idcurso2 = tr.getElementsByClassName("Id_curso")[0].innerHTML;
                let Idcurso = (Idcurso2.split("-")[0]);

                let Nota = tr.getElementsByClassName("Nota")[0].innerHTML;
                let Estado = tr.getElementsByClassName("Estado")[0].innerHTML;

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_cursos_matriculadose").value = IdCursosMatriculados.trim();


                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de cedula obtenido de la base de datos)

                var ced = document.getElementsByClassName("Cedula-" + Idcedula.trim());
                ced[0].selected = 'selected';

                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de cuatrimestre obtenido de la base de datos)

                var cuat = document.getElementsByClassName("Cuatrimestre-" + Idcuatrimestre.trim());
                cuat[0].selected = 'selected';


                // obtener  la opcion seleccionada en el select por clase(nombre de la clase es el mismo id de curso obtenido de la base de datos)

                var curso = document.getElementsByClassName("Curso-" + Idcurso.trim());
                curso[0].selected = 'selected';

               

                document.getElementById("Notae").value = Nota.trim();
                document.getElementById("Estadoe").value = Estado.trim();
                document.getElementById("Id_cursos_matriculadose").readOnly = true;

            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');

                let IdCursosMatriculados = tr.getElementsByClassName("Id_cursos_matriculados")[0].innerHTML;
                let Idcedula = tr.getElementsByClassName("Id_cedula")[0].innerHTML;
                let Idcuatrimestre = tr.getElementsByClassName("Id_cuatrimestre")[0].innerHTML;
                let Idcurso = tr.getElementsByClassName("Id_curso")[0].innerHTML;
                let Nota = tr.getElementsByClassName("Nota")[0].innerHTML;
                let Estado = tr.getElementsByClassName("Estado")[0].innerHTML;

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup
                document.getElementById("Id_cursos_matriculadosel").value = IdCursosMatriculados.trim();
                document.getElementById("Id_cedulael").value = Idcedula.trim();
                document.getElementById("Id_cuatrimestreel").value = Idcuatrimestre.trim();
                document.getElementById("Id_cursoel").value = Idcurso.trim();
                document.getElementById("Notael").value = Nota.trim();
                document.getElementById("Estadoel").value = Estado.trim();


                // Hacer campos no editables al eliminar

                document.getElementById("Id_cursos_matriculadosel").readOnly = true;
                document.getElementById("Id_cedulael").readOnly = true;
                document.getElementById("Id_cuatrimestreel").readOnly = true;
                document.getElementById("Id_cursoel").readOnly = true;
                document.getElementById("Notael").readOnly = true;
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




