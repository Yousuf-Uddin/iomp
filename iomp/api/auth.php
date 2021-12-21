<?php
include("connect.php");
if (isset($_GET['email']) && isset($_GET['vcode'])) {
    $query = "SELECT * FROM user WHERE `email`='$_GET[email]' AND `verification_code`='$_GET[vcode]' ";
    $result = mysqli_query($connect, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['is_verified'] == 0) {
                $update = " UPDATE user SET `is_verified`='1' WHERE `email`= '" . $result_fetch['email'] . "'";
                if (mysqli_query($connect, $update)) {
                    echo '
                    <script>
                        alert("E-mail verification Successful!");
                        window.location = "http://localhost/iomp/routes/signin.html";
                    </script>
                    ';
                } else {
                    echo '
                    <script>
                    alert("Cannot run Query");
                    window.location = "./ ";
                  </script>
                ';
                }
            } else {
                echo '
                <script>
                    alert("!!!Email already Verified!!!");
                    window.location = "../ ";
                </script>
                ';
            }
        }
    } else {
        echo '
        <script>
            alert("Cannot run Query");
            window.location = "../ ";
        </script>
        ';
    }
}
