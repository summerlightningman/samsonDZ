<?php

include_once 'start.php';

function invert($str = '')
{
    if (preg_match("<\d+>", $str)) {
        throw new Exception('Строка должна содержать только буквы!');
    }
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
    if (count($b) % 2 != 0 && count($b) > 1) {
        throw new Exception('Массив должен иметь чётное количество цифр');
    }
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
    if (count($a, 1) == 3) {
        throw new Exception('Массив пуст');
    }
    $tab = '<table>';
    foreach ($a as $value)
        $tab .= '<tr><td>' . $value['a'] . '</td><td>' . $value['b'] . '</td></tr>';
    $tab .= '</table>';
    return $tab;
}

function sortm($a = array(array()), $key, $orientation)
{
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
        switch ($orientation) {
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

function getProds()
{
    $result = host("SELECT * FROM `products`");
    $rows = array();
    $prices = array();
    $products = array();
    if ($result)
        while ($row = mysqli_fetch_assoc($result))
            $rows[] = $row;
    else
        die('Блин опять не повезло');

    for ($i = 0; $i < count($rows); $i++) {
        $name = $rows[$i]['name'];
        $products[$i]['name'] = $name;
        $result = host("SELECT `price` FROM `prices` WHERE `name` = '$name'");
        while ($ro = mysqli_fetch_assoc($result))
            $prices[] = $ro['price'];
        $products[$i]['min_price'] = min($prices);
        $products[$i]['max_price'] = max($prices);
        $prices = array();
    }
    return $products;
}

