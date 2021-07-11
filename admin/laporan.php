<?php
date_default_timezone_set('Asia/Jakarta');

include "../config/database.php";

$perintah = new oop();

if (!empty($_GET['rombel'])) {
    $isinya = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]' "));
}
?>
<title>Laporan Absensi</title>
<br>
<center>
    <font size="+3">Form Laporan Absensi</font>
</center>
<hr>
<form method="post">
    <table align="center">
        <tr>
            <td>Pilih Rombel</td>
            <td>:</td>
            <td>
                <select name="rombel">
                    <option value="<?php echo @$isinya['id_rombel'] ?>"><?php echo @$isinya['rombel'] ?></option>
                    <?php
                    $a = $perintah->tampil($con, "tbl_rombel");
                    foreach ($a as $r) {
                        ?>
                        <option value="<?php echo $r['0'] ?>"><?php echo $r['1'] ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <input type="submit" name="cetak" value="CEK">
                <?php
                if (isset($_POST['cetak'])){
                ?>
                <strong><a href="laporan_today.php?menu=laporan&rombel=<?php echo @$_POST[rombel]?>" style="color:white" target="_blank">LIHAT</a></strong>
                <?php } ?>

            </td>
        </tr>
    </table>
    <br/>
    
</form>
<br />

