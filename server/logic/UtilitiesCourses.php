<?php

include "../tools/connect.php";
include "../tools/protection.php";

$mode = filterRequest("mode");
$id = filterRequest("id");

$coursename = filterRequest("coursename");
$passmark = filterRequest("passmark");

if ($id != null && $mode == "delete") {
    $stmt = $con->prepare("DELETE FROM `courses` WHERE `id` = ?");
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmtSubject = $con->prepare("DELETE FROM `subject` WHERE `idcours` = ?");
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

if ($id != null && $mode == "edit") {
    if ($coursename != null && $passmark != null) {
        $stmt = $con->prepare("UPDATE `courses` SET `coursname` = ?,`passmark` = ? WHERE `id` = ?");
        $stmt->execute([$coursename, $passmark, $id]);
        $count = $stmt->rowCount();
        if ($count > 0) {
            $stmtSubject = $con->prepare("UPDATE `subject` SET `coursname` = ?,`passmark` = ? WHERE `idcours` = ?");
            $stmtSubject->execute([$coursename, $passmark, $id]);
            $countSubject = $stmtSubject->rowCount();
            if ($countSubject > 0) {
                echo json_encode(array("message" => "success"));
            } else {
                echo json_encode(array("message" => "success"));
            }
        } else {
            echo json_encode(array("message" => "fail"));
        }
    } else {
        echo json_encode(array("message" => "problem"));
    }
}