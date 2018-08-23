<div class="content">
    <form action="index.php" method="get">
    <label for="input">
        Введите строку для инверсии <br>
        <input type="text" name="s1" id="input" value="<?php echo $s1 ?>">
    </label>
    <input type="submit" value="Отправить">

    <div id="result">
        <span>Результат</span>
        <p><?php
        try {
            echo invert($s1);
        } catch (Exception $e){
            echo 'ОШИБКА!', $e->getMessage();
        }
            ?></p>
    </div>
</form>
</div>
