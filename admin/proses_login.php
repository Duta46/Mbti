<?php
session_start();
include '../inc/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
if ($username == "" or $password == "") {

    echo "<script>alert('username dan atau password tidak boleh kosong')</script>";
    echo"<meta http-equiv=refresh content=0;url=login.php>";

} else{

    $query = mysql_query("SELECT * FROM account WHERE username = '".$username."' AND password = '".md5($password)."' AND divisi = 'Administrator'");

    $rows1 = mysql_fetch_array($query);
    $rows  = mysql_num_rows($query);
    if ($rows == 0) {

        echo "<script>alert('username dan atau password salah')</script>";
        echo"<meta http-equiv=refresh content=0;url=login.php>";

    } else {

        $_SESSION['admin']['id_account'] = $rows1['id_account'];
        $_SESSION['admin']['username']   = $rows1['username'];
        
        echo"<meta http-equiv=refresh content=0;url=index.php>";

    }
} 
?>