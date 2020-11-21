<?php
session_start();

if ((isset($_SESSION['isLogged'])) && ($_SESSION['isLogged'] = true)) {
    header('Location: account.php');
    exit();
}


if (isset($_POST['email'])) {

    //remembering email if fail
    $_SESSION['fr_email'] = $_POST['email'];
    if(isset($_POST['regulations'])) $_SESSION['fr_regulations'] = true;

    //Sucessful validation
    $is_ok = true;

    //email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((strlen($email) < 5) || (strlen($email) > 40)) {
        $is_ok = false;
        $_SESSION['e_email'] = "Email is to short.";
    }

    //alfanumerycznosc
    // if (ctype_alnum($email)==false)
    // {
    //     $is_ok = false;
    //     $_SESSION['e_email'] = "Email must be alfanumeric.";
    // }

    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email)) {
        $is_ok = false;
        $_SESSION['e_email'] = "Email invalid.";
    }

    //PASSWORD
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    if ((strlen($pass1) < 8) || (strlen($pass1) > 32)) {
        $is_ok = false;
        $_SESSION['e_pass'] = "Password must have 8-32 characters.";
    }

    if ($pass1 != $pass2) {
        $is_ok = false;
        $_SESSION['e_pass'] = "Passwords are not identical.";
    }

    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);

    //regulations
    if (!isset($_POST['regulations'])) {
        $is_ok = false;
        $_SESSION['e_regul'] = "Regulations must be accepted.";
    }

    //reCAPTCHA
    $s_key = "6Le6mucZAAAAAJqEF_Cew7s4mFx4Yhu_QM2FF-gR";
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $s_key . '&response=' . $_POST['g-recaptcha-response']);
    $response = json_decode($check);
    if (!$response->success) {
        $is_ok = false;
        $_SESSION['e_bot'] = "Verify if you are human.";
    }

    //multiply accounts
    require_once "connection.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $result = $connection->query("SELECT id FROM users WHERE email='$email'");

            if (!$result) throw new Exception($connection->error);
            $how_much = $result->num_rows;
            if ($how_much > 0) {
                $is_ok = false;
                $_SESSION['e_user'] = "There is user with that email in database.";
            }


            if ($is_ok == true) {

                if ($connection->query("INSERT INTO users VALUES (NULL, '$email', '$pass_hash')")) {
                    $_SESSION['registrationCompleted'] = true;
                    header('Location: newUser.php');
                } else {
                    throw new Exception($connection->error);
                }
            }

            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Server error!</span><br>';
        echo $e;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register new account</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>

    <form method="post">
        email: <br><input type="text" value="<?php
        if (isset($_SESSION['fr_email'])) {
            echo $_SESSION['fr_email'];
            unset($_SESSION['fr_email']);}?>" name="email" /> <br>

        <?php
        if (isset($_SESSION['e_email'])) {
            echo '<div class="error">' . $_SESSION['e_email'] . '</div>';
            unset($_SESSION['e_email']);
        }
        ?>

        <?php
        if (isset($_SESSION['e_user'])) {
            echo '<div class="error">' . $_SESSION['e_user'] . '</div>';
            unset($_SESSION['e_user']);
        }
        ?>

        password: <br><input type="password" name="password1" /> <br>

        <?php
        if (isset($_SESSION['e_pass'])) {
            echo '<div class="error">' . $_SESSION['e_pass'] . '</div>';
            unset($_SESSION['e_pass']);
        }
        ?>

        repeat password: <br><input type="password" name="password2" /> <br>

        <label><input type="checkbox" name="regulations" <?php
                                                            if (isset($_SESSION['fr_regulations'])) 
                                                            {
                                                                echo "checked";
                                                                unset($_SESSION['fr_regulations']);
                                                            }?>/> Accept regulations</label>
        <?php
        if (isset($_SESSION['e_regul'])) {
            echo '<div class="error">' . $_SESSION['e_regul'] . '</div>';
            unset($_SESSION['e_regul']);
        }
        ?>

        <br>
        <div class="g-recaptcha" data-sitekey="6Le6mucZAAAAAH35WtqKtTcQUo45ACvbLwPCVF7f"></div>

        <?php
        if (isset($_SESSION['e_bot'])) {
            echo '<div class="error">' . $_SESSION['e_bot'] . '</div>';
            unset($_SESSION['e_bot']);
        }
        ?>
        <br>
        <input type="submit" value="Register" />
        <br>
    </form>

    <?php

    ?>

</body>

</html>