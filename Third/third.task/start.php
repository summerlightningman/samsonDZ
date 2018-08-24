<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 24.08.2018
 * Time: 17:36
 */
function host($query = ''){
    $connection = mysqli_connect('127.0.0.1', 'root', '', 'test_rubric') or die('Не удалось соединиться с сервером');
    $result = mysqli_query($connection, $query);
    return $result;
}