<?php

// This script is always a request.
include_once("../constants.php");
include_once(CLASS_PATH . "Category.php");

$categoryId = $_GET["categoryId"];

$name = null;
if (isset($_GET["categoryName"])) {
    $name = $_GET["categoryName"];
}

$hexColor = null;
if (isset($_GET["categoryHexColor"])) {
    $hexColor = $_GET["categoryHexColor"];
}

$category = new Category($categoryId);
$category->editCategory($name, $hexColor);

if ($name == null) {
    $category->deleteCategory();

    if (!isset($_SESSION)) {
        session_start();
    }

    include_once(CLASS_PATH . "Goal.php");

    foreach (Goal::getGoals($_SESSION["user_id"]) as $goal) {
        if ($goal->getCategoryId() == $categoryId) {
            $goal->editGoal(null, -1);
        }
    }

    echo -1;
} else {
    echo $category->getId();
}