<nav>
    <div class="nav-wrapper">
        <a href="/kino.php" class="brand-logo hide-on-med-and-down">Kino</a>
        <span class="logged-in-username">You're logged in as: <b><?php echo $_SESSION['username'] ?></b></span>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="/orders.php">My reservations</a></li>
            <li><a href="/about.php">About</a></li>
            <?php if (isset($_SESSION['admin'])) { ?>
                <li><a href="/admin-page.php">Admin page</a></li>
            <?php } ?>
            <li><a href="/src/templates/logout.php?logOut=1">Log Out</a></li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="/kino.php">Kino</a></li>
    <li><a href="/orders.php">My reservations</a></li>
    <li><a href="/about.php">About</a></li>
    <?php if (isset($_SESSION['admin'])) { ?>
        <li><a href="/admin-page.php">Admin page</a></li>
    <?php } ?>
    <li><a href="/src/templates/logout.php?logOut=1">Log Out</a></li>
</ul>