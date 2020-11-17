<?php
session_start();

if ((isset($_SESSION['isLogged'])) && ($_SESSION['isLogged'] = true))
{
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
    <title>Register new account</title>
</head>
<body>

<form method="post">
email: <br><input type="text" name="email"/> <br>
password: <br><input type="password" name="password1"/> <br>
repeat password: <br><input type="password" name="password2"/> <br>
<label><input type="checkbox" name="regulations" /> Accept regulations</label>


</form>

<?php

?>

</body>
</html>