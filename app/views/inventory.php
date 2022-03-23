<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=subspace user=postgres");
$result = pg_query($dbconn, "SELECT * FROM inventory");
$data = pg_fetch_all($result);

if (isset($_POST['submit']) and !empty($_POST['submit']) ) {
    $item_name = $_POST['item_name'];
    $item_size = $_POST['item_size'];
    $item_sku = (isset($_POST['item_sku'])) ? $_POST['item_sku'] : NULL;
    $item_price = $_POST['item_price'];
    $item_market = (!empty($_POST['item_market'])) ? $_POST['item_market'] : 'NULL';
    $item_color = (isset($_POST['item_color'])) ? $_POST['item_color'] : NULL;
    $purchase_date = $_POST['purchase_date'];
    $sold_price = (!empty($_POST['sold_price'])) ? $_POST['sold_price'] : 'NULL';
    $status = (!empty($_POST['sold_price'])) ? 1 : 0;
    $profit = (!empty($_POST['sold_price'])) ? ($sold_price - $item_price) : 'NULL';

    $query = pg_query($dbconn, "INSERT INTO inventory (product_name, item_size, style_code, purchase_price, market_price, sold_price, profit, colorway, purchase_date, product_status) 
    VALUES ('$item_name', $item_size, '$item_sku', $item_price, $item_market, $sold_price, $profit, '$item_color', '$purchase_date', $status);");

    header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
    exit();
}

if (isset($_GET['delete']) and !empty($_GET['delete']) ) {
    $id = (int) $_GET['delete'];

    $query = pg_query($dbconn, "DELETE FROM inventory WHERE id = $id;");

    $url = explode("/?", $_SERVER["REQUEST_URI"]);

    header( "Location: $url[0]", true, 303 );
    exit();
}

?>

<!DOCTYPE html>

<html>
    <head>
        <?php require "header.php" ?>
    </head>


    <body>


        <?php $current_page = "inventory"; require "sidebar.php"; ?>

        <div class="container">

            <h3>Inventory</h3>
            <p>Track and manage your inventory of shoes.</p>

            <form method="post" action =#>
                <input name = "item_search" type = "text" size = "50" maxlength = "50" placeholder="Search">
                <input type = "submit" value = "submit">
                <input type = "reset" value = "clear">
            </form>

            <div class ="additem">
                <button id = "additembtn"><i class="fas fa-plus-square"></i><span>Add Item</span></button>
            </div>

            <div class="table">
                <table class="inv_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Size</th>
                            <th>SKU</th>
                            <th>Status</th>
                            <th>Purchase Total</th>
                            <th>Market Price</th>
                            <th>Sold For</th>
                            <th>Profit</th>
                            <th>Colorway</th>
                            <th>Date Purchased</th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) {?>
                        <tr>
                            <td><?php echo $row["product_name"] ?></td>
                            <td><?php echo $row["item_size"] ?></td>
                            <td><?php echo $row["style_code"] ?></td>
                            <td><?php echo (($row["product_status"] == 1) ? "sold" : "unsold") ?></td>
                            <td><?php echo ( (!empty($row["purchase_price"])) ? "$" . $row["purchase_price"] : $row["purchase_price"]) ?></td>
                            <td><?php echo ( (!empty($row["market_price"])) ? "$" . $row["market_price"] : $row["market_price"]) ?></td>
                            <td><?php echo ( (!empty($row["sold_price"])) ? "$" . $row["sold_price"] : $row["sold_price"]) ?></td>
                            <td><?php echo ( (!empty($row["profit"])) ? "$" . $row["profit"] : $row["profit"]) ?></td>
                            <td><?php echo $row["colorway"] ?></td>
                            <td><?php echo $row["purchase_date"] ?></td>
                            <td> 
                                <a href="\?edit=<?php echo $row["id"] ?>"> <i class="fa-solid fa-pen-to-square"></i></a>
                                <a onClick="return confirm('Are you sure you want to delete?')" href="inventory.php\?delete=<?php echo $row["id"] ?>"> <i class="fa-solid fa-trash-can"></i></a> 
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </diV>   

        </div>

        <div id="addpopup" class="overlay">
            <div class= "popup">
                <h3>Create new item</h3>


                <form name="insert" method="POST" action ="" autocomplete="off">
                    <label>Name<span>*</span><br>
                        <input name = "item_name" type = "text" size = "50" maxlength = "50" placeholder="Jordan 1 Retro High Obsidian UNC" required>
                    </label>
                    <label>Size<span>*</span><br>
                        <input name = "item_size" type = "text" size = "5" maxlength = "5" placeholder="11" pattern="[1-9][0-8]?\.?[5]?[KYC]?" title= "Valid Size" required>
                    </label>
                    <label>Style Code<br>
                        <input name = "item_sku" type = "text" size = "15" maxlength = "15" placeholder="555088-140">
                    </label>
                    <label>Purchase Price<span>*</span><br>
                        <input name = "item_price" type = "text" size = "15" maxlength = "15" placeholder="300" pattern="\d*\.?\d+" title= "Valid positive integer" required>
                    </label>
                    <label>Market Price<br>
                        <input name = "item_market" type = "text" size = "15" maxlength = "15" placeholder="500" >
                    </label>
                    <label>Sold For<br>
                        <input name = "sold_price" type = "text" size = "15" maxlength = "15" placeholder="800" >
                    </label>
                    <label>Colorway<br>
                        <input name = "item_color" type = "text" size = "35" maxlength = "35" placeholder="SAIL/OBSIDIAN-UNIVERSITY BLUE">
                    </label>
                    <label>Purchase Date<span>*</span><br>
                        <input type="date" name="purchase_date" required>
                    </label>
                    <input type = "submit" name="submit" value = "submit">
                </form>


                <span class="close">&times;</span>
            </div>
            
            <script>
                var popup = document.getElementById("addpopup");

                // Get the button that opens the popup
                var btn = document.getElementById("additembtn");

                // Get the span that closes the popup
                var span = document.getElementsByClassName("close")[0];

                // When user clicks on the button, open the popup
                btn.onclick = function() {
                    popup.style.display = "block";
                }

                // When the user clicks on the x, close the popup
                span.onclick = function() {
                    popup.style.display = "none";
                }

                // When the user clicks anywhere outside of the popup, close it
                window.onclick = function(event) {
                    if (event.target == popup) {
                        popup.style.display = "none";
                    }
                }



            </script>
        </div>

    </body>
    
</html>
