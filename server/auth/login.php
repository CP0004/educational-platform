<?php

include "../tools/connect.php";
include "../tools/protection.php";

$email = filterRequest("email");
$password = filterRequest("password");

if ($email != null && $password != null) {

    $stmt = $con->prepare("SELECT * FROM users WHERE `email` = ? AND `password` = ?");
    $stmt->execute([$email, $password]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($user);
      //  echo json_encode(array("message" => "success"));
    } else {
        echo json_encode(array("message" => "fail"));
    }
} else {
    echo json_encode(array("message" => "problem"));
}