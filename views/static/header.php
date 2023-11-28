<?php
    $title_info = "Welcome!";
    if (isset($_GET['brand'])){
        $marca = $_GET['brand'];
        $marca_c = ucfirst($marca);
        $title_info = ucfirst($marca);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_info ?></title>
</head>
<body>    