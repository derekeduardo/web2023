<?php 

    session_start();
    session_destroy();
    header("Location: http://localhost/semestral%202023/index.php?alert=logout");
    exit();

?>