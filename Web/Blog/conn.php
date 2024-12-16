<?php
    $conn = new mysqli('localhost','root','','BLOGTIENGANH');
    if($conn->error === 0)
    {
        die("Error: Could not connect to the database. An error ".$conn->error." ocurred.");
    }
    //Chọn hệ ký tự là utf8 để có thể in ra tiếng Việt.
    $conn->set_charset('utf8');
?>