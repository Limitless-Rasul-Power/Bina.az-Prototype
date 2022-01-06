<?php

$status = $category = $roomCount = $min = $max = $city = '';

if (isset($_GET['status']) && !isset($_GET['filterSubmit'])) {
    $status = $_GET['status'];
}

if (isset($_GET['filterSubmit'])) {
    $status = $_GET['status'];
    $category = $_GET['category'];
    $roomCount = $_GET['roomCount'];
    $min = $_GET['min'];
    $max = $_GET['max'];
    $city = $_GET['city'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://bina.azstatic.com/assets/favicons/favicon-192x192-b40ea6169e17d157d4e6943453ee0f32374348b53abc40010d2ff8c81a2263ec.png" rel="icon" sizes="192x192" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/styles.css" />
    <title>bina.az - En son ev elanlari sayti, Dasinmaz emlak</title>
</head>

<body>
    <header>
        <div class="container-fluid" id="header-bar">
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <p>Dəstək xidməti: (012) 599-08-02; (012) 505-08-02</p>
                    <i class="far fa-chevron-right"></i>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-center">
                <div class="col-4"></div>
                <div class="col-4 d-flex">
                    <a class="navbar-brand" href="?">BİNA.AZ</a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li>
                                <a href="?status=sell">Alqı-satqı</a>
                            </li>
                            <li>
                                <a href="?status=rent">Kirayə</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <a href="?page=register" class="btn btn-success bg-light-green fw-bold">+ Elan yerləşdir</a>
                </div>
            </div>
        </nav>

    </header>
    <main>