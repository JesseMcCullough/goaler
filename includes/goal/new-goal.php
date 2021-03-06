<?php

/*
 * Creates a new goal.
 * 
 * A categoryId is required. $_POST["categoryId"].
 * A goal name is required. $_POST["goal"].
 * A goal's steps are required, JSON encoded. $_POST["steps"].
 * 
 * If the category does not belong to the user, "unverified" will be returned;
 * otherwise, the new goal's ID will be returned.
 */

// This script is always a request.
include_once("../constants.php");
include_once(CLASS_PATH . "Goal.php");
include_once(CLASS_PATH . "Category.php");

if (!isset($_SESSION)) {
    session_start();
}

$categoryId = $_POST["categoryId"];
$goalName = $_POST["goal"];
$steps = json_decode($_POST["steps"]);

$category = new Category($categoryId);

if (!$category->verifyCategoryOwnership($_SESSION["user_id"])) {
    echo "unverified";
    exit();
}

$goal = new Goal(null);

$goal->createGoal($goalName, $categoryId, $_SESSION["user_id"]);

for ($x = 0; $x < count($steps); $x++) {
    // [$x][0] = name, [$x][1] = date, [$x][2] = optional id
    $goal->addStep($steps[$x][0], $steps[$x][1]);
}

echo $goal->getId();
