<?php
    require_once(__DIR__ . '../../../connection/Database.php');
    require_once(__DIR__ . '../../Class/TestDriveServicio.php');
    //LLamar a la instancia de la base de datos
    $db = Database::getInstance();
    $testdriveservicio = new TestDriveServicio($db);

    $testdriveservicio->getListTestDrive();
  
?>