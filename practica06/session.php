<?php

    session_start();

    if(! $_SESSION['usuario_id'] ){
        //echo $_SESSION['usuario_id'];
        header('Location: login.html');
        exit();
    }

?>