<?php
function invert($str = '')
{
    for ($i = 0; $i <= strlen($str) - 1; $i++) {
        $s = '';
        for ($j = 2; $j <= strlen($str) - $i; $j++) {
            $sym = substr($str, $i, $i + $j);
            if (strripos($str, $sym) > $j) {
                $s = $sym;
                continue;
            } elseif ($s != '') {
                return substr($str, 0, $j) . str_replace($s, strrev($s), substr($str, $j));
            }
        }
    }
}

function generateArr($b)
{
    $a = array();
    $b = explode(',', $b);
    if (count($b) % 2 != 0 && count($b) != 1)
        die ('Введите чётное количество цифр');
    $j = 0;
    for ($i = 0; $i < count($b) / 2; $i++) {
        $a[$i]['a'] = (int)$b[$j];
        $a[$i]['b'] = (int)$b[$j + 1];
        $j += 2;
    }
    return $a;
}

function createtab($a = array())
{
    $tab = '<table>';
    foreach ($a as $value)
        $tab .= '<tr><td>' . $value['a'] . '</td><td>' . $value['b'] . '</td></tr>';
    $tab .= '</table>';
    return $tab;
}

function sortm($a = array(array()), $key, $orientation)
{
    $n = 0;
    start:
    for ($i = 0; $i < count($a) - 1; $i++) {
        switch ($orientation) {
            case 'up':
                if ($a[$i][$key] > $a[$i + 1][$key]) {
                    $n = $a[$i]['a'];
                    $a[$i]['a'] = $a[$i + 1]['a'];
                    $a[$i + 1]['a'] = $n;
                    /* ***************** */
                    $n = $a[$i]['b'];
                    $a[$i]['b'] = $a[$i + 1]['b'];
                    $a[$i + 1]['b'] = $n;
                }
                break;
            case 'down':
                if ($a[$i][$key] < $a[$i + 1][$key]) {
                    $n = $a[$i]['a'];
                    $a[$i]['a'] = $a[$i + 1]['a'];
                    $a[$i + 1]['a'] = $n;
                    /* ***************** */
                    $n = $a[$i]['b'];
                    $a[$i]['b'] = $a[$i + 1]['b'];
                    $a[$i + 1]['b'] = $n;
                }
                break;
        }
    }
    for ($i = 0; $i < count($a) - 1; $i++)  // проверка на возможный повтор сортировки
        switch ($orientation){
            case 'up':
                if ($a[$i][$key] > $a[$i + 1][$key])
                    goto start;
                break;
            case 'down':
                if ($a[$i][$key] < $a[$i + 1][$key])
                    goto start;
                break;
        }
    return createtab($a);
}

