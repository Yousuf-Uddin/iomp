<?php
include("connect.php");
$email = $_POST['email'];
$password = $_POST['password'];

$check = mysqli_query($connect, "SELECT * FROM user WHERE `email`='" . $email . "' AND `password`='" . $password . "' ");
if (mysqli_num_rows($check) > 0) {
    $result_fetch = mysqli_fetch_assoc($check);
    if ($result_fetch['is_verified'] == 1) {
        if ($_POST['password'] == $result_fetch['password']) {
            session_start();
            $userdata = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM user WHERE `email`='" . $email . "' AND `password`='" . $password . "' "));
            $groupdata = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM nominee WHERE `role`=1 or `role`=2"));
            $_SESSION["userdata"] = $userdata;
            $_SESSION["groupdata"] = $groupdata;
            echo '
            <script>
            alert("Login Success!");
            window.location = "/iomp/api/dashboard.php ";
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Incorrect password!");
            window.location = "../routes/signin.html ";
            </script>
            ';
        }
    } else {
        echo '
        <script>
        alert("Emale not verified");
        window.location = "../routes/signin.html ";
        </script>
        ';
    }
} else {
    echo '
        <script>
            alert("Email not Registered");
            window.location = "../routes/signin.html ";
        </script>
        ';
}
