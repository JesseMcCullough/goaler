<?php

include_once("includes/header.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include_once(CLASS_PATH . "User.php");
$user = new User($_SESSION["user_id"]);

?>

<span id="greeting">Hi, <?php echo $user->getFirstName(); ?></span>
<a href="includes/logout.php" id="logout">Logout</a>
<h1>What do you want to accomplish?</h1>
<form action="edit-goal.php" method="POST" class="goal">
    <input type="text" name="goal" placeholder="I want to ..." />
    <input type="hidden" name="categoryIdPreselect" />
    <button type="submit" class="go">Go</button>
</form>

<?php include(INCLUDE_PATH . "category/categories.php"); ?>

<div class="divider"></div>

<div class="goals">
    <?php

    include(CLASS_PATH . "Goal.php");;

    $goals = Goal::getGoals($_SESSION["user_id"]);
    foreach ($goals as $goal) {
        include(INCLUDE_PATH . "goal/view-goal.php");
    }

    ?>
</div>

<?php 

addJavaScript("click-to-view-goal");
addJavaScript("sort-goals");
addJavaScript("new-goal-category-preselect");

include_once(INCLUDE_PATH . "footer.php");

?>
