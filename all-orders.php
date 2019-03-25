<?php
session_start();
if ($_SESSION['admin'] != true) {
    // Pouzivatel NIEJE admin
    header('Location: /');
    exit;
}
$pageTitle = 'Kino';
include 'src/templates/db-config.php';
include 'src/templates/header.php';
include 'src/templates/header-close.php';

$userID = $_SESSION['memberid'];
$selectQuery = "SELECT orders.orderID, orders.movieID, users.username, orders.orderedSeat, movies.title FROM orders JOIN movies ON orders.movieID=movies.movieID JOIN users ON orders.userID=users.userID;
";
$queryResult = mysqli_query($db, $selectQuery);

?>

<div class="kino-wrapper">
    <?php include 'src/templates/navbar.php'; ?>

    <div class="movies-wrapper orders-wrapper">
        <div class="container">
            <?php if (mysqli_num_rows($queryResult) > 0) {
                //Nachadza sa nejaky result
                while ($row = mysqli_fetch_assoc($queryResult)) { ?>
                    <div class="col s12 m12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row center">
                                    <form action="src/db-queries/remove-order.php">
                                        <h5>Order ID: <b>#<?php echo $row['orderID'] ?></b></h5>
                                        <h5>Username: <b><?php echo $row['username'] ?></b></h5>
                                        <h5>Name of movie: <b><?php echo $row['title']; ?></b></h5>
                                        <h5>Ordered seats: <b><?php echo $row['orderedSeat']; ?></b></h5>
                                        <a href="/reservation.php?movieID=<?php echo $row['movieID'] ?>"
                                           class="waves-effect wave-light btn btn-submit">LINK TO MOVIE</a>
                                        <input type="hidden" value="<?php echo $row['orderID']; ?>" name="orderID">
                                        <input type="hidden" value="1" name="all-orders">
                                        <button type="submit"
                                                class="delete-order waves-effect wave-light btn btn-submit">DELETE
                                            ORDER
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!--NENACHADZA sa objednavka-->
                <div class="col s12 m12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row center">
                                <h4 style="justify-content: center;">There are no orders yet</h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include 'src/templates/footer.php';
?>
