<?php
    class EnlacesPaginas{
        // Función con el parámetro $enlacesModel que se recibe atraves del controlador
        public function enlacesPaginasModel($enlacesModel){
            // Validamos
            if( $enlacesModel == "nosotros" || 
                $enlacesModel == "servicios" || $enlacesModel == "contactenos" ){
                // Mostramos el URL concatenado con $enlacesModel
                $module = "views/modules/" . $enlacesModel . ".php";
            }
            
            // Una vez que "action" viene vacío(validando en el controlador) entonces se 
            // consulta si la variable $enlacesModel es igual a la cadena "index" para
            // que de ser así se muestre index.php
            else if($enlacesModel == "index"){
                $module = "views/modules/inicio.php";
            }

            // Validar una LISTA BLANCA
            else{
                $module = "views/modules/inicio.php";
            }

            return $module;
        }
    }
?>