<div class="content">
    <div id="part" class="part">
        <h1>XML на базу</h1>
    </div>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept="application/xml"><br>
        <input type="submit" value="Отправить">
    </form>
    <details>
        <summary>Раздел</summary>
        <p>Я Дима</p>
        <p>А я нет</p>
    </details>
    <a href="/export.php">Экспорт XML</a>
    <?php getXml($fname);
    ?>
</div>

