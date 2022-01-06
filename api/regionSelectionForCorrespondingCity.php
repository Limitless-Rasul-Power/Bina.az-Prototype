<?php
require_once "../db.php";
require_once "../functions.php";

$cityId = $_GET['cityId'];

$result = getQueryResult($conn, "SELECT * FROM `region` WHERE cityId = $cityId");

echo json_encode($result, JSON_UNESCAPED_UNICODE);
