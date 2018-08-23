<div class="content">
    <form action="index.php" method="get">
        <label>Введите значения массива через запятую без пробелов</label>
        <input type="text" name="s2" id="input" value="<?php echo $a;?>">
        <label>В порядке</label>
        <select name="s3" id="input">
            <option value="up">Возрастания</option>
            <option value="down">Убывания</option>
        </select>
        <label>Выберите столбец (ключи а/b)</label>
        <select name="s4" id="input">
            <option value="a">Левый</option>
            <option value="b">Правый</option>
        </select>
        <input type="submit" value="Сортировать">
    </form>
    <div class="result">
        <div class="result-item">
            <span>Исходный массив</span>
            <p>
                <? try {
                    echo createtab(generateArr($a));
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                ?>
            </p>
        </div>
        <div class="result-item" style="margin-left: 5%">
            <span>Отсортированный массив</span>
            <p>
                <?php
                try {
                    echo sortm(generateArr($a), $key, $orientation);
                } catch (Exception $e){
                    echo $e->getMessage();
                }
                 ?>
            </p>
        </div>
    </div>
</div>
