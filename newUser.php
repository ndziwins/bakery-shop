<?php

session_start();

if (!isset($_SESSION['registrationCompleted'])) {
    header('Location: index.php');
    exit();
}
else
{
    unset($_SESSION['registrationCompleted']);
}

if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
if(isset($_SESSION['fr_regulations'])) unset($_SESSION['fr_regulations']);

if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
if(isset($_SESSION['e_pass'])) unset($_SESSION['e_pass']);
if(isset($_SESSION['e_regul'])) unset($_SESSION['e_regul']);
if(isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);

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

    echo "<p>Thank you for registration ".' [<a href="index.php">Back to main page</a>]</p>';

    ?>

</body>

</html>