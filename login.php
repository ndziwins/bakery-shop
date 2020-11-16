<?php

session_start();
if(!isset($_POST['login']) && !isset($_POST['password'])){
    header('Location: index.php');
    exit();
}



require_once "connection.php";

$connection = @new mysqli($host,$db_user,$db_password,$db_name);

if ($connection->connect_errno!=0)
{
    echo "Error: ".$connection->connect_errno;
} 
else
{
$login = $_POST['login'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE BINARY email='$login' AND BINARY password='$password'";
if ($result = @$connection->query($sql)) 
{
    $usersNo = $result->num_rows;
    if ($usersNo>0)
    {
        $_SESSION['isLogged'] = true;
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['user'] = $row['email'];

        unset($_SESSION['loginError']);
        $result->close();
        header('Location: account.php');

    } else {

        $_SESSION['loginError'] = '<span style="color:red">Incorrect login or password!</span>';
        header('Location: index.php');

    }
}

$connection->close();
}

?>