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

function getXmlToDB($p)
{
    foreach ($p as $q) {
        $code = $q['code'];
        $name = $q['name'];
        $b_p = (int)$q['base_price'];
        $m_p = (int)$q['moscow_price'];
        $property = (string)key($q['properties']);
        $value = (string)$q['properties']->{$property};
        $part1 = (string)$q['part']->Раздел[0];
        $part2 = $q['part']->Раздел[1] != null ? '/' . (string)$q['part']->Раздел[1] : null;

        //SQL ////// раскомментировать для заполнения БД

//        $result = host("INSERT INTO `products` (`code`, `name`) VALUES ('$code', '$name')");
//        if (!$result)
//            echo 'not inserted to products';
//        $result = host("INSERT INTO `prices` (`#`, `name`, `price_type`, `price`) VALUES (NULL, '$name','Base', '$b_p')");
//        if (!$result)
//            echo 'not inserted to prices-base';
//        $result = host("INSERT INTO `prices` (`#`, `name`, `price_type`, `price`) VALUES (NULL, '$name','Moscow', '$m_p')");
//        if (!$result)
//            echo 'not inserted to prices-moscow';
//        $result = host("INSERT INTO `properties` (`name`, `property`,`type`, `value`) VALUES ('$name', '{$property}', '', '{$value}');");
//        if (!$result)
//            echo 'not inserted to properties';
//        $result = host("INSERT INTO `rubrics` ( `code`, `name`) VALUES ('$code', '{$part1}/{$part2}')");
//        if (!$result)
//            echo 'not inserted to rubrics';
    }
}

function getXml($name = '')
{
    $products = array();
    $xml = simplexml_load_file($name);

    for ($i = 0; $i < count($xml); $i++) {
        $products[$i]['name'] = $xml->Товар[$i]->attributes()['Название'];
        $products[$i]['code'] = $xml->Товар[$i]->attributes()['Код'];
        $products[$i]['base_price'] = $xml->Товар[$i]->Цена[0];
        $products[$i]['moscow_price'] = $xml->Товар[$i]->Цена[1];
        $products[$i]['properties'] = $xml->Товар[$i]->Свойства;
        $products[$i]['part'] = $xml->Товар[$i]->Разделы;
    }
    getXmlToDB($products);
    return $products;
}

function prepareToExport()
{
    $products = array();
    $prices = array();
    $result = host("SELECT `code`,`name` FROM `products`");
    while ($row = mysqli_fetch_assoc($result))
        $prods[] = $row;
    for ($i = 0; $i < count($prods); $i++) {
        $products[$i]['code'] = $prods[$i]['code'];
        $products[$i]['name'] = $prods[$i]['name'];
        //
        $result = host("SELECT `price` FROM `prices` WHERE `name` = '{$prods[$i]['name']}'");
        while ($ro = mysqli_fetch_assoc($result))
            $prices[] = (float)$ro['price'];
        $products[$i]['min_price'] = min($prices);
        $products[$i]['max_price'] = max($prices);
        $prices = array();
        //
        $result = host("SELECT `property`,`value` FROM `properties` WHERE `name` = '{$prods[$i]['name']}'");
        while ($ro = mysqli_fetch_assoc($result))
            $props[] = $ro;
        $products[$i]['properties'] = $props;
        $props = array();
        //
        $result = host("SELECT `name` FROM `rubrics` WHERE `code` = '{$prods[$i]['code']}'");
        while ($ro = mysqli_fetch_assoc($result))
            $p[] = $ro;
        if (preg_match("</>", $p[0]['name'])) {
            $part = explode('/', $p[0]['name']);
            $products[$i]['part'] = $part;
        } else
            $products[$i]['part'] = $p[0]['name'];
        $p = array();
    }
    return $products;
}

function exportXml($products)
{
    $f = fopen('3.3.xml', 'w+');
    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<Товары>\n";
    //echo var_dump($products);
    foreach ($products as $product) {
        $xml .= "<Товар Код=\"{$product['code']}\" Название=\"{$product['name']}\">\n";
        $xml .= "<Цена Тип=\"Базовая\">{$product['base_price']}</Цена>\n";
        $xml .= "<Цена Тип=\"Москва\">{$product{'moscow_price'}}</Цена>\n";     //для большей читабельности
        $xml .= "<Свойства>\n";
        foreach ($product['properties'] as $p) {
            $xml .= "<{$p['property']}>{$p['value']}</{$p['property']}>\n";
        }
        $xml .= "</Свойства>\n";
        $xml .= "<Разделы>\n";
        if (is_array($product['part']))
            for ($i = 0; $i < count($product['part']); $i++)
                $xml .= "<Раздел>{$product['part'][$i]}</Раздел>\n";
        else
            $xml .= "<Раздел>{$product['part']}</Раздел>\n";
        $xml .= "</Разделы>\n";
        $xml .= "</Товар>\n";
    }
    $xml .= "</Товары>\n";
    fwrite($f, $xml);
    fclose($f);
    return 'completed!';
}

function goToHtml($filter = null)
{
    $parts = array();
    $result = host("SELECT `name` from `rubrics`");
    while ($row = mysqli_fetch_assoc($result)) {
        $parts[] = $row;
    }
    $parts = array_unique($parts, SORT_REGULAR);
    $j = 0;
    for ($i = 0; $i < 10; $i++)
        if (isset($parts[$i])) {
            $parts[$j] = $parts[$i];
            $j++;
        }
    $parts = array_unique($parts, SORT_REGULAR);
    for ($i = 0; $i < count($parts); $i++) {
        $result = host("SELECT `code` FROM `rubrics` WHERE `name`='{$parts[$i]['name']}'");
        while ($row = mysqli_fetch_assoc($result))
            $codes[] = (int)$row['code'];
        $parts[$i]['codes'] = $codes;
        $codes = array();
    }
    foreach ($parts as $part) {
        echo "<details><summary>{$part['name']}</summary><ul>";
        foreach ($part['codes'] as $code) {
            $result = host("SELECT `name` FROM `products` WHERE `code`='{$code}'");
            $name = mysqli_fetch_row($result);
            $result = host("SELECT `price` FROM `prices` WHERE `name`='$name[0]'");
            while ($row = mysqli_fetch_assoc($result))
                $prices[] = (float)$row['price'];
            $min_price = min($prices);
            $max_price = max($prices);
            if ($filter >= $min_price && $filter <= $max_price)
                echo "<li><details><summary>{$name[0]}</summary><p>Код: $code</p><p>Цена: {$min_price} - {$max_price}</p></details></li>";
            $prices = array();
        }
        echo '</ul></details>';
    }
}