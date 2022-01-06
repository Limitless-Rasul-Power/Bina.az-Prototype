<?php

include "filter.php";

$bId = $_GET['buildingId'];

$columns = "b.pictures, b.status, b.price, b.area, b.roomCount, b.floor, b.maxFloor, b.desc, b.address, b.rentOption,
b.documentStatus, b.mortgageStatus, a.name as category, r.name as region,  p.fullName, p.ownership, p.email, p.phone,
c.name city";

$sql = "SELECT $columns FROM `building` b INNER JOIN `apartment` a ON b.categoryId = a.id INNER JOIN `publisher` p ON b.userId = p.id 
INNER JOIN `region` r ON b.regionId = r.Id INNER JOIN `city` c ON r.cityId = c.Id WHERE b.id = $bId";
$result = getQueryResult($conn, $sql)[0];

$path = "img/$bId/";

$pictures = explode(",", $result['pictures']);
$bStatus = $result['status'];
$bPrice = $result['price'];
$bArea = $result['area'];
$bRoomCount = $result['roomCount'];
$bCategory = $result['category'];
$bFloor = $result['floor'];
$bMaxFloor = $result['maxFloor'];
$bDesc = $result['desc'];
$bAddress = $result['address'];
$bRegion = $result['region'];
$bRentOption = $result['rentOption'];
$bPublisherFullName = $result['fullName'];
$bPublisherOwnership = $result['ownership'] == 'owner' ? 'mülkiyyətçi' : 'vasitəçi (agent)';
$bPublisherPhone = $result['phone'];
$bPublisherEmail = $result['email'];
$bDocumentStatus = $result['documentStatus'] ? "var" : "yox";
$bMortgageStatus = $result['mortgageStatus'] ? "var" : "yox";
$bCity = $result['city'];

$imageCount = count($pictures);


?>


<div class="container pt-3 bg-32 w-80 mt-3">

    <div class="row pb-2">
        <div class="col-6 d-flex justify-content-start">

            <h5 class="text-light">
                <?= $bStatus == 'sell' ? toUpperLocale("Satış") : toUpperLocale("Kirayə") ?> <span class="text-light">⮚</span> <?= $bRoomCount . " OTAQLI " ?> <?= toUpperLocale(substr($bCategory, 2)) ?>
            </h5>

        </div>
        <div class="col-6"></div>
    </div>

    <div class="row pb-3">
        <div class="col-6">
            <div class="position-relative">
                <button id="prev" class="btn btn-light position-absolute top-50 fw-bold p-0dot7rem fs-2rem" onclick="setImg('left')">
                    ‹
                </button>
                <button id="next" class="btn btn-light position-absolute top-50 fw-bold p-0dot7rem fs-2rem pos-right-1dot6rem" onclick="setImg('right')">
                    ›
                </button>


                <img id="largeImg" src="<?= $path . $pictures[0] ?>" width="560px" height="373px" alt="Large Home Picture" />
            </div>
        </div>
        <div class="col-6">

            <div class="row d-flex">
                <?php

                for ($i = 0; $i < $imageCount; $i++) :
                ?>
                    <div class="col-2 pb-3">
                        <img class="img-fluid img-thumbnail" style="width: 5rem; height: 4rem; cursor:pointer;" src="<?= $path . $pictures[$i] ?>" onclick="changePicture('<?= $i ?>')" alt="Additional Home Picture" />
                    </div>
                <?php endfor; ?>

            </div>
        </div>
    </div>

    <div class="row" style="background-color: #f4f2ef;">
        <div class="col-3 mt-3 w-25">
            <?php if ($bStatus == 'sell') : ?>
                <div class="border border-dark mb-3">
                    <div class="bg-brown py-3 px-4 text-center text-light h4 mb-0">
                        <?= number_format($bPrice) ?> AZN
                    </div>
                    <div class="bg-white py-3 px-4 text-center txt-brown h5 mb-0">
                        <?= (int) ($bPrice / $bArea) ?> AZN/<span>m<sup>2</sup></span>
                    </div>
                </div>
            <?php else : ?>
                <div class="bg-brown p-4 text-center text-light h4">
                    <?= number_format($bPrice) ?> AZN/<?= $bRentOption == 'gündə' ? "gün" : "ay" ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-9 d-flex align-items-center">
            <p class="fw-bolder fs-3 txt-32"><?= $bStatus == 'sell' ? "Satılır" : "İcarəyə verilir" ?> <?= $bRoomCount ?> otaqlı <?= substr($bCategory, 2) ?> <?= $bArea ?> <span>m<sup>2</sup></span>, <?= $bRegion ?> r. </p>
        </div>
    </div>

