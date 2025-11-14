<?php
require_once '../vendor/autoload.php';
use App\Controllers\TaskController;
use App\Models\Task;


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["taskTitle"])) {
        $title = htmlspecialchars($_POST["taskTitle"]);
        $task = new Task($title, 0);
        $taskController = new TaskController("tasks.sqlite");
        $taskController->addTaskToDB($task);
        header("Location: index.php");
        exit();
}

