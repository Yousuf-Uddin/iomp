<?php
$connect = mysqli_connect("localhost", "root", "", "iomp") or die("Error in Connection");

if ($connect) {
    echo '';
} else {
    echo 'not connected';
}
