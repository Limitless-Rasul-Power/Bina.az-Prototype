<?php

include "filter.php";

$columns = "b.id buildingId, b.status buildingStatus, b.rentOption buildingRentOption, b.address buildingAddress,
b.pictures buildingPictures, b.price buildingPrice, b.roomCount buildingRoomCount, b.area buildingArea, 
b.floor buildingFloor, b.maxFloor buildingMaxFloor, b.documentStatus buildingDocumentStatus, 
b.mortgageStatus buildingMortgageStatus, c.name cityName, p.postDate publisherPostDate";

$sql = "SELECT $columns FROM `building` b INNER JOIN `region` r ON b.regionId = r.id INNER JOIN `city` c ON r.cityId = c.id INNER JOIN `publisher` p ON b.userId = p.Id";

if (isset($_GET['status']) && !isset($_GET['filterSubmit'])) {
    $status = $_GET['status'];
    $sql .= " WHERE b.status = '$status'";
}

if (isset($_GET['filterSubmit'])) {
    $status = $_GET['status'];
    $category = $_GET['category'];
    $roomCountCondition = is_numeric($_GET['roomCount']) ? 'b.roomCount = ' . $_GET['roomCount'] . '' : "b.roomCount is TRUE";
    $min = $_GET['min'] == "" ? 0 : $_GET['min'];
    $max = $_GET['max'] == "" ? getQueryResult($conn, "SELECT MAX(b.price) maxPrice FROM `building` b")[0]['maxPrice'] : $_GET['max'];
    $cityCondition = is_numeric($_GET['city']) ? 'c.id = ' . $_GET['city'] . '' : "c.id is TRUE";

    $sql .= " WHERE b.status = '$status' AND b.categoryId = $category AND $roomCountCondition AND 
              b.price >= $min AND b.price <= $max AND $cityCondition";
}


$result = getQueryResult($conn, $sql);

if (!count($result)) :

?>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <h2 class="text-center">Axtarışınıza uyğun nəticə tapılmadı :( </h2>
        </div>
    </div>

<?php else : ?>

    <?php
    usort($result, function ($a, $b) {
        $first =  strtotime($a['publisherPostDate']);
        $second = strtotime($b['publisherPostDate']);

        return $second <=> $first;
    });

    ?>

    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <?php

            foreach ($result as $row) :
            ?>

                <?php
                $firstPicture = explode(",", $row['buildingPictures'])[0];
                $bId = $row['buildingId'];
                $path = "img/$bId/$firstPicture";
                $rentInfo = $row['buildingStatus'] == 'rent' ? "/" . $row['buildingRentOption'] : "";
                ?>

                <div class="col-3 ps-0 mb-08rem">
                    <div class="card shadow p-0 position-relative" onclick="showHome(<?= $bId ?>)">
                        <img src="https://bina.azstatic.com/assets/shared/icon-docs-92caef8dd4c13559ef209c25efb8dba05a7e5a5b54e20ecbd60f6abbedb612b1.svg" alt="Kupça var" class=" position-absolute <?= $row['buildingDocumentStatus'] ? 'd-block' : 'd-none' ?>" style="top: 8px; left: 5px;" />
                        <img src="https://bina.azstatic.com/assets/shared/mortgage-icon-a7ff2a5ff009e18431a6f92a569c1b6a9c2ff44a85d14d3e9c787035f64ebeaf.svg" alt="İpoteka var" class=" position-absolute <?= $row['buildingMortgageStatus'] ? 'd-block' : 'd-none' ?>" style="top: 10px; left: <?= $row['buildingDocumentStatus'] ? 40 : 5 ?>px;" />

                        <div class="inner">
                            <img class="card-img-top" style="width: 328px;height:245px;" src="<?= $path ?>" alt="Home Picture" />
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"> <?= number_format($row['buildingPrice']) ?> ₼ <?= $rentInfo ?></h5>
                            <div class="pb-1"><?= $row['buildingAddress'] ?></div>
                            <div class="card-text">
                                <ul type="square" class="d-flex p-0 mb-0 pb-2">
                                    <li class="list-unstyled"><?= $row['buildingRoomCount'] ?> otaqlı</li>
                                    <li class="ms-4"><?= $row['buildingArea'] ?> <span>m<sup>2</sup></span> </li>
                                    <li class="ms-4"><?= $row['buildingFloor'] ?>/<?= $row['buildingMaxFloor'] ?> mərtəbə</li>
                                </ul>
                            </div>
                            <p class="text-muted mb-0"><?= $row['cityName'] ?>, <?= $row['publisherPostDate'] ?></p>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function showHome(buildingId) {
            location.href = `?page=show&buildingId=${buildingId}`;
        }
    </script>

<?php endif; ?>