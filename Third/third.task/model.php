<?php
function invert($str = '')
{
    for ($i = 0; $i <= strlen($str) - 1; $i++) {
        for ($j = 2; $j <= strlen($str) - $i; $j++) {
            $sym = substr($str, $i, $i + $j);
            if (strripos($str, $sym) > $j){
                $s = $sym;
                continue;
            } elseif ($s != ''){
                return substr($str,0, $j) .str_replace($s, strrev($s), substr($str, $j));
            }
        }
    }
}