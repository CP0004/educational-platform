<?php

include "../tools/connect.php";
include "../tools/protection.php";

$id = filterRequest("id");

if ($id != null) {

    $stmt = $con->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $stmt->execute([$id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmtSubject = $con->prepare("SELECT * FROM `subject` WHERE `iduser` = ?");
        $stmtSubject->execute([$id]);
        $countSubject = $stmtSubject->rowCount();
        if ($countSubject > 0) {
            $subject = $stmtSubject->fetchAll(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(array("users" => $user, "subject" => $subject));
        } else {
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(
                array(
                    "users" => $user,
                    "subject" => array(
                        array(
                            "id" => 0,
                            "coursname" => "",
                            "idcours" => 0,
                            "iduser" => 0,
                            "passmark" => 0,
                            "studentmark" => 0
                        )
                    )
                )
            );
        }
    } else {
        echo json_encode(array("message" => "fail"));
    }
} else {
    echo json_encode(array("message" => "problem"));
}