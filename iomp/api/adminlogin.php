<?php
include("connect.php");
$admin_id = $_POST['admin_id'];
$adminpass = $_POST['adminpass'];
if (isset($_POST['Signin'])) {
    $check = mysqli_query($connect, "SELECT * FROM admin_login WHERE `admin_id`='" . $admin_id . "' AND `admin_pass`='" . $adminpass . "'");
    if (mysqli_num_rows($check) > 0) {
        session_start();
        $_SESSION['adminlog'] = $_POST['admin_id'];;
        echo '
            <script>
            alert("Login Success!");
            window.location = "/iomp/routes/adminpage.php ";
            </script>
            ';
    } else {
        echo '
            <script>
            alert("Invaid Credentials!");
            window.location = "/iomp/index.html ";
            </script>
            ';
    }
}
