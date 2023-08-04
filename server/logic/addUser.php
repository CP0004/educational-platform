<?php

include "../tools/connect.php";
include "../tools/protection.php";

$username = filterRequest("username");
$email = filterRequest("email");
$password = filterRequest("password");

if ($username != null && $email != null && $password != null) {

    $stmtCheck = $con->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $stmtCheck->execute([$email]);
    $countCheck = $stmtCheck->rowCount();
    if ($countCheck > 0) {
        echo json_encode(array("message" => "exist"));
    } else {
        $stmt = $con->prepare("INSERT INTO `users`( `username`, `email`, `password`, `isTeacher`, `isActive`) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, 0, 0]);
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo json_encode(array("message" => "success"));
        } else {
            echo json_encode(array("message" => "fail"));
        }
    }
} else {
    echo json_encode(array("message" => "problem"));
}