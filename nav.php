<nav class="navbar navbar-expand-lg sticky-top nav_background">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold nav_brand text-primary-cs" href="/index.php">Book Keeping</a>
    <button class="navbar-toggler ham_ico" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav d-flex gap-3 w-100 nav-tabs ps-4">
        <li class="sm-mb-2">
          <a href="/index.php" class="">Home</a>
        </li>
        <li class="sm-mb-2">
          <a href="/books.php" class="">Books</a>
        </li>
        <li class="sm-mb-2">
          <a href="/aboutus.php" class="">About Us</a>
        </li>
        <?php
        if (!isset($_SESSION['username'])) {
        ?>
          <li class="ms-lg-auto sm-w-100">
            <a href="./login.php" class="text-center w-100">Login</a>
          </li>
          <li>
            <a class="container" href="./signup.php">
              <button type="button" class="btn btn-primary bg-primary w-100">Sign up</button>
            </a>
          </li>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['username'])) {
        ?>
        <li class="nav-item ms-lg-auto dropdown d-block" style="display: block !important;">
          <a class="nav-link dropdown-toggle text-primary-cs" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Options
          </a>
          <ul class="dropdown-menu dropdown-menu-end p-2">
            
          <li class="mb-2"><a class="dropdown-item" href="./admin.php">Dashboard</a></li>
          <?php
          if($_SESSION['admin']){
          ?>
              <li class="mb-2"><a class="dropdown-item" href="./profile.php">Profile</a></li>
              <?php
        }
          ?>
              <li class="mb-2"><a class="dropdown-item" href="./bookmarks.php">Bookmarks</a></li>
            <li><hr class="dropdown-divider"></li>
              <li class="mb-2">
                <a class="dropdown-item" href="./logout.php">
                  <button class="btn btn-danger bg-danger w-100">
                    Logout
                  </button>
              </a>
            </li>
          </ul>
        </li>
          <li class="nav-item  btn-group">
            
            <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end">
             
            </ul>
          </li>

        <?php
        }
        ?>


      </ul>
    </div>
  </div>
</nav>