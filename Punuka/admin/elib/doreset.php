<?php

session_start();
include "db_conn.php";

if (!isset($_SESSION["staff_id"])) {
    header("Location: ../../");
} else {

    $staff_id = $_SESSION["staff_id"];
}

$ad = $mysqli->query("show tables");


while ($row = $ad->fetch_array()) {
    if ($row[0] != "users" && $row[0] != "user_count" && $row[0] != "admin") {

        $mysqli->query("delete from $row[0]");
    }
}
?>