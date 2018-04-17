<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nový článek</title>
    <link rel="stylesheet" href="styly.css">
</head>
<body>

<b> <a class='back' href='blog.php'>←zpět na výpis článků</a> </b>

<br><br>

<form method="post">
    <label for="autor">Jméno:</label>
    <br>
    <input type="text" name="autor" id="autor">
    <br>
    <label for="nadpis">Nadpis:</label>
    <br>
    <input type="text" name="nadpis" id="nadpis">
    <br>
    <label for="obsah">Obsah:</label>
    <br>
    <textarea name="obsah" id="obsah"></textarea>
    <br>
    <input type="submit" name="odeslat" value="Odeslat">
</form>

<?php
$db = mysqli_connect("localhost", "root", "", "blog");
mysqli_query($db, "SET NAMES utf8");

if (isset($_POST['odeslat']))
{
    $autor = $_POST["autor"];
    $nadpis = $_POST["nadpis"];
    $obsah = $_POST["obsah"];

    $autor_exists = "SELECT jmeno FROM autori WHERE jmeno = '$autor'";
    $vysledek = mysqli_query($db, $autor_exists);
    $nalezeno = mysqli_num_rows($vysledek);
    if ($nalezeno == 0)
    {
        $vlozit_autora = "INSERT INTO autori (id, jmeno) VALUES (NULL, '$autor')";
        mysqli_query($db, $vlozit_autora);
    }
    $vlozit_clanek = "INSERT INTO clanky (id, nadpis, obsah, datum, id_autora) VALUES (NULL, '$nadpis', '$obsah', CURRENT_TIMESTAMP, (SELECT id FROM autori WHERE jmeno = '$autor'))";
    mysqli_query($db, $vlozit_clanek);
    header("Location: blog.php");
}

mysqli_close($db);
?>

</body>
</html>