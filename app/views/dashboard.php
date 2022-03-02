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
                    <p>2</p>
                </div>
    
                <div class ="invworth">
                    <h3>Total Inventory Worth</h3>
                    <p>$553.70</p>
                </div>
    
                <div class ="profit"> 
                    <h3>Net Profit</h3>
                    <p>$0</p>
                </div>

                <div class ="salescount"> 
                    <h3>Items Sold</h3>
                    <p>0</p>
                </div>
    
                <div class ="salesincome"> 
                    <h3>Sales Income</h3>
                    <p>$0</p>
                </div>
    
            </div>
        </div>

    </body>
    
</html>