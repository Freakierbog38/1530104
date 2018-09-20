<?php
    session_start();
    session_unset();
    session_destroy();

    require_once("db/database_utilities.php");

    $usuario = filter_input(INPUT_POST, 'usuario');
    $contrasena = filter_input(INPUT_POST, 'contrasena');

    echo ("<script>console.log( '" . $usuario . "' );</script>");
    echo ("<script>console.log( '" . $contrasena . "' );</script>");

    if($usuario === false || $usuario === NULL || $usuario === ''
        || $contrasena === false || $contrasena === NULL || $contrasena === ''){
        header('Location: login.html');
        exit();
    }

    $db = getPDO();
    $stmt = $db->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->bindParam(':email', $usuario);
    $stmt->execute();
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    echo ("<script>console.log( '" . $stmt->rowCount() . "' );</script>");
    if($r){
        if($r['password'] === $contrasena){
            session_start();
            $_SESSION['usuario_id'] = (integer)$r['id'];
            $_SESSION['usuario_email'] = $r['email'];
            $_SESSION['usuario_status'] = (integer)$r['status_id'];
            $_SESSION['usuario_type'] = (integer)$r['user_type_id'];
            addLog($r['id']);
            header('Location: index.php');
            exit();
        }
    }
    //header('Location: login.html');
?>