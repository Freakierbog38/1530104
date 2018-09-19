<?php
    // Autor: Miguel Angel Ruiz García

    // Desarrollar un Script en PHP o JavaScript estructurada , en donde utilizando un array asosiativo se guarde Persona1: Nombre. Persona1: Nombre y apellido. Persona2:Nombre y apellido de la persona1.
    // En otro array numerico almacenar 6 numeros enteros positivos (validarlos), y que imprima el que tenga el valor de 4.

    $nombre = "Ruiz Garcia"; //Variable que almacena un nombre
    $apellido = "Miguel Angel"; // Variable que guarda apellido

    $array = array( //Array asociativo, en vez de regirse por los indices numericos es por clave
        'Persona1' => $nombre, // Persona1 va a guardar el nombre
        'Persona1' => $apellido . " " . $nombre, // Persona1 guardará nombre y apellido,
        //como ya existe una clave del mismo nombre entonces esta será sobre escrita
        'Persona2' => $apellido . " " . $nombre // Persona2 guardará el nombre y apellido que se guardaron en Persona1
    );

    var_dump($array); //Imprime la información del array asociativo
    echo "\n"; //Salto de linea
    echo "Persona1: " . $array["Persona1"]; //Imprime contenido del array en la posición con la clave Persona1
    echo "\n"; //Salto de linea
    echo  "Persona2: " . $array["Persona2"]; //Imprime contenido del array en la posición con la clave Persona2
    echo "\n"; //Salto de linea

    $ar_num = [6]; //Se crea un array de 6 posiciones

    for($i = 0; $i<6; $i++){ // Ciclo para llenar el array
        $num = rand(-10, 10); // Con numeros aleatorios del -10 a 10
        if( $num > 0 && is_int($num)) // unicamente aceptando los positivos enteros
            $ar_num[$i] = $num;
        else // Si no es positivo el numero dado, se vuelve a intentar
            $i--;
    }
    echo 'Los cuatros contenidos en el array numerico:';
    foreach( $ar_num as $num){ // Se recorre el array
        if($num == 4){ // Para imprimir los que tienen el valor de 4
            echo $num;
            echo " ";
        }
    }
?>