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
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="timer.js"></script>

    <script type="text/javascript">
        var number = Math.floor(Math.random() * 5) + 1;
        var timer1 = 0;
        var timer2 = 0;

        function setSlide(slideNo) {
            clearTimeout(timer1);
            clearTimeout(timer2);
            number = slideNo - 1;

            fade();
            setTimeout("changeSlide()", 500);

        }

        function fade() {
            $("#slider").fadeOut(500);
        }

        function changeSlide() {
            number++;
            if (number > 5) number = 1;

            var file = "<img src=\"slides/slide" + number + ".jpg\" />";
            document.getElementById("slider").innerHTML = file;

            $("#slider").fadeIn(500);

            timer1 = setTimeout("changeSlide()", 4000);
            timer2 = setTimeout("fade()", 3500);
        }
    </script>

</head>

<body onload="timeRefreshing(); changeSlide();">

    <div id="clock"></div>
    <br><br>

    <div id="slider"></div>
    <span onclick="setSlide(1)" style="cursor:pointer;">[ 1 ]</span>
    <span onclick="setSlide(2)" style="cursor:pointer;">[ 2 ]</span>
    <span onclick="setSlide(3)" style="cursor:pointer;">[ 3 ]</span>
    <span onclick="setSlide(4)" style="cursor:pointer;">[ 4 ]</span>
    <span onclick="setSlide(5)" style="cursor:pointer;">[ 5 ]</span>

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