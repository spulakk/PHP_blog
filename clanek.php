<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clanek</title>
    <link rel="stylesheet" href="styly.css">
</head>
<body>

<b> <a class='back' href='blog.php'>←zpět na výpis článků</a> </b>

<?php
$db = mysqli_connect("localhost", "root", "", "blog");
mysqli_query($db, "SET NAMES utf8");

if (isset($_GET['id']))
{
    $id = (int)$_GET['id'];
    $clanek = "SELECT * FROM clanky
               LEFT JOIN autori
               ON autori.id = clanky.id_autora
               WHERE clanky.id = '$id'";
    $vysledek = mysqli_query($db, $clanek);

    $radka = mysqli_fetch_assoc($vysledek);
    echo "<h2>" . $radka["nadpis"] . "</h2>";
    echo "<p>" . $radka["obsah"] . "</p> <br>";
    echo "<p>Autor: " . $radka["jmeno"] . "</p>";
    echo "<p>" . $radka["datum"] . "</p>";

    echo "<hr>";

    $komentare = "SELECT * FROM komentare WHERE id_clanku = '$id'";
    $vysledek = mysqli_query($db, $komentare);

    while ($radka = mysqli_fetch_assoc($vysledek))
    {
        echo "<b> <p>" . $radka["autor"] . ": </p> </b>";
        echo "<p>" . $radka["obsah"] . "</p> <br>";
    }
    ?>

    <b> <p>Napište nám!</p> </b>
    <form method="post">
        <label for="autor">Jméno:</label>
        <br>
        <input type="text" name="autor" id="autor">
        <br>
        <label for="obsah">Obsah:</label>
        <br>
        <textarea name="obsah" id="obsah"></textarea>
        <br>
        <input type="submit" name="odeslat" value="Odeslat">
    </form>

    <?php
    if (isset($_POST["odeslat"]))
    {
        $autor = $_POST["autor"];
        $obsah = $_POST["obsah"];

        $vlozit = "INSERT INTO komentare (id, id_clanku, autor, obsah) VALUES (NULL, '$id', '$autor', '$obsah')";
        mysqli_query($db, $vlozit);
        header("Refresh:0");
    }
}

mysqli_close($db);
?>

</body>
</html>