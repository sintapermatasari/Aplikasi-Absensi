<?php
@session_start();

include "../config/database.php";
include "../library/controllers.php";

$perintah = new oop();

$perintah->tampil($con, "tbl_user WHERE username = '$_SESSION[username]'");

if (empty($_SESSION['username'])) {
    echo "<script>alert('Silahkan login terlebih dahulu');document.location.href='index.php'</script>";
}
?>	
<!DOCTYPE html>
<html>
    <head>
        <title>SIM ABSENSI</title>
        <link rel="stylesheet" href="../css/style.css" type="text/css" />
    </head>
    <body>
        <div id="utama">
            <ul class="menu">

                <li><a href="?menu=home">Home</a></li>
                <li><a href="#">Input</a>

                    <ul>
                        <li><a href="?menu=siswa">Siswa</a></li>
                        <li><a href="?menu=rayon">Rayon</a></li>
                        <li><a href="?menu=rombel">Rombel</a></li>
                        <li><a href="?menu=user">User</a></li>
                    </ul>

                </li>
                <li><a href="#">Absensi</a>

                    <ul>
                        <li><a href="?menu=absen">Absen</a></li>
                        <li><a href="?menu=ubahabsen">Ubah Absen</a></li>
                    </ul>

                </li>
                <li><a href="?menu=laporan">Laporan</a></li>
                <li><a href="logout.php" onClick="return confirm ('Anda Yakin Ingin Keluar ?')">Keluar</a></li>

            </ul>

            <div class="konten">
                <?php
                switch ($_GET['menu']) {
                    case "home";
                        include "home.php";
                        break;

                    case "siswa";
                        include "siswa.php";
                        break;

                    case "rombel";
                        include "rombel.php";
                        break;

                    case "rayon";
                        include "rayon.php";
                        break;
                    
                    case "user";
                        include "user.php";
                        break;

                    case "absen";
                        include "absen.php";
                        break;

                    case "ubahabsen";
                        include "absensi_ubah.php";
                        break;

                    case "laporan";
                        include "laporan.php";
                        break;
                }
                ?>
            </div> 
        </div>
    </body>
</html>

