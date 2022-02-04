<?php

include_once("includes/autoloader.php");

if (!isset($_SESSION)) {  
    session_start();
}

$scripts = [];
function addJavaScript($path) {
    global $scripts;
    $scripts[] = $path;
}

addJavaScript("select-category");
addJavaScript("new-category");

?>
<!DOCTYPE html>
<html>
<head> 
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Home</title>
</head>
<body>
    <div class="new-category">
        <div class="overlay"></div>
        <div class="container">
            <span class="title">Edit Categories</span>
            <input type="color" name="category-hex-color" />
            <input type="text" name="category-name" placeholder="New Category" />
            <button type="button" class="add-category">Add</button>
            <?php 
            
            $_GET["showNewCategory"] = false;
            include("includes/categories.php");

            ?>
        </div>
    </div>

    <div class="container">
    