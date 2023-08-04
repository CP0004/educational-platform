<?php

include "../tools/connect.php";
include "../tools/protection.php";

$coursename = filterRequest("coursename");
$idCourse = filterRequest("idCourse");
$idUser = filterRequest("idUser");
$passmark = filterRequest("passmark");

if ($coursename != null && $passmark != null && $idUser != null && $idCourse != null) {
    $stmtCheck = $con->prepare("SELECT * FROM `subject` WHERE `coursname` = ? AND `iduser` = ?");
    $stmtCheck->execute([$coursename, $idUser]);
    $countCheck = $stmtCheck->rowCount();
    if ($countCheck > 0) {
        echo json_encode(array("message" => "exist"));
    } else {
        $stmt = $con->prepare("INSERT INTO `subject`( `coursname`, `idcours`, `iduser`, `passmark`, `studentmark`) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$coursename, $idCourse, $idUser, $passmark, 0]);
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