<?php 
// Universal Stats Fetching logic
$sql = "SELECT id from tblusers";
$query = $dbh -> prepare($sql);
$query->execute();
$regusers=$query->rowCount();

$sql1 = "SELECT id from tblvehicles";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$totalvehicle=$query1->rowCount();

$sql2 = "SELECT id from tblbooking";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$bookings=$query2->rowCount();

$sql3 = "SELECT id from tblbrands";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$brands=$query3->rowCount();

$sql4 = "SELECT id from tblsubscribers";
$query4 = $dbh -> prepare($sql4);
$query4->execute();
$subscribers=$query4->rowCount();

$sql5 = "SELECT id from tblcontactusquery";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$queries=$query5->rowCount();

$sql6 = "SELECT id from tbltestimonial";
$query6 = $dbh -> prepare($sql6);
$query6->execute();
$testimonials=$query6->rowCount();
?>

<div class="row" style="margin-bottom: 40px;">
    <!-- Row 1 -->
    <div class="col-md-3">
        <div class="stat-panel text-center">
            <div class="stat-panel-number h1"><?php echo htmlentities($regusers);?></div>
            <div class="stat-panel-title text-uppercase">Reg Users</div>
            <a href="reg-users.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-panel text-center">
            <div class="stat-panel-number h1"><?php echo htmlentities($totalvehicle);?></div>
            <div class="stat-panel-title text-uppercase">Listed Vehicles</div>
            <a href="manage-vehicles.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-panel text-center">
            <div class="stat-panel-number h1"><?php echo htmlentities($bookings);?></div>
            <div class="stat-panel-title text-uppercase">Total Bookings</div>
            <a href="manage-bookings.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-panel text-center">
            <div class="stat-panel-number h1"><?php echo htmlentities($brands);?></div>
            <div class="stat-panel-title text-uppercase">Listed Brands</div>
            <a href="manage-brands.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>

    <!-- Row 2 (Added for 1:1 Dashboard Parity) -->
    <div class="col-md-3" style="margin-top: 30px;">
        <div class="stat-panel text-center">
            <div class="stat-panel-number h1"><?php echo htmlentities($subscribers);?></div>
            <div class="stat-panel-title text-uppercase">Subscribers</div>
            <a href="manage-subscribers.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-md-3" style="margin-top: 30px;">
        <div class="stat-panel text-center">
            <div class="stat-panel-number h1"><?php echo htmlentities($queries);?></div>
            <div class="stat-panel-title text-uppercase">Queries</div>
            <a href="manage-conactusquery.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-md-3" style="margin-top: 30px;">
        <div class="stat-panel text-center">
            <div class="stat-panel-number h1"><?php echo htmlentities($testimonials);?></div>
            <div class="stat-panel-title text-uppercase">Testimonials</div>
            <a href="testimonials.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>
