<?php
session_start();

if ((isset($_SESSION['isLogged'])) && ($_SESSION['isLogged'] = true)) {
    header('Location: account.php');
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

    <script type="text/javascript" src="timer.js"></script>

</head>

<body = onload="timeRefreshing();">

    <div id="clock"></div>
    <br><br>

    <a href="register.php">Register new account</a>
    <br><br>

    Panel logowania:
    <form action="login.php" method="post">
        Login:
        <br> <input type="text" name="login" /> <br>
        Password:
        <br> <input type="password" name="password" /> <br><br>
        <?php
        if (isset($_SESSION['loginError'])) {
            echo $_SESSION['loginError'];
        }
        ?>
        <br><input type="submit" value="Log in" /> <br>
    </form>

    <br><br>

    <h1>On-line order</h1>

    <form action="order.php" method="get">
        How much donuts (0,99$/pc):
        <input type="text" name="donuts" />
        <br /><br />
        How much bread (1,99$/pc):
        <input type="text" name="breads" />
        <br /><br />
        <input type="submit" value="Send order" />
    </form>

</body>

</html>