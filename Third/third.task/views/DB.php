<div class="content">
    <div id="part" class="part">
        <h1>Делаем SQL-запросы...</h1></div>
    <form>
        <input type="text" name="query" value="<?php echo $name; ?>">
        <input type="submit" value="Поиск">
    </form>
    <a href="/"><button>Очистить</button></a>
    <table border="1" class="tab">
        <tr>
            <th>Наименование товара</th>
            <th>Цена</th>
        </tr>
        <?php
        if ($name != '') {
            foreach ($prods as $prod)
                if ($prod['name'] == $name) {
                    echo '<tr><td>' . $prod['name'] . '</td><td>' . $prod['min_price'] . ' - ' . $prod['max_price'] . '</td></tr>';
                    break;
                }
        } else
            foreach ($prods as $prod)
                echo '<tr><td>' . $prod['name'] . '</td><td>' . $prod['min_price'] . ' - ' . $prod['max_price'] . '</td></tr>';
        ?>
    </table>
</div>