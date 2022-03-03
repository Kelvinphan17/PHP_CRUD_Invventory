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

}

?>