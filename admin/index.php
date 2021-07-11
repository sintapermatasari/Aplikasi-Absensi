<?php
session_start();
include "../config/database.php";
include "../library/controllers.php";
$perintah = new oop();
@$table = "tbl_user";

@$username = $_POST['user'];
@$password = $_POST['pass'];

@$redirect = "hal_admin.php?menu=home";
if (isset($_POST['login'])) {
    $perintah->login($con, $table, $username, $password, $redirect);
}
if (isset($_POST['batal'])) {
    echo "<script>document.location.href='../'</script>";
}
?>
<title>Login</title>
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
            <td><input type="password" name="pass"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><input type="submit" name="login" value="LOGIN">
                <input type="submit" name="batal" value="BATAL">
            </td>
        </tr>
    </table>
</form>