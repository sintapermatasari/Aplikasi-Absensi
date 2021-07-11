<?php
include "../config/database.php";
$perintah = new oop();

@$table = "tbl_user";

@$user = $_POST['user'];
@$pass = base64_encode($_POST['pass']);
@$field = array('username'=>$user,'password'=>$pass);
@$redirect = "?menu=user";

if(isset($_POST['simpan'])){
    $perintah->simpan($con, $table, $field, $redirect);
}

?>

<form method="post">
    <table align="center">
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="text" name="pass"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="simpan" value="Simpan"></td>
        </tr>
    </table>
</form>
<br />