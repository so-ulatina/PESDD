

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let Idcategoria = tr.getElementsByClassName("Id_categoria")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Horasduraciondesde = tr.getElementsByClassName("Horas_duracion_desde")[0].innerHTML;
                let Horasduracionhasta = tr.getElementsByClassName("Horas_duracion_hasta")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;
                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_categoriae").value = Idcategoria.trim();
                document.getElementById("Nombree").value = Nombre.trim();
                document.getElementById("Horas_duracion_desdee").value = Horasduraciondesde.trim();
                document.getElementById("Horas_duracion_hastae").value = Horasduracionhasta.trim();
                document.getElementById("Id_categoriae").readOnly = true;
                document.getElementById("Estadoe").value = estado.trim();
            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let Idcategoria = tr.getElementsByClassName("Id_categoria")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Horasduraciondesde = tr.getElementsByClassName("Horas_duracion_desde")[0].innerHTML;
                let Horasduracionhasta = tr.getElementsByClassName("Horas_duracion_hasta")[0].innerHTML;
                let estado = tr.getElementsByClassName("Estado")[0].innerHTML;
                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_categoriael").value = Idcategoria.trim();
                document.getElementById("Nombreel").value = Nombre.trim();
                document.getElementById("Horas_duracion_desdeel").value = Horasduraciondesde.trim();
                document.getElementById("Horas_duracion_hastael").value = Horasduracionhasta.trim();
                document.getElementById("Estadoel").value = estado.trim();
                // hace campos no editables al eliminar

                document.getElementById("Id_categoriael").readOnly = true;
                document.getElementById("Nombreel").readOnly = true;
                document.getElementById("Horas_duracion_desdeel").readOnly = true;
                document.getElementById("Horas_duracion_hastael").readOnly = true;
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




