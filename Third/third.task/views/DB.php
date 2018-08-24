<div class="content">
    <div id="part" class="part">
        <h1>Делаем SQL-запросы...</h1></div>
    <table border="1" class="tab">
        <tr><th>Наименование товара</th><th>Цена</th></tr>
        <?php
        foreach ($prods as $prod)
            echo '<tr><td>' . $prod['name'] . '</td><td>' . $prod['min_price']. ' - ' . $prod['max_price'] . '</td></tr>';
        ?>
    </table>
</div>