</div>

</div>

<div class="container pt-3 pb-4 ps-3 bg-white w-75">
    <div class="row">
        <section class="col-3 mb-3">
            <div class="bg-f4f2ef pb-3 px-2">

                <div class="py-3">
                    <span><?= $bPublisherFullName ?></span>
                    <div class="txt-8c">
                        <?= $bPublisherOwnership ?>
                    </div>
                    <span><?= $bPublisherEmail ?></span>
                </div>
                <button class="bg-primary w-100 text-white fs-5 rounded border-0" onclick="showMoreInfo(this)">
                    Nömrəni göstər
                    <div>
                        <?= substr_replace($bPublisherPhone, '●●', -2) ?>
                    </div>
                </button>
                <div id="phone-additional-info" class="bg-white py-2 px-2 border rounded d-none">
                    <div class="txt-333"><?= $bPublisherPhone ?></div>
                    <p class="txt-9b mb-0">Satıcıya elanı bina.az saytında tapdığınızı bildirin</p>
                </div>
            </div>
        </section>

        <aside class="col-9">
            <div class="row">
                <div class="col-6">
                    <table class="table b-collapse-init">
                        <tbody>
                            <tr>
                                <td class="param-info">Kateqoriya</td>
                                <td class="param"><?= ucfirst(substr($bCategory, 2)) ?></td>
                            </tr>
                            <tr>
                                <td class="param-info">Mərtəbə</td>
                                <td class="param"><?= $bFloor . " / " . $bMaxFloor ?></td>
                            </tr>
                            <tr>
                                <td class="param-info">Sahə</td>
                                <td class="param"><?= $bArea ?> <span>m<sup>2</sup></span> </td>
                            </tr>
                            <tr>
                                <td class="param-info">Otaq sayı</td>
                                <td class="param"><?= $bRoomCount ?></td>
                            </tr>
                            <?php if ($bStatus == 'sell') : ?>
                                <tr>
                                    <td class="param-info">Kupça</td>
                                    <td class="param"><?= $bDocumentStatus ?></td>
                                </tr>
                                <tr>
                                    <td class="param-info">İpoteka</td>
                                    <td class="param"><?= $bMortgageStatus ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-6 ps-3">
                    <div class="position-relative">
                        <div class="position-absolute bg-333 opacity-75 text-white fs-6 fw-bold p-1" class="address" id="addressDiv">
                            <p class="p-0 mb-0">Ünvan: <?= $bCity ?> şəhəri, <?= $bAddress ?></p>
                        </div>
                        <iframe width="100%" height="260" src="https://maps.google.com/maps?q=<?= str_replace(" ", "+", $bAddress) ?>&output=embed"></iframe>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <div class="row">
        <div class="col-3"></div>
        <article class="col-9 pt-3">
            <p>
                <?= $bDesc ?>
            </p>
        </article>
    </div>

</div>

<script>
    let currImgIdx = 0;
    let pics = <?= json_encode($pictures) ?>;
    let imgCount = <?= $imageCount ?>;
    let path = "<?= $path ?>";

    function changePicture(number) {
        currImgIdx = parseInt(number);
        document.getElementById('largeImg').src = `${path}${pics[currImgIdx]}`;
    }

    function showMoreInfo(caller) {
        caller.style.display = "none";
        document.getElementById('phone-additional-info').style.cssText = "display: block !important";
    }

    function setImg(direction) {
        if (direction == 'left') currImgIdx = (currImgIdx - 1 == -1) ? imgCount - 1 : currImgIdx - 1;
        else currImgIdx = (currImgIdx + 1 == imgCount) ? 0 : currImgIdx + 1;

        changePicture(currImgIdx);
    }
</script>