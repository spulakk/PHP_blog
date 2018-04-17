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

if (isset($_POST['id']))
{
    $id = (int)$_POST['id'];
    $smazat_komentare = "DELETE FROM komentare WHERE id_clanku = '$id'";
    mysqli_query($db, $smazat_komentare);
    $smazat_clanek = "DELETE FROM clanky WHERE id = '$id'";
    mysqli_query($db, $smazat_clanek);
    header("Location: blog.php");
}

mysqli_close($db);
?>

</body>
</html>