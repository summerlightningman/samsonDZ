<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 25.08.2018
 * Time: 10:00
 */

if (isset($_FILES['file'])){
    $fname = $_FILES['file']['name'];
}


include 'views/xmlforms.php';