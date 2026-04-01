<?php
function selectAllStudents($pdo){
    $sql = 'SELECT * FROM students';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
}

function selectIDStudent($pdo, $id){
    $id - $_GET['id'];
    $sql = 'SELECT `name`, `groups` FROM `students` WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=> $id]);
    $results = $statement->fetch(PDO::FETCH_ASSOC);
        if($statement->rowCount() > 0){
            echo json_encode($results);
            http_response_code(200);
        }else {
            http_response_code(404);
            echo json_encode([
                'status'=> false,
                'msg'=> 'There is no such user!'
            ]);
        }
}

function addStudents($pdo, $data){
    $sql = 'INSERT INTO students (name, groups) VALUES (:name, :groups)';
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    $response = [
        'status'=> true,
        'msg'=> 'Успех'
    ];
    echo json_encode($response);
}

function updateStudents($pdo, $id, $name, $groups) {
$sql = 'UPDATE students SET name = :name, groups = :groups WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->execute(['id'=> $id,'name'=> $name,'groups'=> $groups]);
$response = [
    'id'=> $id,
    'name'=> $name,
    'groups'=> $groups
];
echo json_encode($response);
}


function deleteStudents($pdo, $id){
    $sql = 'DELETE FROM students WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute(['id'=> $id]);
    if($statement->rowCount() > 0){
        http_response_code(200);
        echo json_encode([
        'status'=> true,
        'msg'=> 'Успешное удаление']);
    } else {
    http_response_code(404);
    echo json_encode([
        'status'=> false,
        'msg'=> 'Ошибка при удалении'
    ]);
    }
}