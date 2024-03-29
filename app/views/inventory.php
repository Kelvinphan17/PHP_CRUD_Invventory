<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=subspace user=postgres");
$result = pg_query($dbconn, "SELECT * FROM inventory ORDER BY id ASC");
$data = pg_fetch_all($result);

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require "header.php" ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>


    <body>


        <?php $current_page = "inventory"; require "sidebar.php"; ?>

        <div class="container">

            <h3>Inventory</h3>
            <p>Track and manage your inventory of shoes.</p>

            <form method="post" action ="../models/ajax.php">
                <input id="search" name = "item_search" type = "text" size = "50" maxlength = "50" placeholder="Search">
            </form>

            <div class ="additem">
                <button id = "additembtn"><i class="fas fa-plus-square"></i><span>Add Item</span></button>
            </div>

            <div class="table">
                <table class="inv_table" id = "inv_table">
                    <thead id="tableHead">
                        <?php include "tableHead.php"; ?>
                    </thead>
                    <tbody id = "table">
                        <?php foreach ($data as $row) {?>
                        <tr>
                            <td><?php echo $row["product_name"] ?></td>
                            <td><?php echo $row["item_size"] ?></td>
                            <td><?php echo $row["style_code"] ?></td>
                            <td><?php echo (($row["product_status"] == 1) ? "sold" : "unsold") ?></td>
                            <td><?php echo ( (!empty($row["purchase_price"])) ? "$" . number_format((float)$row["purchase_price"], 2, ".",",") : $row["purchase_price"]) ?></td>
                            <td><?php echo ( (!empty($row["market_price"])) ? "$" . number_format((float)$row["market_price"], 2, ".",",") : $row["market_price"]) ?></td>
                            <td><?php echo ( (!empty($row["sold_price"])) ? "$" .number_format((float)$row["sold_price"], 2, ".",",") : $row["sold_price"]) ?></td>
                            <td><?php echo ( (isset($row["profit"])) ? "$" .number_format((float) $row["profit"], 2, ".",",") : $row["profit"]) ?></td>
                            <td><?php echo $row["colorway"] ?></td>
                            <td><?php echo $row["purchase_date"] ?></td>
                            <td> 
                                <button class="editbtn" data-id="<?php echo $row["id"] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="deletebtn" data-id="<?php echo $row["id"] ?>"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </diV>   

        </div>

        <div id="addpopup" class="overlay">
            <div class= "popup" id="popup">
            </div>
            
            <script type="text/javascript" src="../models/events.js"></script>
            
        </div>

    </body>
</html>
