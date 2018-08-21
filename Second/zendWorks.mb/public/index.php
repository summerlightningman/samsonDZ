<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZendWorks!</title>
</head>
<body>

</body>
</html>
<?php
use Zend\View\Model\NoBorderModel;
use Zend\View\Model\BorderModel;

$wb = new NoBorderModel();
$bt = new BorderModel();
$wb->drawTable(array(1,2,3,4,5,6,7),3);