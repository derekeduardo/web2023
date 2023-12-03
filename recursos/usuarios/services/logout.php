<?php 

    session_start();
    session_destroy();
    header("Location: http://localhost/semestral%202023/views/login.php?alert=logout");
    exit();

?>