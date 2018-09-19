<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Práctica 3</title>
</head>
<body>
<?php

/* Clase que representa un oobjeto en le que se encuentran dos array
numericos de dimension 25, en los cuales uno tiene valores almacenados 
y el otro genera la serie fibonacci*/

class array_num{
    public $array; //Original
    public $ar_fibonacci; //Con serie

    //Constructor que inicializa los arreglos
    function __construct(){
        $this->array = array(0,1,1,3,5,2,7,1,34,6,64,2,13,6,74,2,31,231,3,2,61,21,3,123,53,2331);
        $this->ar_fibonacci = [];
        for($i=0;$i<25;$i++){
            $this->ar_fibonacci[$i] = 0;
        }
    }

    // Funcion que permite generar la serie fibonacci con base en los valores del primer array
    function fibonacci(){
        $this->ar_fibonacci = [];
        $this->ar_fibonacci[0] = $this->array[0];
        $this->ar_fibonacci[1] = $this->array[1];
        for($i=2;$i<25;$i++){
            $this->ar_fibonacci[$i] = $this->ar_fibonacci[$i-1] + $this->ar_fibonacci[$i-2];
        }
    }

    //Funcion que imprime los dos array
    function imprimir(){
        echo "<br> <strong>Array sin modificar:</strong> <br><br>";
        for($i=2;$i<25;$i++){
            if($i<24){
                echo($this->array[$i] . ", ");
            }
            else{
                echo($this->array[$i] . ".<br><br>");
            }
        }

        echo "<br> <strong>Array con serie Fibonacci:</strong> <br><br>";
        for($i=2;$i<25;$i++){
            if($i<24){
                echo($this->ar_fibonacci[$i] . ", ");
            }
            else{
                echo($this->ar_fibonacci[$i] . ".<br><br>");
            }
        }
    }
}

//Nuevo objeto tipo array_num representa los dos arreglos:
$fib = new array_num();

//Generar serie fibonacci
$fib->fibonacci();

//imprimir arreglos
$fib->imprimir();

?>    
</body>
</html>