<?php

session_start();

if(!isset($_SESSION['isLogged'])){
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bakery Shop</title>
</head>
<body>

<?php

echo "<p>Witaj ".$_SESSION['user'].'! [<a href="logout.php">(Logout)</a>]</p>';

?>

</body>
</html>