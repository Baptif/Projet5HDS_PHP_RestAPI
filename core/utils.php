<?php


function randomToken($car) {
    $string = "";
    $chaine ="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";

    srand ( ( double ) microtime () * 1000000 );

    for($i = 0; $i < $car; $i ++) {
        $string .= $chaine [rand () % strlen ( $chaine )];
    }

    return $string;
}
    









?>