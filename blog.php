<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="styly.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>
<body>

<h1>PHP Blog</h1>

<?php
$db = mysqli_connect("localhost", "root", "", "blog");
mysqli_query($db, "SET NAMES utf8");
$clanky = "SELECT clanky.id, clanky.nadpis, clanky.datum, autori.jmeno FROM clanky 
           LEFT JOIN autori 
           ON autori.id = clanky.id_autora";
$vysledek = mysqli_query($db, $clanky);

while ($radka = mysqli_fetch_assoc($vysledek))
{
    $id = $radka["id"];
    echo "<h3> <a href='clanek.php?id=" . $id . "'>" . $radka["nadpis"] . "</a> </h3>";
    echo "<form method='post' action='smazatClanek.php'>
          <button type='submit' name='id' value='$id'> <i class='fa fa-trash'> </i> </button>
          </form>";
    echo "<form method='get' action='upravitClanek.php'>
          <button type='submit' name='id' value='$id'> <i class='fa fa-edit'> </i> </button>
          </form>";
    echo "<p>Autor: " . $radka["jmeno"] . "</p>";
    echo "<p>" . $radka["datum"] . "</p> <hr>";
}
?>

<form method='post' action='novyClanek.php'>
    <input type="submit" name="pridat" value="Přidat článek">
</form>

<?php
mysqli_close($db);
?>

</body>
</html>