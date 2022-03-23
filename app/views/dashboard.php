<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=subspace user=postgres");

require __DIR__ . ("/../models/CalculateStats.php");

?>


<!DOCTYPE html>

<html>
    <head>
        <?php require 'header.php' ?>
    </head>


    <body>
        
        <?php $current_page = "dashboard"; require 'sidebar.php'; ?>

        <div class="dashboard">
            <h1>Subspace Dashboard</h1>
            
            <div class="stats">

                <div class ="numofitems">
                    <h3>Items in Inventory</h3>
                    <p> <?php echo Stats::CalcItems($dbconn) ?></p>
                </div>
    
                <div class ="invworth">
                    <h3>Total Inventory Worth</h3>
                    <p><?php echo Stats::CalcWorth($dbconn) ?></p>
                </div>
    
                <div class ="profit"> 
                    <h3>Net Profit</h3>
                    <p id="profitnumber"><?php echo Stats::CalcProfit($dbconn) ?></p>
                </div>

                <div class ="salescount"> 
                    <h3>Items Sold</h3>
                    <p><?php echo Stats::itemsSold($dbconn) ?></p>
                </div>
    
                <div class ="salesincome"> 
                    <h3>Sales Income</h3>
                    <p><?php echo Stats::salesIncome($dbconn) ?></p>
                </div>
    
            </div>
        </div>

        <script>
            window.onload = function(){

                var profit = document.getElementById("profitnumber").textContent;

                var num = parseInt(profit.slice(1));


                if(num > 0){
                    document.getElementById("profitnumber").style.color= "#00FF00";
                }
                else if(num < 0){
                    document.getElementById("profitnumber").style.color= "#FF0000";
                }
            }

        </script>

    </body>
    
</html>