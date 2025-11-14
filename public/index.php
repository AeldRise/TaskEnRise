<?php
require_once '../vendor/autoload.php';
use App\Controllers\TaskController;
use App\Models\Task;

$taskController = new TaskController("tasks.sqlite");
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TaskEnRise - Главная страница</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5b8b611ecc.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="b-layout">
    <header class="b-header">
        <h1 class="b-header__title">Мои задачи</h1>
        <div class="b-header__add-task">
            <form action="taskAddHandler.php" method="post" class="b-add-task">
                <input type="text"
                       id="taskTitle"
                       name="taskTitle"
                       class="b-add-task__input"
                       required placeholder="Введите заголовок задачи">
                <button type="submit"
                        class="b-add-task__button">Добавить задачу
                </button>
            </form>
        </div>
    </header>
    <main class="b-main">
        <div class="b-main__task-list">
            <?php
            $taskController->renderAllTasks();
            ?>
        </div>
    </main>
</div>
</body>
</html>
