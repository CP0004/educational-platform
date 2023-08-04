<?php

include "../tools/connect.php";
include "../tools/protection.php";

$mode = filterRequest("mode");
$id = filterRequest("id");
$studentmark = filterRequest("studentmark");

if ($id != null && $mode == "edit" && $studentmark != null) {
    $stmt = $con->prepare("UPDATE `subject` SET `studentmark` = ? WHERE `id` = ?");
    $stmt->execute([$studentmark, $id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("message" => "success"));

    } else {
        echo json_encode(array("message" => "fail"));
    }
} else {
    echo json_encode(array("message" => "problem"));
}