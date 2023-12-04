<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="assets/logo.png" alt="" width="80px">
                &nbsp;Haven Records
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link me-2" aria-current="page" href="index.php">Home</a>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Store
                </a>
                <ul class="dropdown-menu bg-dark">
                    <li><a class="dropdown-item text-white" href="store.php">All Products</a></li>
                    <li><a class="dropdown-item text-white" href="vinyl.php">Vinyl Records</a></li>
                    <li><a class="dropdown-item text-white" href="cd.php">CDs</a></li>
                </ul>
                </li>
                <?php
                    if(!empty($_SESSION["user"])) {
                        if($_SESSION["user"] == "admin"){
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Database
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item text-white" href="store.php">Create</a></li>
                            <li><a class="dropdown-item text-white" href="vinyl.php">Update</a></li>
                            <li><a class="dropdown-item text-white" href="cd.php">Delete</a></li>
                        </ul>
                    </li>

                <?php
                        }
                    }
                ?>
                <li class="nav-item">
                <a class="nav-link me-2" href="aboutUs.php">About Us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link me-2" href="FAQ.php">Contact</a>
                </li>
                <li class="nav-item">
                <a class="nav-link me-2" href="FAQ.php">Help</a>
                </li>
            </ul>
            <?php
              if(!empty($_SESSION["user"])) {
            ?>
                <a href="account.php">
                    <button type="button" class="btn text-white btn-custom idk">
            
                    <?php
                    if (isset($_SESSION["user"])){
                        echo $_SESSION["user"];
                    }
                    ?>
                    &nbsp;<i class="fas fa-user"></i>
                    </button>
                </a>
                <a href="#cart">
                    <button type="button" class="btn text-white btn-custom">
                    <i class="fa-solid fa-cart-shopping"></i> ( 0 )
                    </button>
                </a>
            <?php
              } else {
            ?>
            <a href="login.php">
                <button type="button" class="text-white btn btn-custom idk">
                    Log in&nbsp;
                    <i class="fas fa-user"></i>
              </button>
            </a>
            <?php
              }
            ?>
            </div>
        </div>
    </nav>


