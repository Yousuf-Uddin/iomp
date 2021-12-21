<?php
include("connect.php");
$name = $_POST['name'];
$info = $_POST['info'];
$role = $_POST['role'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$insert = mysqli_query($connect, "INSERT INTO nominee (`name`,`info`,`role`,`photo`,`votes`) VALUES('$name','$info','$role','$image',0)");
echo '
        <script>
            alert("!Registration Successful!");
            window.location="../routes/adminpage.php";
        </script>
        ';
