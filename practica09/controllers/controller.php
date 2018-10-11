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

    public function registroAlumnoController(){
        if(isset($_POST["matriculaRegistro"])){
            //Se extrae el nombre del archivo que se subió
            $nombreArchivo = basename($_FILES['imagenRegistro']['name']);
            //Del nombre se extrae la extensión
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            //Se reemplaza el nombre por la matricula conservando su extensión
            $nombreArchivo = $_POST["matriculaRegistro"] . "." . $extension;
            //Recibe todas las variables mediante POST y las asigna a un array asociado
            $datosController = array("matricula" => $_POST["matriculaRegistro"],
                                     "nombre" => $_POST["nombreRegistro"],
                                     "carrera" => $_POST["carreraRegistro"],
                                     "academica" => $_POST["academicaRegistro"],
                                     "email" => $_POST["emailRegistro"],
                                     "tutor" => $_POST["tutorRegistro"],
                                    "foto" => $nombreArchivo);
            
            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel), que en la clase "Datos" la funcion "registrousuariomodel" reciba en sus dos parametros los valores $datosController y el nombre de la tabla a conectarnos la cual es "usuarios"
            $respuesta = Datos::registroAlumnoModel($datosController, "alumno");

            //Se imprime la respuesta en la vista
            if($respuesta == "success"){
                //Si el registro fue exitoso se mueve la imagen a la carpeta
                move_uploaded_file($_FILES['imagenRegistro']['tmp_name'], 'img/' . $nombreArchivo);
                header("location:index.php?action=ok");
            }
            else{
                header("location:index.php");
            }
        }
    }

    public function muestraAlumnosController(){
        //Se llama a la función que traerá los registros de la tabla, contenida en la clase Datos
        $respuesta = Datos::mostrarUsuariosModel("alumno");
        //Si regresa algo, crea la tabla de los usuarios
        if($respuesta){
            echo "<table>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th width=250></th>";
                        echo "<th width=250>Matricula</th>";
                        echo "<th width=250>Nombre</th>";
                        echo "<th width=250>Correo</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($r = $respuesta->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr>";
                        echo "<td><img src="."img/". $r["foto"] ." height=50 width=50></td>";
                        echo "<td>".$r["matricula"]."</td>";
                        echo "<td>".$r["nombre"]."</td>";
                        echo "<td>".$r["email"]."</td>";
                        echo "<td><a href="."index.php?action=editar&user=".$r['matricula']."><button>Modificar</button></a></td>";
                        echo "<td><a href="."index.php?action=eliminar&user=".$r['matricula']."><button>Eliminar</button></a></td>";
                        echo "<td><a href="."index.php?action=perfilA&user=".$r['matricula']."><button>Ver</button></a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
            echo "</table>";
        }
        else //Si no, no hace nada
            return [];

    }

    public function cambioAlumnoController(){
        if(isset($_POST["matriculaEditar"])){
            //Se extrae el nombre del archivo que se subió
            $nombreArchivo = basename($_FILES['imagenEditar']['name']);
            //Del nombre se extrae la extensión
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            //Se reemplaza el nombre por la matricula conservando su extensión
            $nombreArchivo = $_POST["matriculaEditar"] . "." . $extension;
            //Se extrae la ruta actual de la imagen
            $r = Datos::unAlumnoModel("alumno", $_GET["user"]);
            $foto = $r["foto"];
            //Recibe todas las variables mediante POST y las asigna a un array asociado
            $datosController = array("matricula" => $_POST["matriculaEditar"],
                                     "nombre" => $_POST["nombreEditar"],
                                     "carrera" => $_POST["carreraEditar"],
                                     "academica" => $_POST["academicaEditar"],
                                     "email" => $_POST["emailEditar"],
                                     "tutor" => $_POST["tutorEditar"],
                                     "foto" => $nombreArchivo);
            
            //Se llama a la función que hará el cambio en la base de datos
            $respuesta = Datos::editarAlumnoModel($datosController, "alumno");

            //Se imprime la respuesta en la vista
            if($respuesta == "success"){
                //Si se cambió la imagen entra para borrar la imagen anterior, y poner la nueva
                if($extension){
                    //Se borra la imagen anterior del alumno, usando el dato guardado
                    unlink("img/".$foto);
                    //Una vez eliminada la foto, se guarda la nueva con el mismo nombre pero extensión distinta, o igual dependiendo
                    move_uploaded_file($_FILES['imagenEditar']['tmp_name'],"img/".$nombreArchivo);
                }
                header("location:index.php?action=cambio");
            }
            else{
                header("location:index.php");
            }
        }
    }

    public function eliminarAlumnoController($id){
        //Se le dice al modelo models/crud.php (Datos::eliminarUsuarioModel), que en la clase "Datos" la funcion "eliminarUsuarioModel" reciba en sus dos parametros el id y el nombre de la tabla a conectarnos la cual es "usuarios"
        $respuesta = Datos::eliminarAlumnoModel($id, "alumno");
        //Si se realizó la operación
        if($respuesta == "success")
        //Manda infomación en la variable action mediante GET
            header("Location: index.php?action=cambio");
        else
        //Si no, no manda nada
            header("Location: index.php");
    }

}

?>