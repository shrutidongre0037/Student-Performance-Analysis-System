<?php
include("db_connect.php");
if(isset($_GET["fname"]))
{
    $file_path=$_GET["fname"];
//     echo $file_path = 'files/upload/'.$fnm;
//  die(0);
// Check if the file exists
if (file_exists($file_path)) {
    // Set the appropriate headers for the file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
 
    // Read and output the file content
    readfile($file_path);
} else {
    // File not found
    echo "File not found.";
}
}

?>