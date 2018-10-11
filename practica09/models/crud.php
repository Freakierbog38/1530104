<?php

require_once("conexion.php");

class Datos extends Conexion{
        
    #Registro de usuarios
    public function registroAlumnoModel($datosModel, $tabla){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción INSERT 
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(matricula,nombre,academica,carrera,tutor,email,foto) VALUES(:matricula,:nombre,:academica,:carrera,:tutor,:correo,:foto) ");
        //Se cambian los valores ocultos con los valores reales
        $stmt->bindParam(":matricula", $datosModel["matricula"] , PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":academica", $datosModel["academica"], PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_STR);
        $stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datosModel["foto"], PDO::PARAM_STR);
        //Se ejecuta la instrucción, si es exitosa lo hace saber, si no hace saber que no lo fue
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        //Se cierra la conexión
        $stmt->close();

    }

    #Mostrar usuarios
    public function mostrarUsuariosModel($tabla){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción SELECT
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla");
        //Se ejecuta la instrucción
        if($stmt -> execute())
            //Regresa los registros si se ejeuta la instrucción
            return $stmt;
        else
            //Si no, regres vacio
            return [];
        $stmt -> close();
    }

    #Mostrar un usuario
    public function unAlumnoModel($tabla, $usuario){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción SELECT
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE matricula=:matricula");
        //Se cambian los valores ocultos con los valores reales
        $stmt->bindParam(":matricula", $usuario , PDO::PARAM_STR);
        //Se ejecuta la instrucción
        $stmt -> execute();
        //Si hay registro lo regresa
        if($r = $stmt->fetch(PDO::FETCH_ASSOC))
            return $r;
        else
            //Si no, regres vacio
            return [];
        $stmt -> close();
    }

    #Editar un usuario
    public function editarAlumnoModel($datosModel,$tabla){
        //Esta comparación dice que si el nombre de la foto no tiene extensión quiere decir que no se modificó la foto
        if($datosModel["foto"] == $datosModel["matricula"]."." ){
            //Esta intrucción es por sin la foto
            //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción UPDATE
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre,academica=:academica,carrera=:carrera,tutor=:tutor,email=:email WHERE matricula=:matricula");
            //Se cambian los valores ocultos con los valores reales
            $stmt->bindParam(":matricula", $datosModel["matricula"] , PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":academica", $datosModel["academica"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_STR);
            $stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        } else{
            //Y esta es con la foto
            //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción UPDATE
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre,academica=:academica,carrera=:carrera,tutor=:tutor,email=:email,foto=:foto WHERE matricula=:matricula");
            //Se cambian los valores ocultos con los valores reales
            $stmt->bindParam(":matricula", $datosModel["matricula"] , PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":academica", $datosModel["academica"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_STR);
            $stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $stmt->bindParam(":foto", $datosModel["foto"], PDO::PARAM_STR);
        }
        //Se ejecuta la instrucción, si es exitosa lo hace saber, si no hace saber que no lo fue
        if($stmt -> execute())
            return "success";
        else
            return "error";
        $stmt -> close();
    }

    #Eliminar un usuario
    public function eliminarAlumnoModel($id, $tabla){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción DELETE
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE matricula=:id");
        //Se cambian los valores ocultos con los valores reales
        $stmt->bindParam(":id", $id , PDO::PARAM_STR);
        //Se ejecuta la instrucción, si es exitosa lo hace saber, si no hace saber que no lo fue
        if($stmt -> execute())
            return "success";
        else
            return "error";
        $stmt -> close();
    }

}