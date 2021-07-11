<?php
date_default_timezone_set('Asia/Jakarta');

include "../config/database.php";

$perintah = new oop();

@$tgl= $_GET['tgl'];
@$bln = $_GET['bln'];
@$thn = $_GET['thn'];

@$id = $_GET['id'];
@$where = "nis = $_GET[nis]";
@$query = "query_absen";
@$table = "tbl_rombel";

if (!empty($_GET['rombel'])) {
    $isinya = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'"));
}
?>
<form method="post" >
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
       	</tr>

        <tr>
            <td>Tangal Absen</td>
            <td>:</td>
            <td>
                <select name="tgl">
                    <option value="<?php echo @$tgl ?>"><?php echo @$tgl ?></option>
                    <?php
                    for ($tgl = 1; $tgl <= 31; $tgl++) {
                        if ($tgl <= 9) {
                    ?>
                        <option value="<?php echo "0" . $tgl; ?>"><?php echo "0" . $tgl; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $tgl; ?>"><?php echo $tgl; ?></option>            
                    <?php
                        }
                    }
                    ?>
                </select>

                <select name="bln">
                    <option value="<?php echo @$bln; ?>"><?php echo @$bln; ?></option>
                    <?php
                    for ($bln = 1; $bln <= 12; $bln++) {
                        if ($bln <= 9) {
                    ?>
                        <option value="<?php echo "0" . $bln; ?>"><?php echo "0" . $bln; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $bln; ?>"><?php echo $bln; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <select name="thn">
                    <option value="<?php echo @$thn; ?>"><?php echo @$thn; ?></option>
                    <?php
                    for ($thn = 2017; $thn <= 2020; $thn++) {
                    ?>
                    <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                    <?php } ?>
                </select>           	
            </td>
        </tr>

        <td><input type="submit" name="cetak" value="Cetak" /></td>
    </table>
    <hr />
    <?php
    if (isset($_POST['cetak'])) {
        echo "<script>document.location.href='?menu=ubahabsen&rombel=$_POST[rombel]&thn=$_POST[thn]&bln=$_POST[bln]&tgl=$_POST[tgl]'</script>";
    }
    if (!empty($_GET['rombel'])) {
        ?>   
        <br>
        <table border="1" cellspacing="0" align="center">
            <tr align="center">
                <td rowspan="2">No</td>
                <td rowspan="2">NIS</td>
                <td rowspan="2">Nama</td>
                <td rowspan="2">Rombel</td>
                <td colspan="4" align="center">Keterangan</td>
            </tr>

            <tr>
                <td>Hadir</td>
                <td>Sakit</td>
                <td>Izin</td>
                <td>Alpa</td>
            </tr>
            <?php
            $a = $perintah->tampil($con, "query_absen WHERE id_rombel = '$_GET[rombel]' and tgl_absen = '$_GET[thn]-$_GET[bln]-$_GET[tgl]'");
            $no = 0;
            if ($a == "") {
                echo "<tr><td align='center' colspan='8'>NO RECORD</td></tr>";
            } else {
                foreach ($a as $r) {
                    $no++;

                    if ($r['hadir'] == 1) {
                        $hadir = "checked";
                        $sakit = "";
                        $ijin = "";
                        $alpa = "";
                    }
                    if ($r['sakit'] == 1) {
                        $hadir = "";
                        $sakit = "checked";
                        $ijin = "";
                        $alpa = "";
                    }
                    if ($r['ijin'] == 1) {
                        $hadir = "";
                        $sakit = "";
                        $ijin = "checked";
                        $alpa = "";
                    }
                    if ($r['alpa'] == 1) {
                        $hadir = "";
                        $sakit = "";
                        $ijin = "";
                        $alpa = "checked";
                    }
                    ?>

                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $r['nis'] ?></td>
                        <td><?php echo $r['nama'] ?></td>
                        <td><?php echo $r['rombel'] ?></td>
                        <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="hadir" <?php echo $hadir ?>/></td>
                        <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="sakit" <?php echo $sakit ?>/></td>
                        <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="ijin" <?php echo $ijin ?>/></td>
                        <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="alpa" <?php echo $alpa ?>/></td>
                    </tr>    

                    <?php
                    $tgl = $_GET['thn']."-".$_GET['bln']."-".$_GET['tgl'];
                    $table = "tbl_absen";
                    $redirect = '?menu=ubahabsen';
                    $where = "nis = $r[nis]";

                    if (@$_POST['keterangan' . $r['nis']] == 'hadir') {
                        $field = array('nis' => $r['nis'], 'hadir' => '1', 'sakit' => '0', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);
                    } elseif (@$_POST['keterangan' . $r['nis']] == 'sakit') {
                        $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '1', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);
                    } elseif (@$_POST['keterangan' . $r['nis']] == 'ijin') {
                        $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '1', 'alpa' => '0', 'tgl_absen' => $tgl);
                    } else {
                        $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '0', 'alpa' => '1', 'tgl_absen' => $tgl);
                    }
                    if (isset($_REQUEST['ubah'])) {
                        $perintah->ubah($con, $table, $field, $where, $redirect);
                    }
                }
                ?>
                <tr>
                    <td colspan="10" align="center"><input type="submit" name="ubah" value="Ubah"></td>
                </tr>
            </table>
            <?php
        }
    }
    ?>
</form>
<br />

