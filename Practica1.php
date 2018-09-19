<?php

    //Ejercicios:

    //1. Ordenar un array ascendente y descendente.
    //2. Hacer un programa en PHP que escriba tu nombre (en negrita) y la ciudad dónde naciste.
    //3. Llenar un array de 10 posiciones e imprimirlos en un ciclo for.

    /////////////EJERCICIO 1///////////////////////////////
    $array = [10]; //Se crea el array
    
    for($i = 0; $i<10; $i++){ //Se usa un for para recorrer un array de 10 posiciones
        $array[$i] = rand(0, 50); //Cada posicion se llena con un numero aleatorio entre el 0 y 50
    }

    echo "<br><br> Practica 01<br>";
    echo "<br>";
    echo "Ejecicio 1<br>";
    echo "<br>";
    echo "Array:<br>";

    print_r($array);//El array anterior entra en esta funcion que imprime la información de un array

    echo "<br><br>";
    echo "Ascendente:<br>";
    asort($array); //Esta funcion ordena un array de forma ascendente
    print_r($array);//Se imprime la información de array ordenado
    
    echo "<br><br>";
    echo "Descendente:<br>";

    rsort($array);//Ordena el array de forma descendente
    print_r($array);//Se imprime la infromación de array otra vez
    
    echo "<br><br>";

    /////////////EJERCICIO 2///////////////////////////////
    
    echo "Ejercicio 2: <br><br>";

    $nombre = "<b>Miguel Angel Ruiz Garcia</b>";//Una variable que guarda el nombre en negritas

    echo "Soy " . $nombre . " y naci en Cd. Mante.";//Se imprime con echo concatenando el nombre

    echo "<br><br>";//Cada <br> es un salto de linea

    /////////////EJERCICIO 3///////////////////////////////

    echo "Ejercicio 3: <br><br>";

    echo "Array con for: <br>";

    for($i = 0; $i<10; $i++){//El array de inicio se imprime nuevamente
        echo "array[" . $i . "] = " . $array[$i];// Pero con un ciclo for
        echo "<br>";
    }

?>