<?php


class Stats
{
    public static function CalcItems($dbconn)
    {

        $result = pg_query($dbconn, "SELECT COUNT(*) FROM inventory");

        $data = pg_fetch_all($result);

        foreach ($data as $row){
            return $row["count"];
        }

    }


    public static function CalcWorth($dbconn){

        $result = pg_query($dbconn, "SELECT purchase_price FROM inventory");

        $data = pg_fetch_all($result);

        $total= 0;

        foreach ($data as $row){
            $total += $row["purchase_price"];
        }

        number_format((float)$total, 2, ".",",");

        echo "$".number_format((float)$total, 2, ".",",");


    }

    public static function CalcProfit($dbconn){

        $result = pg_query($dbconn, "SELECT profit FROM inventory");

        $data = pg_fetch_all($result);

        $total= 0;

        foreach ($data as $row){
            $total += $row["profit"];
        }

        number_format((float)$total, 2, ".",",");

        echo "$".number_format((float)$total, 2, ".",",");


    }

    public static function itemsSold($dbconn){

        $result = pg_query($dbconn, "SELECT COUNT(*) FROM inventory WHERE product_status = 1");

        $data = pg_fetch_all($result);

        $total= 0;

        foreach ($data as $row){
            $total += $row["count"];
        }

        echo $total;


    }

    public static function salesIncome($dbconn){

        $result = pg_query($dbconn, "SELECT sold_price FROM inventory");

        $data = pg_fetch_all($result);

        $total= 0;

        foreach ($data as $row){
            $total += $row["sold_price"];
        }

        number_format((float)$total, 2, ".",",");

        echo "$".number_format((float)$total, 2, ".",",");


    }

}

?>