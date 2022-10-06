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
//variable turno, 0 = jugador x y 1 =jugador o
$turno = 0;
$ganador = false;
$contador = 0;
//simplemente imprime el tablero
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

function elegirCasilla()
{
    global $turno, $tablero, $contador;
    //jugador X
    if ($turno == 0) {
        echo "Turno del jugador X: \n";
        $fila = readline("Introduce la fila: ");
        $columna = readline("Introduce la columna: ");
        //comprueba que la fila y la columa sea entre 1 y 3 y que sea un numero
        if ($fila < 1 || $fila > 3 || $columna < 1 || $columna > 3 || is_numeric($fila) == false || is_numeric($columna) == false) {
            echo "error, alguno de los parametros es menor que 1 o menor que 3 o no son un número\n";
        } else {
            //comprueba que la celda no esté ocupada por otra ficha
            if ($tablero[$fila][$columna] == "X" || $tablero[$fila][$columna] == "O") {
                echo "La casilla ya esta ocupada, elige de nuevo.\n";
            } else {
                //El valor de la celda pasa a ser X
                $tablero[$fila][$columna] = "X";
                //Cambia el turno del jugador
                $turno = 1;
                $contador++;
                imprimirTablero();
                comprobarVictoria();
            }
        }
        //jugador O

    } else {
        echo "Turno del jugador O: \n";
        $fila = readline("Introduce la fila: ");
        $columna = readline("Introduce la columna: ");
        //comprueba que la fila y la columa sea entre 1 y 3 y que sea un numero
        if ($fila < 1 || $fila > 3 || $columna < 1 || $columna > 3 || is_numeric($fila) == false || is_numeric($columna) == false) {
            echo "error, alguno de los parametros es menor que 1 o menor que 3 o no son un número\n";
        } else {
            //comprueba que la celda no esté ocupada por otra ficha
            if ($tablero[$fila][$columna] == "X" || $tablero[$fila][$columna] == "O") {
                echo "La casilla Oa esta ocupada, elige de nuevo.\n";
            } else {
                //el valor de la celda pasa a ser O
                $tablero[$fila][$columna] = "O";
                //cambia el turno del jugador
                $turno = 0;
                $contador++;
                imprimirTablero();
                comprobarVictoria();
            }
        }
    }
}
function comprobarVictoria()
{
    global $tablero, $ganador, $contador;
    //todas las posibilidades de victoria de cada jugador - | / \
    if (
        $tablero[1][1] == "X" && $tablero[1][2] == "X" && $tablero[1][3] == "X" ||
        $tablero[1][1] == "X" && $tablero[2][1] == "X" && $tablero[3][1] == "X" ||
        $tablero[1][3] == "X" && $tablero[2][3] == "X" && $tablero[3][3] == "X" ||
        $tablero[3][1] == "X" && $tablero[3][2] == "X" && $tablero[3][3] == "X" ||
        $tablero[2][1] == "X" && $tablero[2][2] == "X" && $tablero[3][2] == "X" ||
        $tablero[1][2] == "X" && $tablero[2][2] == "X" && $tablero[3][2] == "X" ||
        $tablero[1][1] == "X" && $tablero[2][2] == "X" && $tablero[3][3] == "X" ||
        $tablero[3][1] == "X" && $tablero[2][2] == "X" && $tablero[1][3] == "X"
    ) {
        //ganador pasa a ser true para que el juego termine
        $ganador = true;
        echo "La victoria es del jugador X";
    } else if (
        $tablero[1][1] == "O" && $tablero[1][2] == "O" && $tablero[1][3] == "O" ||
        $tablero[1][1] == "O" && $tablero[2][1] == "O" && $tablero[3][1] == "O" ||
        $tablero[1][3] == "O" && $tablero[2][3] == "O" && $tablero[3][3] == "O" ||
        $tablero[3][1] == "O" && $tablero[3][2] == "O" && $tablero[3][3] == "O" ||
        $tablero[2][1] == "O" && $tablero[2][2] == "O" && $tablero[3][2] == "O" ||
        $tablero[1][2] == "O" && $tablero[2][2] == "O" && $tablero[3][2] == "O" ||
        $tablero[1][1] == "O" && $tablero[2][2] == "O" && $tablero[3][3] == "O" ||
        $tablero[3][1] == "O" && $tablero[2][2] == "O" && $tablero[1][3] == "O"
    ) {
        //ganador pasa a ser true para que el juego termine
        $ganador = true;
        echo "La victoria es del jugador O";
    }else if ($contador==9){
        //cuando el contador llega a nueve quiere decir que no quedan celdas disponibles, por lo que es empate
        $ganador = true;
        echo "No quedan celdas, la partida acaba en empate";
    }
}


//imprime el tablero por primera vez
imprimirTablero();
//hasta que no haOa un ganador no acaba el juego.
while ($ganador == false) {
    elegirCasilla();
}
