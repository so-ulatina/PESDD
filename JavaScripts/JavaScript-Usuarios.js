

let allButtons = document.getElementsByClassName('boton-popup');
    

for (let button of allButtons) {
        button.addEventListener('click', function (e) {

            $popupScreen = button.value


           
            // ---------------------- Popup Editar ----------------------

            if ($popupScreen == "Editar") {


                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let idusuario = tr.getElementsByClassName("Id_Usuario")[0].innerHTML;
                let nombreUsuario = tr.getElementsByClassName("Nombre_Usuario")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Apellido1 = tr.getElementsByClassName("Apellido1")[0].innerHTML;
                let Apellido2 = tr.getElementsByClassName("Apellido2")[0].innerHTML;
                let Password = tr.getElementsByClassName("Password")[0].innerHTML;
                let Correo = tr.getElementsByClassName("Correo")[0].innerHTML;
                let Admine1 = tr.getElementsByClassName("Role_Admin")[0].innerHTML;
                let Mante2 = tr.getElementsByClassName("Role_Mant")[0].innerHTML;
                let usuarioe3 = tr.getElementsByClassName("Role_Usuario")[0].innerHTML;

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-editar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Usuarioe").value = idusuario.trim();
                document.getElementById("Nombre_Usuarioe").value = nombreUsuario.trim();
                document.getElementById("Nombree").value = Nombre.trim();
                document.getElementById("Apellido1e").value = Apellido1.trim();
                document.getElementById("Apellido2e").value = Apellido2.trim();
                document.getElementById("Passworde").value = Password.trim();
                document.getElementById("Correoe").value = Correo.trim();

                if (Admine1 == '  X ') {
                    document.getElementById("Admine1").checked = true;
                } else { document.getElementById("Admine1").checked = false; }
                if (Mante2 == '  X ') {
                    document.getElementById("Mante2").checked = true;
                } else { document.getElementById("Mante2").checked = false }
                if (usuarioe3 == '  X ') {
                    document.getElementById("usuarioe3").checked = true;
                } else { document.getElementById("usuarioe3").checked = false; }


            }



            // ---------------------- Popup Eliminar ----------------------

            if ($popupScreen == "Eliminar") {

                // Obtener valores  de la linea de la tabla
                let tr = this.closest('tr');


                let idusuario = tr.getElementsByClassName("Id_Usuario")[0].innerHTML;
                let nombreUsuario = tr.getElementsByClassName("Nombre_Usuario")[0].innerHTML;
                let Nombre = tr.getElementsByClassName("Nombre")[0].innerHTML;
                let Apellido1 = tr.getElementsByClassName("Apellido1")[0].innerHTML;
                let Apellido2 = tr.getElementsByClassName("Apellido2")[0].innerHTML;
                let Password = tr.getElementsByClassName("Password")[0].innerHTML;
                let Correo = tr.getElementsByClassName("Correo")[0].innerHTML;
                let Adminel1 = tr.getElementsByClassName("Role_Admin")[0].innerHTML;
                let Mantel2 = tr.getElementsByClassName("Role_Mant")[0].innerHTML;
                let usuarioel3 = tr.getElementsByClassName("Role_Usuario")[0].innerHTML;

                // inicializar popup en ventana

                $popupContainer = document.querySelector('.popup-container-eliminar');

                $popupContainer.classList.add('active');


                //Agregar informacion en los inputs del popup

                document.getElementById("Id_Usuarioel").value = idusuario.trim();
                document.getElementById("Nombre_Usuarioel").value = nombreUsuario.trim();
                document.getElementById("Nombreel").value = Nombre.trim();
                document.getElementById("Apellido1el").value = Apellido1.trim();
                document.getElementById("Apellido2el").value = Apellido2.trim();
                document.getElementById("Passwordel").value = Password.trim();
                document.getElementById("Correoel").value = Correo.trim();

                if (Adminel1 == '  X ') {
                    document.getElementById("Adminel1").checked = true;
                } else { document.getElementById("Adminel1").checked = false; }
                if (Mantel2 == '  X ') {
                    document.getElementById("Mantel2").checked = true;
                } else { document.getElementById("Mantel2").checked = false }
                if (usuarioel3 == '  X ') {
                    document.getElementById("usuarioel3").checked = true;
                } else { document.getElementById("usuarioel3").checked = false; }

            }


            //Agregar informacion en los inputs del popup

            document.getElementById("Id_Usuarioel").readOnly = true;
            document.getElementById("Nombre_Usuarioel").readOnly = true;
            document.getElementById("Nombreel").readOnly = true;
            document.getElementById("Apellido1el").readOnly = true;
            document.getElementById("Apellido2el").readOnly = true;
            document.getElementById("Passwordel").readOnly = true;
            document.getElementById("Correoel").readOnly = true;

              
            document.getElementById("Adminel1").readOnly = true;
            document.getElementById("Mantel2").readOnly = true;
            document.getElementById("usuarioel3").readOnly = true;
                

           



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




