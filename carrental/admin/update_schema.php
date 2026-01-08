<?php
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    echo "Attempting to update schema...\n";
    // Check if column exists first to avoid error on multiple runs
    $check = $dbh->query("SHOW COLUMNS FROM tblpages LIKE 'image1'");
    if($check->rowCount() == 0) {
        $sql = "ALTER TABLE tblpages 
                ADD COLUMN image1 VARCHAR(255) NULL AFTER detail, 
                ADD COLUMN image2 VARCHAR(255) NULL AFTER image1, 
                ADD COLUMN experience_years INT DEFAULT 10 AFTER image2";
        $dbh->exec($sql);
        echo "Columns added successfully.\n";
    } else {
        echo "Columns already exist.\n";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
