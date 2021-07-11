<?php
include "../config/database.php";

$perintah = new oop();

@$table = "tbl_siswa";
@$query = "query_siswa";
@$where = "nis = $_GET[id]";
@$redirect = "?menu=siswa";
@$tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
@$folder = "../foto";
if (isset($_POST['simpan'])) {
    $foto = $_FILES['foto'];
    $upload = $perintah->upload($foto, $folder);
    $field = array('nis' => $_POST['nis'], 'nama' => $_POST['nama'], 'jk' => $_POST['jk'], 'id_rayon' => $_POST['rayon'], 'id_rombel' => $_POST['rombel'], 'foto' => $upload, 'tgl_lahir' => $tanggal);    
    $perintah->simpan($con, $table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
    $perintah->hapus($con, $table, $where, $redirect);
}

if (isset($_GET['edit'])) {
    $edit = $perintah->edit($con, $query, $where);
    if ($edit['jk'] == "L") {
        $l = "checked";
    } else {
        $p = "checked";
    }
    $date = explode("-", $edit['tgl_lahir']);
    $thn = $date[0];
    $bln = $date[1];
    $tgl = $date[2];
}

if (isset($_POST['ubah'])) {
    $foto = $_FILES['foto'];
    $upload = $perintah->upload($foto, $folder);
    if (empty($_FILES['foto']['name'])) {
        $field = array('nis' => $_POST['nis'], 'nama' => $_POST['nama'], 'jk' => $_POST['jk'], 'id_rayon' => $_POST['rayon'], 'id_rombel' => $_POST['rombel'], 'tgl_lahir' => $tanggal);
        $perintah->ubah($con, $table, $field, $where, $redirect);
    } else {
        $field = array('nis' => $_POST['nis'], 'nama' => $_POST['nama'], 'jk' => $_POST['jk'],'id_rayon' => $_POST['rayon'], 'id_rombel' => $_POST['rombel'], 'foto' => $upload, 'tgl_lahir' => $tanggal);
        $perintah->ubah($con, $table, $field, $where, $redirect);
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <table align="center">
        <tr>
            <td>NIS</td>
            <td> : </td>
            <td><input type="text" name="nis" value="<?php echo @$edit['nis'] ?>" required></td>
        </tr>

        <tr>
            <td>Nama</td>
            <td> : </td>
            <td><input type="text" name="nama" value="<?php echo @$edit['nama'] ?>" required></td>
       </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td> : </td>
            <td><input type="radio" name="jk" required value="L" <?php echo @$l ?> />Laki-laki 
                <input type="radio" name="jk" required value="P" <?php echo @$p ?> />Perempuan
            </td>
        </tr>

        <tr>
            <td>Rayon</td>
            <td> : </td>
            <td><select name="rayon" required>
                    <option value="<?php echo @$edit['id_rayon'] ?>"><?php echo @$edit['rayon'] ?></option>
                    <?php
                    $a = $perintah->tampil($con, "tbl_rayon");
                    foreach ($a as $r) {
                    ?>
                        <option value="<?php echo $r['0'] ?>"><?php echo $r['1'] ?></option>
                    <?php } ?>
                </select></td>
        </tr>

        <tr>
            <td>Rombel</td>
            <td> : </td>
            <td><select name="rombel" required>
                    <option value="<?php echo @$edit['id_rombel'] ?>"><?php echo @$edit['rombel'] ?></option>
                    <?php
                    $a = $perintah->tampil($con, "tbl_rombel");
                    foreach ($a as $r) {
                    ?>
                        <option value="<?php echo $r['0'] ?>"><?php echo $r['1'] ?></option>
                    <?php } ?>
                </select></td>
        </tr>

        <tr>
            <td>Foto</td>
            <td>:</td>
            <td><input type="file" name="foto"></td>
        </tr>

        <tr>
            <td>Tangal Lahir</td>
            <td>:</td>
            <td>
                <select name="tgl" required>
                    <option value="<?php echo @$tgl ?>"><?php echo @$tgl ?></option>
                    <?php
                    for ($tgl = 1; $tgl <= 31; $tgl++) {
                        if ($tgl <= 9) {
                            ?>
                            <option value="<?php echo "0" . $tgl; ?>"><?php echo "0" . $tgl; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $tgl; ?>"><?php echo $tgl; ?></option>            
                        <?php }
                    } ?>
                </select>

                <select name="bln" required>
                    <option value="<?php echo @$bln; ?>"><?php echo @$bln; ?></option>
                    <?php
                    for ($bln = 1; $bln <= 12; $bln++) {
                        if ($bln <= 9) {
                            ?>
                            <option value="<?php echo "0" . $bln; ?>"><?php echo "0" . $bln; ?></option>
                        <?php } else {
; ?>
                            <option value="<?php echo $bln; ?>"><?php echo $bln; ?></option>
    <?php }
} ?>
                </select>

                <select name="thn" required>
                    <option value="<?php echo @$thn; ?>"><?php echo @$thn; ?></option>
                    <?php
                    for ($thn = 1996; $thn <= 2001; $thn++) {
                        ?>
                        <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td>
                <?php if (@$_GET['id'] == "") { ?>
                    <input type="submit" name="simpan" value="Simpan">
                <?php } else { ?>
                    <input type="submit" name="ubah" value="Ubah">
<?php } ?>
            </td>
        </tr>
    </table>
</form>
<br />
<table align="center" border="1">
    <tr>
        <td>No</td>
        <td>Nis</td>
        <td>Nama</td>
        <td>JK</td>
        <td>Rayon</td>
        <td>Rombel</td>
        <td>Foto</td>
        <td>Tanggal Lahir</td>
        <td colspan="2">Aksi</td>
    </tr>

    <?php
    $a = $perintah->tampil($con, "query_siswa");
    $no = 0;
    if ($a == "") {
        echo "<tr><td align='center' colspan='10'>NO RECORD</td></tr>";
    } else {
        foreach ($a as $r) {
            $no++;
            ?>

            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r['nis']; ?></td>
                <td><?php echo $r['nama']; ?></td>
                <td><?php echo $r['jk']; ?></td>
                <td><?php echo $r['rayon'] ?></td>
                <td><?php echo $r['rombel'] ?></td>
                <td><img src="../foto/<?php echo $r['foto'] ?>" width="50" height="50" /></td>
                <td><?php echo $r['tgl_lahir'] ?></td>
                <td><a href="?menu=siswa&hapus&id=<?php echo $r['nis'] ?>" onClick="return confirm('Hapus data ?')"><img src="../images/b_drop.png"></a></td>
                <td><a href="?menu=siswa&edit&id=<?php echo $r['nis'] ?>"><img src="../images/b_edit.png"></a></td>
            </tr>
    <?php } } ?>
</table>
<br>