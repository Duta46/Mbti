<?php
session_start();
// atau menghapus semua session yang pernah dibuat dengan :
unset($_SESSION["account_myers_briggs"]);
header('Location: index.php');

?>