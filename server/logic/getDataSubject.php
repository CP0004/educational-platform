<?php

include "../tools/connect.php";
include "../tools/protection.php";

$id = filterRequest("id");

if ($id != null) {
    $stmt = $con->prepare("SELECT * FROM `subject` WHERE `idUser` = ?");
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $subject = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($subject);
    } else {
        echo json_encode(array("message" => "fail"));
    }
} else {
    echo json_encode(array("message" => "problem"));
}