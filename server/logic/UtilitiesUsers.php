<?php

include "../tools/connect.php";
include "../tools/protection.php";

$mode = filterRequest("mode");
$id = filterRequest("id");

if ($id != null && $mode == "delete") {
    $stmt = $con->prepare("DELETE FROM `users` WHERE `id` = ?");
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmtSubject = $con->prepare("DELETE FROM `subject` WHERE `iduser` = ?");
        $stmtSubject->execute([$id]);
        $countSubject = $stmtSubject->rowCount();
        if ($countSubject > 0) {
            echo json_encode(array("message" => "success"));
        } else {
            echo json_encode(array("message" => "success"));
        }
    } else {
        echo json_encode(array("message" => "fail"));
    }
}

if ($id != null && $mode == "inactive") {
    $stmt = $con->prepare("UPDATE `users` SET `isActive`= 0 WHERE `id` = ?");
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("message" => "success"));
    } else {
        echo json_encode(array("message" => "fail"));
    }
}

if ($id != null && $mode == "activated") {
    $stmt = $con->prepare("UPDATE `users` SET `isActive`= 1 WHERE `id` = ?");
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("message" => "success"));
    } else {
        echo json_encode(array("message" => "fail"));
    }
}