<?php
    if(isset($message)){
        foreach($message as $message){
            echo '
                <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }
?>

<header class="header">

    <section class="flex">

        <a href="admin_page.php" class="logo">&#129482;Admin<span>Panel</span></a>

        <nav class="navbar">
            <a href="admin_products.php">Products</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_accounts.php">Admin</a>
            <a href="user_accounts.php">User</a>
            <a href="user_messages.php">Messages</a>

        </nav>

        <div class="icons">

            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user" title="Account"></div>
            <div id="setting-btn" class="fas fa-cog" title="Setting"></div>

        </div>

        <div class="profile">
            <?php
                $select_profile = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '?'") or die('query failed');
                $row = mysqli_fetch_assoc($select_profile);
            ?>
            <p><?php echo $_SESSION['admin_name']; ?></p>
            <a href="logout.php" class="delete-btn">logout</a>
            <div class="flex-btn">
                <a href="admin_login.php" class="option-btn">login</a>
                <a href="admin_register.php" class="option-btn">register</a>
            </div>
        </div>

        <div class="theme-container">

            <h3>switch theme</h3>

            <div class="theme-toggler">
                <span>light</span>
                <span class="toggler"></span>
                <span>dark</span>
            </div>

            <h3>Pick a color</h3>

            <div class="theme-colors">

                <div class="color" style="background:#FB2576;"></div>
                <div class="color" style="background:#03C988;"></div>
                <!--#27ae60-->
                <div class="color" style="background:#E76161;"></div>
                <div class="color" style="background:#8e44ad;"></div>
                <div class="color" style="background:#0fb9b1;"></div>
                <div class="color" style="background:#ffd32a;"></div>
                <div class="color" style="background:#ff0033;"></div>
                <div class="color" style="background:#2980b9;"></div>

            </div>

        </div>

    </section>

    <div id="progress">
        <span id="progress-value">&#x1F815;</span>
    </div>

</header>

<?php @include('admin_loader.php'); ?>