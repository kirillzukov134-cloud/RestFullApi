<?php
require "./functions.php";
require "./connectDB.php";

header("Content-Type: application/json");
$method =  $_SERVER['REQUEST_METHOD'];

//Вывод на экран всех | одного пользователя
if ($method === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        selectIDStudent($pdo, $id);
    } else {
        selectAllStudents($pdo); 
    } 
    exit();
    //Добавление пользователя
} elseif ($method === 'POST') {
    addStudents($pdo, $_POST);
    exit();
    //Редактирование пользователя
} elseif ($method === 'PATCH') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        $name = $data['name'];
        $groups = $data['groups'];
        updateStudents($pdo, $id, $name, $groups);
    }else {
        echo json_encode(['error'=> 'Ошибка при добавлении']);
    }
    exit();
//Удаление пользователя
} elseif ($method === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    deleteStudents($pdo, $id);
}








