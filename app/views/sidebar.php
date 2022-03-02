
<nav class = "sidebar">
            <div class ="welcome">
                <img src="/images/logo.png"></img>
                <p>Welcome, User.</p>
            </div> 
            <ul>
                <p>Menu</p>
                <li <?php if($current_page == "dashboard"){echo 'class=current';} ?>> <i class="fas fa-home"></i> <a href= <?php echo ("/app/views/dashboard.php"); ?> > Dashboard</a></li>
                <li <?php if($current_page == "inventory"){echo 'class=current';} ?>> <i class="fas fa-box-open"></i> <a href=<?php echo ("/app/views/inventory.php"); ?>> Inventory</a></li>
            </ul>
</nav>