<?php
include('includes/config.php');
try {
    $q = $dbh->prepare("DESCRIBE tblpages");
    $q->execute();
    $rows = $q->fetchAll(PDO::FETCH_ASSOC);
    foreach($rows as $r) {
        echo $r['Field'] . " - " . $r['Type'] . "\n";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
