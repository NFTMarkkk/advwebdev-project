<!doctype html>
<html>
    <head>
        <title>Buy Form</title>
        <link rel="stylesheet" href="Mtop.css">
    </head>
    <body>
        <h1>ORDER REVIEW</h1>
        <table>
        <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Size</th>
        </tr>
        <tr>
            <td>Icon Relaxed Fit Graphic T-Shirt</td>
            <td> <?php $size = $_POST['size'];
                echo $size
            ?></td>
            <td> <?php $quantity = $_POST['quantity'];
                echo $quantity
            ?></td>
            <td>
                <?php
                        if ($size == "Large") {
                            echo 799.00 * $quantity;
                        }
                        elseif ($size == "Medium") {
                            echo 699.00 * $quantity;
                        }
                        elseif ($size == "Small") {
                            echo 599.00 * $quantity;
                        }
                ?>
            </td>
        </tr>
        </table>
    </body>
</html>