<header id="header">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a href="index.php" class="navbar-brand">ShoppingCart</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="myNavbar">
            <ul class="navbar-nav">
                <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">My Account</a>
                        <a class="dropdown-item" href="wishlist.php">My Wishlist</a>
                        <a class="dropdown-item" href="orders.php">My Orders</a>
                        <a class="dropdown-item" href="order_summary.php">My Order Summary</a>
                    </div>
                </li>
                <li class="nav-item"><a href="cart.php" class="nav-link"><h5 class="px-xl-5 px-lg-5 px-md-5 px-sm-0 cart">
                <i class="fas fa-shopping-basket text-warning"></i> Cart
                <?php

                if(isset($_SESSION['user_id'])){
                    $user_id = $_SESSION['user_id'];
                    $select = "SELECT * FROM cart WHERE user_id = $user_id AND still_here = 0";
                    $result = mysqli_query($connection, $select);
                    if ($result){
                        $cart = mysqli_num_rows($result);
                    }
                    if ($cart != 0){
                        echo "<span id=\"cart_count\" class=\"text-primary bg-light\">$cart</span>";
                    }
                    else{
                        echo "<span id=\"cart_count\" class=\"text-primary bg-light\">0</span>";
                    }
                }
                else{
                    echo "<span id=\"cart_count\" class=\"text-primary bg-light\">0</span>";
                }

                ?> </h5></a></li>
                <li class="nav-item"><a href="login.php" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Login"><i class="fas fa-user-circle text-primary icon"></i></a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Log Out"><i class="fas fa-sign-out-alt text-danger logout icon"></i></a></li>
            </ul>
        </div>
    </nav>
</header>
