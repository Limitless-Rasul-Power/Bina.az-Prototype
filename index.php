<?php

require "db.php";
require "functions.php";

$page = isset($_GET['page']) ? $_GET['page'] : "pages/main";
$file = $page ? $page . ".php" : "";

include "pages/header.php";
include $file;
include "pages/footer.php";
