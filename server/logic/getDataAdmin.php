<?php

include "../tools/connect.php";
include "../tools/protection.php";

$stmtUsers = $con->prepare("SELECT * FROM `users`");
$stmtUsers->execute();
$countUser = $stmtUsers->rowCount();

$stmtCourses = $con->prepare("SELECT * FROM `courses`");
$stmtCourses->execute();
$countCourses = $stmtCourses->rowCount();

if ($countUser > 0) {
    $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
    $courses = $stmtCourses->fetchAll(PDO::FETCH_ASSOC);
    if ($countCourses > 0) {
        echo json_encode(array("users" => $users, "courses" => $courses));
    } else {
        echo json_encode(array("users" => $users, "courses" => array()));
    }
} else {
    echo json_encode(array("message" => "fail"));
}