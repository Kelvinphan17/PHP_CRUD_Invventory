<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . ("/../app/models/CalculateStats.php");

class StatsTest extends TestCase
{

    public function testCheckNumOfItems(): void
    {
        $dbconn = pg_connect("host=localhost port=5432 dbname=subspace user=postgres");
        pg_query($dbconn,"INSERT INTO inventory
        (product_name, item_size, style_code, purchase_price, market_price, colorway, purchase_date, product_status)
        VALUES
        ('Jordan 1 Retro High Rookie of the Year', 12, '555088-700', 276.85, 795, 'GOLDEN HARVEST/BLACK-SAIL', '2020-02-05', 'unsold')");

        $this->assertEquals("3", Stats::CalcItems($dbconn));
    }


    public function testCheckNumOfItemsAfterDelete(): void
    {
        $dbconn = pg_connect("host=localhost port=5432 dbname=subspace user=postgres");
        pg_query($dbconn,"DELETE FROM inventory WHERE id=3");

        $this->assertEquals("2", Stats::CalcItems($dbconn));
    }

}




?>