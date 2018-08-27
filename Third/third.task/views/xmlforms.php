<div class="content">
    <div id="part" class="part">
        <h1>XML на базу</h1>
    </div>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept="application/xml"><br>
        <input type="submit" value="Отправить">
    </form>
    <hr>
    <a href="/export.php">Экспорт XML</a>
    <hr>
    <form method="get" action="index.php">
        <label>Ценовой фильтр <input type="number" value="<?php $_GET['filter'] ?>" name="filter"></label>
        <input type="submit" value="Фильтр">
    </form>
    <?php if ($fname != null) getXml($fname);
    $filter = isset($_GET['filter']) ? $_GET['filter'] : null;
    goToHtml($filter);
    ?>
</div>

