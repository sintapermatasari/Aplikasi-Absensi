<?php
include "../config/database.php";

$perintah = new oop();

@$table = "tbl_rayon";
@$where = "id_rayon = $_GET[id]";
@$redirect = "?menu=rayon";
@$field = array('rayon' => $_POST['rayon']);

if (isset($_POST['simpan'])) {
    $perintah->simpan($con, $table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
    $perintah->hapus($con, $table, $where, $redirect);
}

if (isset($_GET['edit'])) {
    $edit = $perintah->edit($con, $table, $where);
}
if (isset($_POST['ubah'])) {
    $perintah->ubah($con, $table, $field, $where, $redirect);
}
?>

<form method="post">
    <table align="center">
        <tr>
            <td>Rayon</td>
            <td>:</td>
            <td><input type="text" name="rayon" value="<?php echo @$edit['rayon'] ?>" required placeholder="Rayon"></td>
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
        <td>Rayon</td>
        <td colspan="2">Aksi</td>
    </tr>
    <?php
    $a = $perintah->tampil($con, $table);
    $no = 0;
    if ($a == "") {
        echo "<tr><td align='center' colspan='4'>NO RECORD</td></tr>";
    } else {
        foreach ($a as $r) {
            $no++;
            ?>             
            <tr> 
                <td><?php echo $no; ?></td>
                <td><?php echo $r['rayon'] ?></td>
                <td><a href="?menu=rayon&edit&id=<?php echo $r['id_rayon'] ?>"><img src="../images/b_edit.png"></a></td>
                <td><a href="?menu=rayon&hapus&id=<?php echo $r['id_rayon'] ?>" onClick="return confirm ('Hapus Data ?')"><img src="../images/b_drop.png"></a></td>
            </tr>                                      
        <?php }
    } ?>
</table>
<br />

