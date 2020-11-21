<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
</head>

<body>

    <?php

    $donuts = $_POST['donuts'];
    $breads = $_POST['breads'];
    $sum = 0.99 * $donuts + 1.99 * $breads;

    echo <<<END
        <h2>Order summary:</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <td>Donut (0,99$/pc)</td>
                <td>$donuts</td>
            </tr>
            <tr>
                <td>Bread (1,99$/pc)</td>
                <td>$breads</td>
            </tr>
            <tr>
                <td>SUMMARY:</td>
                <td>$sum $</td>
            </tr>
        </table>
        <br><a href="index.php">To main manu</a>
END;
    ?>

</body>

</html>