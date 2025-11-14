<?php
namespace App\Controllers;
use App\Models\Task;
use PDO;

//require_once "config/Database.php";

class Database {
    private $pdo = null;

}
class SQLiteDB extends Database
{
    private $pdo = null;
    function __construct($filename) {
        $this->pdo = new PDO("sqlite:../database/$filename");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function ReadQuery(string $query): false|array
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertQuery(string $query, array $values) {
        $statement = $this->pdo->prepare($query);
        $statement->execute($values);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
class TaskController
{
    private SQLiteDB $db;
    public function __construct($filename) {
        $this->db = new SQLiteDB($filename);
    }
    public function getAllTasks(): false|array
    {
        return $this->db->ReadQuery("SELECT * FROM tasks");
    }
    public function renderAllTasks(): void
    {
        $tasks = $this->getAllTasks();
        foreach ($tasks as $task) {
            if ($task["status"] == 1) {
                echo '<div class="b-task-list__item b-task-list__item--checked">';
                echo "<input type=\"checkbox\" id=\"task{$task["id"]}\" name=\"task{$task["id"]}\" class=\"b-task-item__checkbox\" checked>";
            } else {
                echo '<div class="b-task-list__item">';
                echo "<input type=\"checkbox\" id=\"task{$task["id"]}\" name=\"task{$task["id"]}\" class=\"b-task-item__checkbox\">";
            }
            echo "<label for=\"task{$task["id"]}\" class=\"b-task-item__label\">$task[title]</label>";
            echo '<button><i class="fa-solid fa-ellipsis-vertical"></i></button>';
            echo '</div>';
        }
    }
    public function addTaskToDB(Task $task) {
        return $this->db->InsertQuery("INSERT INTO tasks (title, status) VALUES (?,?)",
            [$task->getTitle(), $task->getStatus()]);
    }


}
