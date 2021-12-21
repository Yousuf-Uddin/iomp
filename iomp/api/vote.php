<?php
session_start();
require('connect.php');

$votes = $_POST['gvotes'];
$total_votes = ++$votes;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

$update_votes = mysqli_query($connect, "UPDATE nominee SET votes='" . $total_votes  . "' where   id='" . $gid . "' ");
$update_user_status = mysqli_query($connect, "UPDATE user SET status=1 where   id='$uid' ");

if ($update_votes and $update_user_status) {
    $groupdata = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM nominee WHERE `role`= 1 or  `role`=2"));
    $_SESSION["userdata"]["status"] = 1;
    $_SESSION["groupdata"] = $groupdata;
    echo '<script>
    window.location = "../api/dashboard.php ";
    </script>';
} else {
    echo '<script>
    alert("Some error occured");
    window.location = "../api/dashboard.php ";

    </script>';
}
