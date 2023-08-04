<?php

include "tools/connect.php";
include "tools/protection.php";

$stmt = $con->prepare("SELECT * FROM `users`");
$stmt->execute();

$count = $stmt->rowCount();

if ($count > 0) {
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
} else {
    echo json_encode(array("message" => "fail"));
}