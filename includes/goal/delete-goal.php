<?php

/*
 * Deletes a goal.
 * A goal ID is required. $_POST["goalId"].
 * 
 * If the goal does not belong to the user, "unverified" will be returned;
 * otherwise, nothing will be returned.
 */

// This script is always a request.
include_once("../constants.php");
include_once(CLASS_PATH . "Goal.php");

if (!isset($_SESSION)) {
    session_start();
}

$goalId = $_POST["goalId"];

$goal = new Goal($goalId);

if (!$goal->verifyGoalOwnership($_SESSION["user_id"])) {
    echo "unverified";
    exit();
}

$goal->deleteGoal();
