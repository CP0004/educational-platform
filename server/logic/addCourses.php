<?php

include "../tools/connect.php";
include "../tools/protection.php";

$coursename = filterRequest("coursename");
$passmark = filterRequest("passmark");

if ($coursename != null && $passmark != null) {

    $stmtCheck = $con->prepare("SELECT * FROM `courses` WHERE `coursname` = ?");
    $stmtCheck->execute([$coursename]);
    $countCheck = $stmtCheck->rowCount();
    if ($countCheck > 0) {
        echo json_encode(array("message" => "exist"));
    } else {
        $stmt = $con->prepare("INSERT INTO `courses`( `coursname`, `passmark`) VALUES (?, ?)");
        $stmt->execute([$coursename, $passmark]);
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