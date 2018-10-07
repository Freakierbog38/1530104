<?php
    class MvcController{
        // Llamar a la plantilla
        public function plantilla(){
            // include se utiliza para invocar el archivo que contiene el código html
            include "views/template.php";
        }

        // Interacción con el usuario
        public function enlacesPaginasController(){
            // Trabajar con los enlaces de las páginas
            // Validamos si la variable acción viene vacía, es decir,
            // cuando se abre la página por primera vez se de cargar la vista index.php
            if( isset( $_GET['action'] ) ){
                // Guardar el valor de la variable acción en "views/modules/navegacion.php"
                // en el cuál se recibe mediante el método GET esa variable
                $enlacesController = $_GET["action"];
            } else{
                // Si viene vacio inicializo con index
                $enlacesController = "index";
            }
            
            // Mostrar los archivos de los enlaces de cada una de las secciones: Inicio, Nosotros, etc.
            // Para esto hay que mandar el módelo para que haga dicho proceso y muestre la información
            $respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);
            include $respuesta;
        }
    }
?>