<?php
$filename = "mission6-2_new.txt";

if (isset($_POST["delete"])) {
    if (file_exists($filename)) {
        unlink($filename); // Delete the file
    }
}

// Redirect back to the main page
header("Location: mission6-2.php");
?>