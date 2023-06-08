<?php
$host     = "localhost";
$dbName   = "myers_briggs";
$truecont = mysqli_connect($host, "root", "");

if (!$truecont) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!mysqli_select_db($truecont, $dbName)) {
    die("Tidak Terkoneksi Database");
}
?>
