<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Второе задание</title>
</head>
<body>
<style>
    span {
        position: relative;
        left: 35%;
        background: white;
        width: 30%;
        text-align: center;
        display: block;
        font-family: "Century Gothic", sans-serif;
        font-size: 2rem;
    }

    hr {
        margin-top: -1.25rem;
    }

    p {
        margin-top: 1rem;
    }

    table {
        border-collapse: collapse;
        text-align: center;
        box-shadow: 5px 5px 20px 2px black;
    }
</style>
<div>
    <span>Первое задание</span>
    <hr>
</div>
<p>Посчитать количество простых чисел в диапазоне от 10 до 53. </p><br>
<h2>Простые числа:</h2>
<ul>
    <?php
    for ($i = 10; $i <= 53; $i++) {
        $n = 0;
        for ($j = 1; $j <= $i; $j++) {
            if ($i % $j == 0) {
                $n++;
            }
            if ($n >= 2)
                continue;
        }
        if ($n == 2)
            echo "<li>$i</li>";
    }
    ?></ul>

<!--___________________________________________________________-->

<div>
    <span>Второе задание</span>
    <hr>
</div>
<p>Создать массив, состоящий из массивов по 3 простых числа [[a=>11,b=>13,с=>17],[a=>19,b=>23…]…]</p>
<table border="1" cellpadding="5">
    <tr>
        <?php
        $a = array(array());
        $k = 0;         //для проверки индекса
        $l = 0;         //для проверки индекса(ключа)
        for ($i = 10; $i <= 100; $i++) {
            $n = 0;     //счётчик делителей
            for ($j = 1; $j <= $i; $j++) {
                if ($i % $j == 0) {
                    $n++;
                }
                if ($n >= 2)
                    continue;
            }
            if ($n == 2) {
                switch ($l) {
                    case 0:
                        $a[$k]['a'] = $i;
                        echo '<td>' . $a[$k]['a'] . '</td>';
                        break;
                    case 1:
                        $a[$k]['b'] = $i;
                        echo '<td>' . $a[$k]['b'] . '</td>';
                        break;
                    case 2:
                        $a[$k]['c'] = $i;
                        echo '<td>' . $a[$k]['c'] . '</td>';
                        break;
                }
                $l++;
            }
            if ($l == 3) {
                echo '</tr><tr>';
                $k++;
                $l = 0;
            }
        }
        ?>
    </tr>
</table>

<!--___________________________________________________________-->

<div>
    <span>Третье задание</span>
    <hr>
</div>
<p>Для полученного массива посчитать площади трапеций по 3 величинам (предыдущий массив a, b и высота с) и дописать
    значение в массиве с ключом «s».</p>
<h2>Площади трапеций</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>S</th>
    </tr>
    <?php
    for ($i = 0; $i <= $k - 1; $i++) {
        echo '<tr>';
        for ($j = 0; $j <= 3; $j++) {
            switch ($j) {
                case 0:
                    echo '<td>' . $a[$i]['a'] . '</td>';
                    break;
                case 1:
                    echo '<td>' . $a[$i]['b'] . '</td>';
                    break;
                case 2:
                    echo '<td>' . $a[$i]['c'] . '</td>';
                    break;
                case 3:
                    $a[$i]['s'] = 0.5 * ($a[$i]['a'] + $a[$i]['b']) * $a[$i]['c'];
                    echo '<td>' . $a[$i]['s'] . '</td>';
                    break;
            }
        }
        echo '</tr>';
    }
    ?></table>

<!--___________________________________________________________-->

<div>
    <span>Четвёртое задание</span>
    <hr>
</div>
<p>Вывести размеры трапеции, у которой максимальная площадь, но не больше 1400 (do{}while();).</p>
<table border="1" cellpadding="5">
    <tr>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>S</th>
    </tr>
    <?php
    $i = 0;
    do {
        echo '<tr><td>' . $a[$i]['a'] . '</td><td>' . $a[$i]['b'] . '</td><td>' . $a[$i]['c'] . '</td><td>' . $a[$i]['s'] . '</td></tr>';
        $i++;
    } while ($a[$i]['s'] < 1400);
    ?>
