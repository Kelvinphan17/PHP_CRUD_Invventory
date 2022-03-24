<?php

    $dbconn = pg_connect("host=localhost port=5432 dbname=subspace user=postgres");

    function displayTable($data){

        foreach($data as $row){

            $product_name = $row['product_name'];
            $item_size = $row['item_size'];
            $style_code = $row['style_code'];
            $status = (($row["product_status"] == 1) ? "sold" : "unsold");
            $purchase_price =  ( (!empty($row["purchase_price"])) ? "$" . $row["purchase_price"] : $row["purchase_price"]);
            $market_price = ( (!empty($row["market_price"])) ? "$" . $row["market_price"] : $row["market_price"]);
            $sold_price = ( (!empty($row["sold_price"])) ? "$" . $row["sold_price"] : $row["sold_price"]);
            $profit =  ( (!empty($row["profit"])) ? "$" . $row["profit"] : $row["profit"]);
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
                        <a href='inventory.php\?edit=$id'> <i class='fa-solid fa-pen-to-square'></i></a>
                        <button class='deletebtn' data-id='$id'><i class='fa-solid fa-trash-can'></i></button> 
                    </td>
                </tr>";
        }


    }

    if (isset($_POST['search'])){

        $value = $_POST['search'];
        

        $GLOBALS['search_query'] = $value;

        $result = pg_query($dbconn, "SELECT * FROM inventory WHERE product_name ILIKE '%$value%' ORDER BY id ASC");

        $data = pg_fetch_all($result);

        displayTable($data);

    }

    if (isset($_POST['delete_id']) and !empty($_POST['delete_id']) ) {
        $id = (int) $_POST['delete_id'];

        $query = pg_query($dbconn, "DELETE FROM inventory WHERE id = $id;");

        $value = $_POST['search_id'];
        
        $result = pg_query($dbconn, "SELECT * FROM inventory WHERE product_name ILIKE '%$value%' ORDER BY id ASC");

        $data = pg_fetch_all( $result );
        
        displayTable($data);
    }




?>