<?php
session_start();
include 'inc/koneksi.php';

// Mengambil data username dan password dari form login
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == "" or $password == "") {
    echo "<script>alert('Username dan/atau password tidak boleh kosong')</script>";
    echo "<meta http-equiv=refresh content=0;url=login.php>";
} else {
    // Query untuk mengambil akun dari database
    $query = "SELECT * FROM account WHERE username = '".$username."' AND password = '".md5($password)."'";
    $result = mysqli_query($truecont, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($truecont));
    }

    $rows = mysqli_num_rows($result); // Check the number of rows

    if ($rows == 0) {
        echo "<script>alert('Username dan/atau password salah')</script>";
        echo "<meta http-equiv=refresh content=0;url=login.php>";
    } else {
        // Login berhasil
        $row1 = mysqli_fetch_array($result, MYSQLI_BOTH);
        mysqli_free_result($result); // Free the result object after use
        mysqli_close($truecont); // Close the database connection

        // Penempatan account sesuai divisi
        $_SESSION['account_myers_briggs']['id']       = $row1['id_account'];
        $_SESSION['account_myers_briggs']['username'] = $row1['username'];
        $_SESSION['account_myers_briggs']['divisi']   = $row1['divisi'];

        // Redirect ke halaman sesuai divisi
        if ($row1['divisi'] == 'Mahasiswa') {
            header("Location: mahasiswa/index.php");
            exit();
        } else if ($row1['divisi'] == 'DPA') {
            header("Location: dpa/index.php");
            exit();
        } else if ($row1['divisi'] == 'Administrator') {
            header("Location: admin/index.php");
            exit();
        }
    }
}
?>
