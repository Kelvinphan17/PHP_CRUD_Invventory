<?php

    $dbconn = pg_connect("host=localhost port=5432 dbname=subspace user=postgres");

    function displayTable($data){

        foreach($data as $row){

            $product_name = $row['product_name'];
            $item_size = $row['item_size'];
            $style_code = $row['style_code'];
            $status = (($row["product_status"] == 1) ? "sold" : "unsold");
            $purchase_price =  ( (!empty($row["purchase_price"])) ? "$" . number_format((float)$row["purchase_price"], 2, ".",",") : $row["purchase_price"]);
            $market_price = ( (!empty($row["market_price"])) ? "$" . number_format((float)$row["market_price"], 2, ".",",") : $row["market_price"]);
            $sold_price = ( (!empty($row["sold_price"])) ? "$" .number_format((float)$row["sold_price"], 2, ".",",") : $row["sold_price"]);
            $profit =  ( (isset($row["profit"])) ? "$" .number_format((float) $row["profit"], 2, ".",",") : $row["profit"]);
            $colorway = $row['colorway'];
            $purchase_date = $row['purchase_date'];
            $id = $row['id'];

            echo "
                <tr>
                    <td> $product_name </td>
                    <td> $item_size </td>
                    <td> $style_code </td>
                    <td> $status </td>
                    <td> $purchase_price </td>
                    <td> $market_price </td>
                    <td> $sold_price </td>
                    <td> $profit</td>
                    <td> $colorway</td>
                    <td> $purchase_date</td>
                    <td> 
                        <button class='editbtn' data-id='$id'><i class='fa-solid fa-pen-to-square'></i></button>
                        <button class='deletebtn' data-id='$id'><i class='fa-solid fa-trash-can'></i></button> 
                    </td>
                </tr>";
        }


    }

    function displayAddForm(){            
            echo '
            <h3>Create new item</h3>
                
            
            <form id="insert" method="POST" autocomplete="off">
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
            </form><span class="close">&times;</span>'; 
    }

    function displayEditForm($data){

        foreach ($data as $row){
            $product_name = $row['product_name'];
            $item_size = $row['item_size'];
            $style_code = $row['style_code'];
            $purchase_price =  $row["purchase_price"];
            $market_price = $row["market_price"];
            $sold_price = $row["sold_price"];
            $colorway = $row['colorway'];
            $purchase_date = $row['purchase_date'];
            $id = $row['id'];
            
            echo '
            <h3>Update item</h3>

            <form id="insert" method="POST" autocomplete="off">
            <label>Name<span>*</span><br>
                <input name = "item_name" type = "text" size = "50" maxlength = "50" value="'.$product_name.'" required>
            </label>
            <label>Size<span>*</span><br>
                <input name = "item_size" type = "text" size = "5" maxlength = "5" value="'.$item_size.'" required>
            </label>
            <label>Style Code<br>
                <input name = "item_sku" type = "text" size = "15" maxlength = "15" value="' .$style_code. '" placeholder="555088-140">
            </label>
            <label>Purchase Price<span>*</span><br>
                <input name = "item_price" type = "text" size = "15" maxlength = "15" value="' .$purchase_price. '" required>
            </label>
            <label>Market Price<br>
                <input name = "item_market" type = "text" size = "15" maxlength = "15" value="' .$market_price. '" placeholder="500" >
            </label>
            <label>Sold For<br>
                <input name = "sold_price" type = "text" size = "15" maxlength = "15" value="' .$sold_price. '" placeholder="800" >
            </label>
            <label>Colorway<br>
                <input name = "item_color" type = "text" size = "35" maxlength = "35" value="' .$colorway. '" placeholder="SAIL/OBSIDIAN-UNIVERSITY BLUE">
            </label>
            <label>Purchase Date<span>*</span><br>
                <input type="date" name="purchase_date" value="' .$purchase_date. '"required>
            </label>
                <input type="hidden" name="id" value='.$id.'>
            <input type = "submit" name="update" value = "update">
            </form>'; 
        }
    }

    if (isset($_POST['search'])){

        $value = $_POST['search'];

        $result = pg_query($dbconn, "SELECT * FROM inventory WHERE product_name ILIKE '%$value%' ORDER BY id ASC");

        $data = pg_fetch_all($result);

        displayTable($data);

    }


    if (isset($_POST['edit_id']) and !empty($_POST['edit_id']) ) {
        $id = (int) $_POST['edit_id'];
        
        $result = pg_query($dbconn, "SELECT * FROM inventory WHERE id = $id");

        $data = pg_fetch_all( $result );

        displayEditForm($data);
    }



    if (isset($_POST['delete_id']) and !empty($_POST['delete_id']) ) {
        $id = (int) $_POST['delete_id'];

        $query = pg_query($dbconn, "DELETE FROM inventory WHERE id = $id;");

        $value = $_POST['search_id'];
        
        $result = pg_query($dbconn, "SELECT * FROM inventory WHERE product_name ILIKE '%$value%' ORDER BY id ASC");

        $data = pg_fetch_all( $result );
        
        displayTable($data);
    }


    if (isset($_POST['type']) and ( $_POST['type'] == 1) ) {
        $id = $_POST['id'];
        $item_name = $_POST['item_name'];
        $item_size = $_POST['item_size'];
        $item_sku = (isset($_POST['item_sku'])) ? $_POST['item_sku'] : NULL;
        $item_price = number_format((float)$_POST['item_price'], 2, ".","");
        $item_market = (!empty($_POST['item_market'])) ? number_format((float)$_POST['item_market'], 2, ".","") : 'NULL';
        $item_color = (isset($_POST['item_color'])) ? $_POST['item_color'] : NULL;
        $purchase_date = $_POST['purchase_date'];
        $sold_price = (!empty($_POST['sold_price'])) ? number_format((float)$_POST['sold_price'], 2, ".","") : 'NULL';
        $status = (!empty($_POST['sold_price'])) ? 1 : 0;
        $profit = (!empty($_POST['sold_price'])) ? number_format((float)($sold_price - $item_price), 2, ".","") : 'NULL';
    
        $query = pg_query($dbconn, "UPDATE inventory SET product_name = '$item_name', item_size = $item_size, style_code = '$item_sku', purchase_price = $item_price, market_price = $item_market,
                                    sold_price = $sold_price, profit = $profit, colorway = '$item_color', purchase_date = '$purchase_date', product_status = $status WHERE id = $id");

        $result = pg_query($dbconn, "SELECT * FROM inventory ORDER BY id ASC");
        
        $data = pg_fetch_all( $result );
        
        displayTable($data);
                                 
    }

    if (isset($_POST['type']) and ( $_POST['type'] == 0) ) {
        $item_name = $_POST['item_name'];
        $item_size = $_POST['item_size'];
        $item_sku = (isset($_POST['item_sku'])) ? $_POST['item_sku'] : NULL;
        $item_price = number_format((float)$_POST['item_price'], 2, ".","");
        $item_market = (!empty($_POST['item_market'])) ? number_format((float)$_POST['item_market'], 2, ".","") : 'NULL';
        $item_color = (isset($_POST['item_color'])) ? $_POST['item_color'] : NULL;
        $purchase_date = $_POST['purchase_date'];
        $sold_price = (!empty($_POST['sold_price'])) ? number_format((float)$_POST['sold_price'], 2, ".","") : 'NULL';
        $status = (!empty($_POST['sold_price'])) ? 1 : 0;
        $profit = (!empty($_POST['sold_price'])) ? number_format((float)($sold_price - $item_price), 2, ".","") : 'NULL';

        $query = pg_query($dbconn, "INSERT INTO inventory (product_name, item_size, style_code, purchase_price, market_price, sold_price, profit, colorway, purchase_date, product_status) 
        VALUES ('$item_name', $item_size, '$item_sku', $item_price, $item_market, $sold_price, $profit, '$item_color', '$purchase_date', $status);");

        $result = pg_query($dbconn, "SELECT * FROM inventory ORDER BY id ASC");
        
        $data = pg_fetch_all( $result );
        
        displayTable($data);
                                 
    }

    if (isset($_POST['add']) and !empty($_POST['add']) ) {

        displayAddForm();
    }

    if (isset($_POST['toSort']) and !empty($_POST['toSort'])) {


        $column = $_POST['toSort'];

        $sortOrder = $_POST['sortOrder'];

        $asc_or_desc = $sortOrder == 'asc' ? 'desc' : 'asc';
        $up_or_down = str_replace(array('asc','desc'), array('up','down'), $asc_or_desc); 

        function appendSortOrder($columnName, $column, $up_or_down ){

            return $columnName == $column ? '-'.$up_or_down : '';
        }

        $buttonName = "<button class=sort data-id=product_name data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("product_name",$column,$up_or_down) ."'></i></button>";
        $buttonSize = "<button class=sort data-id=item_size data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("item_size",$column,$up_or_down) ."'></i></button>";
        $buttonStatus = "<button class=sort data-id=product_status data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("product_status",$column,$up_or_down) ."'></i></button>";
        $buttonPurchase = "<button class=sort data-id=purchase_price data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("purchase_price",$column,$up_or_down) ."'></i></button>";
        $buttonMarket = "<button class=sort data-id=market_price data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("market_price",$column,$up_or_down) ."'></i></button>";
        $buttonSold = "<button class=sort data-id=sold_price data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("sold_price",$column,$up_or_down) ."'></i></button>";
        $buttonProfit = "<button class=sort data-id=profit data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("profit",$column,$up_or_down) ."'></i></button>";
        $buttonDate = "<button class=sort data-id=purchase_date data-order=".$asc_or_desc."><i class='fa-solid fa-sort". appendSortOrder("purchase_date",$column,$up_or_down) ."'></i></button>";

        $result = pg_query($dbconn, "SELECT * FROM inventory ORDER BY $column $asc_or_desc NULLS LAST");

        $data = pg_fetch_all( $result );

        echo
        "
        <thead id = tableHead>
            <tr>
                <th>Name $buttonName</th>
                <th>Size $buttonSize</th>
                <th><br>SKU</th>
                <th>Status $buttonStatus</th>
                <th>Purchase Total $buttonPurchase</th>
                <th>Market Price $buttonMarket</th>
                <th>Sold For $buttonSold</th>
                <th>Profit $buttonProfit</th>
                <th><br>Colorway</th>
                <th>Date Purchased $buttonDate</th>
                <th><br>Actions </th>
            </tr>
        </thead>
        <tbody id = table>";

        displayTable($data);

        echo "</tbody>";
    }



?>