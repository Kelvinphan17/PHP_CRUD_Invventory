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
                <a href=#addpopup><i class="fas fa-plus-square"></i><span>Add Item</span></a>
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
                            <th>Colorway</th>
                            <th>Date Purchased</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jordan 1 Retro High Obsidian UNC</td>
                            <td>11</td>
                            <td>555088-140</td>
                            <td>Unsold</td>
                            <td>$276.85</td>
                            <td>$700</td>
                            <td>SAIL/OBSIDIAN-UNIVERSITY BLUE</td>
                            <td>February 5th, 2022</td>
                        </tr>
                        <tr>
                            <td>Jordan 1 Retro High Rookie of the Year</td>
                            <td>11</td>
                            <td>555088-700</td>
                            <td>Unsold</td>
                            <td>$276.85</td>
                            <td>$795</td>
                            <td>GOLDEN HARVEST/BLACK-SAIL</td>
                            <td>February 5th, 2022</td>
                        </tr>
                    </tbody>
                </table>
            </diV>   

        </div>

        <div id="addpopup" class="overlay">
            <a href="#" class="cancel"></a>
            <div class= "popup">
                <h3>Create new item</h3>


                <form method="post" action =# autocomplete="off">
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
                    <label>Colorway<br>
                        <input name = "item_color" type = "text" size = "35" maxlength = "35" placeholder="SAIL/OBSIDIAN-UNIVERSITY BLUE">
                    </label>
                    <label>Purchase Date<span>*</span><br>
                        <input type="date" name="purchase_date" required>
                    </label>
                    <input type = "submit" value = "save">
                </form>


                <a class="close" href="#">&times;</a>
            </div>
        </div>

    </body>
    
</html>