</table>

<!--___________________________________________________________-->

<div>
    <span>Пятое задание</span>
    <hr>
</div>
<p>Написать функцию возведения в степень.</p>
<?php
function pover($number, $power)
{
    if ($power > 1)
        $number *= pover($number, $power - 1);
    return $number;
}

// Функция возведения в степень в действии
echo '<p>2<sup>10</sup> =' . pover(2, 10) . '</p>
<p>3<sup>5</sup> = ' . pover(3, 5) . '</p>';
?>

<!--___________________________________________________________-->

<div>
    <span>Шестое задание</span>
    <hr>
</div>
<p>Написать функцию определения минимального числа в массиве.</p>
<?php
function minValue($array = array())
{
    $min = array_shift($array);
    foreach ($array as $v)
        if ($v < $min)
            $min = $v;
    return $min;
}

$b = array();
echo '<h2>Массив: ';
for ($i = 0; $i <= 9; $i++) {
    $b[$i] = rand(0, 100);
    echo $b[$i] . ' ';
}
echo '</h2>';
echo '<h3>Минимальное значение массива: ' . minValue($b) . '</h3>';
?>

<!--___________________________________________________________-->

<div>
    <span>Седьмое задание</span>
    <hr>
</div>
<p>Написать функцию расчета по формуле f=(a*b^c+(((a/c)^b)%3)^min(a,b,c)) используя написанные ранее функции.</p>
<h2>f(a, b, c) = a &bull; b<sup>c</sup>+(( a/c )<sup>b</sup> % 3)<sup>min(a,b,c)</sup></h2>
<h3>Значение функции f(3,9,5) =
    <?php
    function f($a = 0, $b = 0, $c = 0)
    {
        return $a * pover($b, $c) + (pover((pover(($a / $c), $b) % 3), minValue(array($a, $b, $c))));
    }

    echo f(3, 9, 5);
    ?></h3>

<!--___________________________________________________________-->

<div>
    <span>Восьмое задание</span>
    <hr>
</div>
<p>Посчитать по данной формуле ранее посчитанные массивы.</p>
<table border="1" cellpadding="5">
    <tr>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>f(a, b, c)</th>
    </tr>
    <?php
    for ($i = 0; $i <= count($a) - 1; $i++)
        echo '<tr>
<td>' . $a[$i]['a'] . '</td>
<td>' . $a[$i]['b'] . '</td>
<td>' . $a[$i]['c'] . '</td>
<td>' . f($a[$i]['a'], $a[$i]['b'], $a[$i]['c']) . '</td>
</tr>';
    ?>
</table>

<!--___________________________________________________________-->

<div>
    <span>Девятое задание</span>
    <hr>
</div>
<p>Циклом, используя ссылки, отметить все трапеции, чья площадь нечетное значение.</p>
<h2>Трапеции с нечётными площадями:</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>S</th>
    </tr>
    <?php
    $s = array();
    foreach ($a as $trap)
        if ($trap['s'] % 2 == 1) {
            echo '<tr>';
            $s =& $trap;
            foreach ($s as &$g)
                echo "<td>$g</td>";
            echo '</tr>';
        }
    ?></table>

<!--___________________________________________________________-->

<div>
    <span>Десятое задание</span>
    <hr>
</div>
<p>Вывести результат в виде таблицы: a, b, c, s, f, нечетный.</p>
<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>s</th>
        <th>f</th>
        <th>Нечётный</th>
    </tr>
    <?php
    for ($i = 0; $i <= count($a) - 1; $i++) {
        $a[$i]['f'] = f($a[$i]['a'], $a[$i]['b'], $a[$i]['c']);
        $a[$i]['n'] = $a[$i]['s'] % 2 == 1 ? 'да' : 'нет';
    }

    foreach ($a as $v) {
        echo '<tr>';
        foreach ($v as $item)
            echo "<td>$item</td>";
        echo '</tr>';
    }
    ?>
</table>
</body>
</html>