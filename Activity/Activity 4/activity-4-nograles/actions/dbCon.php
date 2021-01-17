<?php
    $connect = new mysqli('localhost', 'root', '', 'orderSystem');

    if ($connect -> connect_errno) {
        die('Could not connect:');
        exit();
    }
?>