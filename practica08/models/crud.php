<?php

require_once("conexion.php");

class Datos extends Conexion{
        
    #Registro de usuarios
    public function registroUsuarioModel($datosModel, $tabla){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción INSERT 
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, password, correo) VALUES(:usuario, :password, :email) ");
        //Se cambian los valores ocultos con los valores reales
        $stmt->bindParam(":usuario", $datosModel["usuario"] , PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        //entra si se ejecuta la instrucción
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        //Se cierra la conexión
        $stmt->close();

    }

    #Ingreso de un usuario (login)
    public function ingresoUsuariosModel($datosModel, $tabla){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción SELECT 
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre=:usuario");
        //Se cambian los valores ocultos con los valores reales
        $stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        //Se ejecuta la instrucción
        $stmt -> execute();
        //Si se encuentra un registro entra
        if($s = $stmt->fetch(PDO::FETCH_ASSOC)){
            //Compara contraseñas
            if($s["password"] == $datosModel["password"]){
                session_start();
                $_SESSION['usuario_id'] = (integer)$s['id'];
                $_SESSION['usuario_nombre'] = $s['nombre'];
                $_SESSION['usuario_email'] = $s['correo'];
                $_SESSION['usuario_password'] = $s['password'];
                return "success";
            }else
                return "Error: Contraseña incorrecta";
        }
        else
            return "Error: Registro no encontrado";
        //Se cierra la conexión
        $stmt -> close();
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
    public function unUsuarioModel($tabla, $usuario){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción SELECT
        $stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id=:id");
        //Se cambian los valores ocultos con los valores reales
        $stmt->bindParam(":id", $usuario , PDO::PARAM_STR);
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
    public function editarUsuarioModel($datosModel,$tabla){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción UPDATE
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET nombre=:nombre, correo=:email WHERE id=:id");
        //Se cambian los valores ocultos con los valores reales
        $stmt->bindParam(":id", $datosModel["id"] , PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datosModel["usuario"] , PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"] , PDO::PARAM_STR);
        //Se ejecuta la instrucción
        if($stmt -> execute())
            return "success";
        else
            return "error";
    }

    #Eliminar un usuario
    public function eliminarUsuarioModel($id, $tabla){
        //Se llama a la clase Conexion y al su método conectar que regresa un pdo y se prepara la instrucción DELETE
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id=:id");
        //Se cambian los valores ocultos con los valores reales
        $stmt->bindParam(":id", $id , PDO::PARAM_STR);
        //Se ejecuta la instrucción
        if($stmt -> execute())
            return "success";
        else
            return "error";
    }

}