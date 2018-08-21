<div style="background: tomato">
    <?php
    if (isset($_FILES['file'])) {
        $errors = array();
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        if (preg_match("/php/i", $file_tmp)) {
            echo 'PHP-файлы запрещены!';
        } else {
            move_uploaded_file($file_tmp, "/uploads/" . $file_name);
            echo 'Успешно';
        };
    }
    ?>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <hr>
    <input type="submit" value="Отправить">
</form>
    <hr>
<a href="dfsfs">Вперёд, к ошибке 404</a><br>
<a href="http://img.test.local/index.php">Отправиться к img.test.local</a>