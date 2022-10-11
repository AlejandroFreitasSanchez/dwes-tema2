<?php

//array del tablero
$tablero = array(
    1 => array(
        1 => "-",
        2 => "-",
        3 => "-",
    ),
    2 => array(
        1 => "-",
        2 => "-",
        3 => "-",
    ),
    3 => array(
        1 => "-",
        2 => "-",
        3 => "-",
    ),
);

//variables
$turno = 0;
$ganador = false;
$contador = 1;
$letraJugador = "X";

/*Esta función simplemente imprime el tablero */
function imprimirTablero()
{
    global $tablero;
    echo "+-----+-----+-----+\n";
    echo "|  {$tablero[1][1]}  |  {$tablero[1][2]}  |  {$tablero[1][3]}  |\n";
    echo "+-----+-----+-----+\n";
    echo "|  {$tablero[2][1]}  |  {$tablero[2][2]}  |  {$tablero[2][3]}  |\n";
    echo "+-----+-----+-----+\n";
    echo "|  {$tablero[3][1]}  |  {$tablero[3][2]}  |  {$tablero[3][3]}  |\n";
    echo "+-----+-----+-----+\n";
}
/*
    *Esta función comprueba si la fila y la columna introducidas son validas,
    *teniendo en cuenta si son numeros, que sean mayores a 1 y menores a 3(las medidas del tablero),
    *o si ya estan ocupadas.
    *Devuelve un booleano.
*/
function casillaValida($fila, $columna)
{
    global $tablero;
    $error = false;
    //si no son numeros
    if (is_numeric($fila) == false || is_numeric($columna) == false) {
        $error = true;
        echo "errorm alguno de los parametros  no son un número\n";
    //si son menores que 3 y mayores que 1
    } else if ($fila < 1 || $fila > 3 || $columna < 1 || $columna > 3) {
        $error = true;
        echo "error, alguno de los parametros es menor que 1 o menor que 3\n";
    //si no estan ocupadas
    } else if ($tablero[$fila][$columna] == "X" || $tablero[$fila][$columna] == "O") {
        $error = true;
        echo "La casilla ya esta ocupada, elige de nuevo.\n";
    }
    return $error;
}
/*
    *Esta función permite elegir la casilla del tablero en la que queremos colocar la ficha.
    *Si la funcion casillaValida da false, introduce la ficha en la casilla elegida.
*/
function elegirCasilla()
{
    global $tablero, $contador, $letraJugador;
    echo "Turno del jugador $letraJugador: \n";
    //introducir la fila y columna
    $fila = readline("Introduce la fila: ");
    $columna = readline("Introduce la columna: ");
    if (casillaValida($fila, $columna) == false) {
        //El valor de la celda pasa a ser la letra del jugador
        $tablero[$fila][$columna] = "$letraJugador";
        //Cambia el turno del jugador
        comprobarVictoria();
        $contador++;
        //cambia el jugador
        cambioJugador();
        imprimirTablero();
    }
}
/*
    *Esta funcion permite el cambio de jugador si el turno es 0, el siguiente turno sera 1, con su respectiva letra,
    * si es 0 al contrario, será 1.
*/
function cambioJugador()
{
    global $turno, $letraJugador;
    if ($turno == 0) {
        $turno = 1;
        $letraJugador = "O";
    } else {
        $turno = 0;
        $letraJugador = "X";
    }
}
/*
    *Esta funcion permite saber si un jugador ha ganado comprobando todas las posibles combinaciones
    *ganadoras de fichas.
    *Si ningun jugador consigue ganar la partida termina en empate usando la variable $contador al llegar a 9.
*/
function comprobarVictoria()
{
    global $tablero, $ganador, $contador, $letraJugador;
    //todas las posibilidades de victoria de cada jugador - | / \
    if (
        //arriva horizontal
        $tablero[1][1] == "$letraJugador" && $tablero[1][2] == "$letraJugador" && $tablero[1][3] == "$letraJugador" ||
        //izquierda vertical
        $tablero[1][1] == "$letraJugador" && $tablero[2][1] == "$letraJugador" && $tablero[3][1] == "$letraJugador" ||
        //derecha vertical
        $tablero[1][3] == "$letraJugador" && $tablero[2][3] == "$letraJugador" && $tablero[3][3] == "$letraJugador" ||
        //abajo horizontal
        $tablero[3][1] == "$letraJugador" && $tablero[3][2] == "$letraJugador" && $tablero[3][3] == "$letraJugador" ||
        //centro horizontal
        $tablero[2][1] == "$letraJugador" && $tablero[2][2] == "$letraJugador" && $tablero[2][3] == "$letraJugador" ||
        //centro vertical
        $tablero[1][2] == "$letraJugador" && $tablero[2][2] == "$letraJugador" && $tablero[3][2] == "$letraJugador" ||
        ////diagonal
        $tablero[1][1] == "$letraJugador" && $tablero[2][2] == "$letraJugador" && $tablero[3][3] == "$letraJugador" ||
        //diagonal
        $tablero[3][1] == "$letraJugador" && $tablero[2][2] == "$letraJugador" && $tablero[1][3] == "$letraJugador"
    ) {
        //ganador pasa a ser true para que el juego termine
        $ganador = true;
        echo "La victoria es del jugador $letraJugador\n";
    } else if ($contador == 9) {
        //cuando el contador llega a nueve quiere decir que no quedan celdas disponibles, por lo que es empate
        $ganador = true;
        echo "No quedan celdas, la partida acaba en empate\n";
    }
}


//imprime el tablero por primera vez
imprimirTablero();
//hasta que no haOa un ganador no acaba el juego.
while ($ganador == false) {
    elegirCasilla();
}
