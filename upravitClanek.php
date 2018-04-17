<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smazat článek</title>
    <link rel="stylesheet" href="styly.css">
</head>
<body>

<?php
$db = mysqli_connect("localhost", "root", "", "blog");
mysqli_query($db, "SET NAMES utf8");

echo "<b> <a class='back' href='blog.php'>←zpět na výpis článků</a> </b>";

if (isset($_GET['id']))
{
    $id = (int)$_GET['id'];
    $clanek = "SELECT * FROM clanky
               LEFT JOIN autori
               ON autori.id = clanky.id_autora
               WHERE clanky.id = '$id'";
    $vysledek = mysqli_query($db, $clanek);

    $radka = mysqli_fetch_assoc($vysledek);

    ?>
    <form method="post">
        <label for="autor">Jméno:</label>
        <br>
        <input type="text" name="autor" id="autor" value="<?php echo $radka["jmeno"] ?>">
        <br>
        <label for="nadpis">Nadpis:</label>
        <br>
        <input type="text" name="nadpis" id="nadpis" value="<?php echo $radka["nadpis"] ?>">
        <br>
        <label for="obsah">Obsah:</label>
        <br>
        <textarea name="obsah" id="obsah" rows="20" cols="100"><?php echo $radka["obsah"] ?></textarea>
        <br>
        <input type="submit" name="odeslat" value="Odeslat">
    </form>
    <?php

    if (isset($_POST["odeslat"]))
    {
        $autor = $_POST["autor"];
        $nadpis = $_POST["nadpis"];
        $obsah = $_POST["obsah"];

        $upravit_clanek = "UPDATE clanky
                           LEFT JOIN autori
                           ON autori.id = clanky.id_autora
                           SET jmeno = '$autor', nadpis = '$nadpis', obsah = '$obsah'
                           WHERE clanky.id = '$id'";
        mysqli_query($db, $upravit_clanek);
        header("Location: blog.php");
    }
}

mysqli_close($db);
?>

</body>
</html>