<?php

class MvcController{ 
    //Llamar a la plantilla
    public function pagina(){
        //Include se utiliza para invocar el arhivo que contiene el codigo HTML
        include "views/template.php";
    }

    //Interacción con el usuario
    public function enlacesPaginasController(){
        //Trabajar con los enlaces de las páginas
        //Validamos si la variable "action" viene vacia, es decir cuando se abre la pagina por primera vez se debe cargar la vista index.php

        if(isset($_GET['action'])){
            //guardar el valor de la variable action en views/modules/navegacion.php en el cual se recibe mediante el metodo get esa variable
            $enlaces = $_GET['action'];
        }else{
            //Si viene vacio inicializo con index
            $enlaces = "index";
        }

        //Mostrar los archivos de los enlaces de cada una de las secciones: inicio, nosotros, etc.
        //Para esto hay que mandar al modelo para que haga dicho proceso y muestre la informacions

        $respuesta = Paginas::enlacesPaginasModel($enlaces);

        include $respuesta;
    }

    public function registroUsuarioController(){
        if(isset($_POST["usuarioRegistro"])){

            //Recibe a traves del metodo POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email)
            $datosController = array("usuario" => $_POST["usuarioRegistro"],
                                     "password" => $_POST["passwordRegistro"],
                                     "email" => $_POST["emailRegistro"]);

            
            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel), que en la clase "Datos" la funcion "registrousuariomodel" reciba en sus dos parametros los valores $datosController y el nombre de la tabla a conectarnos la cual es "usuarios"
            $respuesta = Datos::registroUsuarioModel($datosController, "usuario");

            //Se imprime la respuesta en la vista
            if($respuesta == "success"){
                header("location:index.php?action=ok");
            }
            else{
                header("location:index.php");
            }
        }
    }

    public function ingresoUsuarioController(){
        if($_SESSION)
            header("Location: index.php?action=usuarios");
        if(isset($_POST["usuarioIngreso"])){

            //Recibe los datos ingresados en en html mediante método POST, y los almacena en un array
            $datosController = array("usuario" => $_POST["usuarioIngreso"],
                                     "password" => $_POST["passwordIngreso"]);

            
            //Se le dice al modelo models/crud.php (Datos::ingresoUsuarioModel), que en la clase "Datos" la funcion "ingresoUsuariomodel" reciba en sus dos parametros los valores $datosController y el nombre de la tabla a conectarnos la cual es "usuarios"
            $respuesta = Datos::ingresoUsuariosModel($datosController, "usuario");

            //Se imprime la respuesta en la vista
            if($respuesta == "success"){
                header("location:index.php?action=sesiON");
            }
            else{ // Muesta el error
                echo ($respuesta);
            }
        }
    }

    public function muestraUsuarioController(){
        //Se le dice al modelo models/crud.php (Datos::mostrarUsuarioModel), que en la clase "Datos" la funcion "mostrarUsuariomodel" que muestra la lista de los usuarios
        $respuesta = Datos::mostrarUsuariosModel("usuario");
        //Si regresa algo, crea la tabla de los usuarios
        if($respuesta){
            echo "<table>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th width=250>Nombre</th>";
                        echo "<th width=250>Modificar?</th>";
                        echo "<th width=250>Eliminar?</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($r = $respuesta->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr>";
                        echo "<td>".$r["nombre"]."</td>";
                        echo "<td><a href="."index.php?action=editar&user=".$r['id'].">Modificar</a></td>";
                        echo "<td><a href="."index.php?action=eliminar&user=".$r['id'].">Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
            echo "</table>";
        }
        else //Si no, no hace nada
            return [];

    }

    public function cambioUsuarioController($id){
        if(isset($_POST["usuarioCambio"])){

            //Recibe a traves del metodo POST el name (html) de usuario, password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password y email)
            $datosController = array("usuario" => $_POST["usuarioCambio"],
                                     "email" => $_POST["emailCambio"],
                                    "id" => $id);

            
            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel), que en la clase "Datos" la funcion "registrousuariomodel" reciba en sus dos parametros los valores $datosController y el nombre de la tabla a conectarnos la cual es "usuarios"
            $respuesta = Datos::editarUsuarioModel($datosController, "usuario");

            //Se imprime la respuesta en la vista
            if($respuesta == "success"){
                header("location:index.php?action=cambio");
            }
            else{
                header("location:index.php");
            }
        }
    }

    public function eliminarUsuarioController($id){
        //Se le dice al modelo models/crud.php (Datos::eliminarUsuarioModel), que en la clase "Datos" la funcion "eliminarUsuarioModel" reciba en sus dos parametros el id y el nombre de la tabla a conectarnos la cual es "usuarios"
        $respuesta = Datos::eliminarUsuarioModel($id, "usuario");
        //Si se realizó la operación
        if($respuesta == "success")
        //Manda infomación en la variable action mediante GET
            header("Location: index.php?action=cambio");
        else
        //Si no, no manda nada
            header("Location: index.php");
    }

    public function salirUsuarioController(){
        //Destruye la sesión y la reinicia
        session_unset();
        session_destroy();
    }

}

?>