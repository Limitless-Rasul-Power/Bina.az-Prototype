<?php

if (!isset($_POST['placeSubmit'])) {
    $sql = "SELECT * FROM `city` WHERE `name` = 'Bakı'";
    $result = getQueryResult($conn, $sql);
    $city = $result[0]['id'];
}

$userId = $_GET['user'];

$errors = [
    'area' => '',
    'floor' => '',
    'maxFloor' => '',
    'address' => '',
    'price' => '',
    'pictures' => ''
];


if (isset($_POST['placeSubmit'])) {
    $option = $_POST['options'];
    $categoryId = $_POST['apartments'];
    $city = $_POST['cities'];
    $roomCount = $_POST['roomCounts'];
    $area = $_POST['area'];
    $floor = $_POST['floor'];
    $maxFloor = $_POST['maxFloor'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $regionId =  $_POST['regions'];
    $rentOption = $_POST['rentOptions'];

    $pictures = $_FILES['pictures'];

    $hasDocument = $hasMortgage = 0;
    if (isset($_POST['details'])) {
        $hasDocument = in_array('document', $_POST['details']) ? 1 : 0;
        $hasMortgage = in_array('mortgage', $_POST['details']) ? 1 : 0;
    }


    if ($area == '') {
        $errors['area'] = 'Sahəni qeyd etməlisiniz.';
    } elseif ($area <= 0) {
        $errors['area'] = 'Sahə 0-dan böyük olmalıdır.';
    }


    if ($floor == '') {
        $errors['floor'] = 'Mərtəbəni qeyd etməlisiniz.';
    } elseif ($floor <= 0) {
        $errors['floor'] = 'Mərtəbə 0-dan böyük olmalıdır.';
    } elseif ($maxFloor != '' && $floor > $maxFloor) {
        $errors['floor'] = 'Mərtəbə ümumi mərtəbədən kiçik olmalıdır.';
    }

    if ($maxFloor == '') {
        $errors['maxFloor'] = 'Mərtəbələrin sayını qeyd etməlisiniz.';
    } elseif ($maxFloor < 0) {
        $errors['maxFloor'] = 'Mərtəbələrin sayı 0-dan böyük olmalıdır.';
    }

    if ($price == '') {
        $errors['price'] = 'Qiymət qeyd etməlisiniz.';
    } elseif ($price <= 0) {
        $errors['price'] = 'Qiymət 0-dan böyük olmalıdır';
    }

    if ($address == '') {
        $errors['address'] = 'Ünvanı qeyd etməlisiniz.';
    }


    $imgCount = count($pictures['name']);

    if ($imgCount < 4) {
        $errors['pictures'] = 'Şəkil sayı ən az 4 olmalıdır!';
    } else {
        $spaceExceededImagesCount = 0;

        for ($i = 0; $i < $imgCount; $i++) {
            $size = $pictures['size'][$i];
            if ($size > 700000) {
                ++$spaceExceededImagesCount;
            }
        }

        if ($spaceExceededImagesCount > 0) {
            $errors['pictures'] = "$imgCount şəkildən $spaceExceededImagesCount dənəsi normadan çox yer tutur.";
        }
    }

    $isAllValid = true;

    foreach ($errors as $value) {
        if ($value != '') {
            $isAllValid = false;
            break;
        }
    }

    if ($isAllValid) {
        $pictureNames = join(",", $pictures['name']);
        $isSelling = $option == 'sell';


        $sql = "INSERT INTO `building` (`userId`, `status`, `categoryId`, `roomCount`, `area`, `address`,  `floor`, `maxFloor`, `desc`, `price`, `regionId`, `pictures`, ";

        if ($isSelling) {
            $sql .= "`documentStatus`, `mortgageStatus`)
                VALUES ($userId, 'sell', '$categoryId', $roomCount, $area, '$address', $floor, $maxFloor, '$desc', $price, $regionId, '$pictureNames', $hasDocument, $hasMortgage)";
        } else {
            $sql .= "`rentOption`)
                VALUES ($userId, 'rent', '$categoryId', $roomCount, $area, '$address', $floor, $maxFloor, '$desc', $price, $regionId, '$pictureNames', '$rentOption')";
        }

        mysqli_query($conn, $sql);
        $lastQueryId = mysqli_insert_id($conn);
        $dir = "img/$lastQueryId";
        mkdir($dir);


        for ($i = 0; $i < $imgCount; $i++) {
            $tmp = $pictures['tmp_name'][$i];
            $name = $pictures['name'][$i];
            $size = $pictures['size'][$i];
            $path = "$dir/$name";

            if (getimagesize($tmp) != false && !file_exists($path) && $size < 700000) {
                move_uploaded_file($tmp, $path);
            }
        }
        header("Location: ?");
    }
}

?>
<div class="container pt-3 mb-3">
    <div class="row bg-f3">
        <h2 class="text-center bg-999 text-light py-1 rounded mb-0 fs-4">Elan</h2>

        <div class="col-6 pt-4">
            <form method="POST" enctype="multipart/form-data">
                <div class="pb-3 row justify-content-start">
                    <label class="col-3 col-form-label fw-bold">Mən*</label>
                    <div class="col-9 d-flex">
                        <select class="form-select w-33" name="apartments">
                            <?php
                            $sql = "SELECT * FROM `apartment`";
                            $result = getQueryResult($conn, $sql);

                            foreach ($result as $row) :
                            ?>
                                <option value="<?= $row['id'] ?>" <?= isset($categoryId) && $row['id'] == $categoryId ? 'selected' : '' ?>><?= $row['name'] ?></option>

                            <?php endforeach; ?>
                        </select>

                        <select class="form-select w-33 ms-4" name="options" id="options" onchange="displayAndHideInputs()">
                            <option value="sell" <?= isset($option) && $option == 'sell' ? 'selected' : '' ?>>satıram</option>
                            <option value="rent" <?= isset($option) && $option == 'rent' ? 'selected' : '' ?>>kirayə verirəm</option>
                        </select>

                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <label class="col-3 col-form-label fw-bold">Şəhər*</label>
                    <div class="col-9">
                        <select class="form-select w-71" name="cities" onchange="onCityChange()" id="citySelection">
                            <?php
                            $sql = "SELECT * FROM `city`";
                            $result = getQueryResult($conn, $sql);

                            foreach ($result as $row) :
                            ?>
                                <option value="<?= $row['id'] ?>" <?= $row['id'] == $city ? "selected" : "" ?>><?= $row['name'] ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <label class="col-3 col-form-label fw-bold">Otaq sayı*</label>
                    <div class="col-9">
                        <select class="form-select text-center" style="width: 15%;" name="roomCounts">
                            <?php
                            for ($i = 1; $i <= 20; $i++) :
                            ?>
                                <option <?= isset($roomCount) && $i == $roomCount ? 'selected' : '' ?>><?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <div class="col-3 ">
                        <label class="col-form-label fw-bold">Sahə*</label>
                    </div>

                    <div class="col-9">
                        <div class="row">
                            <div class="col-4">
                                <input type="number" name="area" class="form-control <?= $errors['area'] ? 'is-invalid' : '' ?>" value="<?= isset($area) ? $area : '' ?>" />
                                <div class="invalid-feedback">
                                    <small><?= $errors['area'] ?></small>
                                </div>
                            </div>
                            <div class="col-8 pt-1 ps-0">
                                <span class="pt-2">m<sup>2</sup></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <div class="col-3 d-flex">
                        <label class="col-form-label fw-bold">Mərtəbə*</label>
                    </div>
                    <div class="col-9 w-25">
                        <input type="number" name="floor" class="form-control <?= $errors['floor'] ? 'is-invalid' : '' ?>" value="<?= isset($floor) ? $floor : '' ?>" />
                        <div class="invalid-feedback">
                            <small><?= $errors['floor'] ?></small>
                        </div>
                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <div class="col-3 ">
                        <label class="col-form-label fw-bold">Mərtəbələrin sayı*</label>
                    </div>
                    <div class="col-9 w-25">
                        <input type="number" name="maxFloor" class="form-control <?= $errors['maxFloor'] ? 'is-invalid' : '' ?>" value="<?= isset($maxFloor) ? $maxFloor : '' ?>" />
                        <div class="invalid-feedback">
                            <small><?= $errors['maxFloor'] ?></small>
                        </div>
                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <div class="col-3 ">
                        <label class="col-form-label fw-bold">Əlavə məlumat</label>
                    </div>
                    <div class="col-9 w-25">
                        <textarea class="ps-2 pt-2" name="desc" cols="50" rows="10" style="white-space: pre-line; white-space: pre-wrap;"><?= isset($desc) ? $desc : '' ?></textarea>
                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <div class="col-3 ">
                        <label class="col-form-label fw-bold">Qiymət*</label>
                    </div>
                    <div class="col-9">
                        <div>
                            <div class="row">

                                <div class="col-6 d-flex">
                                    <div class="col-8">
                                        <input type="number" name="price" class="form-control <?= $errors['price'] ? 'is-invalid' : '' ?>" value="<?= isset($price) ? $price : '' ?>" />
                                        <div class="invalid-feedback">
                                            <small><?= $errors['price'] ?></small>
                                        </div>
                                    </div>
                                    <div class="col-4 pt-2">
                                        <span class="ps-2">AZN</span>
                                    </div>
                                </div>

                                <div class="col-6 ps-0 <?= isset($option) && $option == 'rent' ? 'd-block' : 'd-none' ?>" id="rentOptions">
                                    <select class="form-select w-50 ms-2" name="rentOptions">
                                        <option <?= isset($rentOption) && $rentOption != 'ayda' ? 'selected' : '' ?>>gündə</option>
                                        <option <?= isset($rentOption) && $rentOption == 'ayda' ? 'selected' : '' ?>>ayda</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="pt-2 homeDetail <?= !isset($option) || $option == 'sell' ? 'd-block' : 'd-none' ?>">
                            <input type="checkbox" value="document" name="details[]" id="kupca" <?= isset($hasDocument) && $hasDocument ? 'checked' : '' ?> />
                            <label for="kupca" class="fw-bold">Kupça var</label>
                        </div>

                        <div class="homeDetail <?= !isset($option) || $option == 'sell' ? 'd-block' : 'd-none' ?>">
                            <input type="checkbox" value="mortgage" name="details[]" id="ipoteka" <?= isset($hasMortgage) && $hasMortgage ? 'checked' : '' ?> />
                            <label for="ipoteka" class="fw-bold">İpoteka var</label>
                        </div>
                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <div class="col-3 ">
                        <label class="col-form-label fw-bold">Ünvan*</label>
                    </div>
                    <div class="col-9">
                        <input type="text" style="width: 55%;" name="address" class="form-control <?= $errors['address'] ? 'is-invalid' : '' ?>" value="<?= isset($address) ? $address : '' ?>" />
                        <div class="invalid-feedback">
                            <small><?= $errors['address'] ?></small>
                        </div>
                        <small style="font-size: 12px;">Dəqiq&nbsp;ünvanı&nbsp;göstərin&nbsp;(küçə,&nbsp;evin&nbsp;nömrəsi)</small>
                    </div>
                </div>

                <div class="pb-3 row justify-content-start">
                    <label class="col-3 col-form-label fw-bold">Rayon*</label>
                    <div class="col-9">
                        <select class="form-select w-71" name="regions" id="regionSelection"></select>
                    </div>
                </div>


                <div class="pb-3 row justify-content-start">
                    <div class="col-3 ">
                        <label class="col-form-label fw-bold">Şəkillər*</label>
                    </div>
                    <div class="col-9 w-50">
                        <div class="mb-3">
                            <input class="form-control <?= $errors['pictures'] ? 'is-invalid' : '' ?>" type="file" name="pictures[]" multiple>
                            <div class="invalid-feedback">
                                <small><?= $errors['pictures'] ?></small>
                            </div>
                            <ul class="pic-settings pt-2" type="circle">
                                <li>Şəkillərin minimal sayı — 4 ədəd</li>
                                <li>Binanın birinci mərtəbədən başlamaqla tam şəklinin olması mütləqdir</li>
                                <li>Şəkillərin optimal ölçüləri — 800 x 600 pikseldir</li>
                            </ul>

                        </div>
                    </div>
                </div>


                <div class="pb-3">
                    <p class="text-6b">Elan yerləşdirərək, Siz <a href="?page=terms" target="_blank">bina.az-ın İstifadəçi razılaşması</a> ilə razı olduğunuzu təsdiq edirsiniz.</p>
                </div>

                <div class="text-center pb-5">
                    <input type="submit" name="placeSubmit" class="btn btn-danger" value="Yerləşdirmək" />
                </div>

            </form>
        </div>
        <div class="col-6 pt-4">
            <h5 class="text-center">Qaydalar</h5>

            <ul class="rules" type="circle">
                <li>
                    Bir ay ərzində eyni nömrədən 3 pulsuz (təkrar olmayan) elan
                    yerləşdirmək olar. Elanı başqa bir elanla əvəz etmək qadağandır.
                    Saytda artıq mövcud olan daşınmaz əmlakın təkrarən yerləşdirilməsi
                    yalnız ödənişli əsaslarla mümkündür. Bununla belə, bir istifadəçi eyni
                    daşınmaz əmlak obyektini yalnız bir dəfə yerləşdirə bilər.
                </li>
                <li>
                    Əgər siz 1 ay ərzində 4 və daha artıq elan yerləşdirmək istəsəniz, hər
                    növbəti elanın qiyməti - 5 AZN olacaq.
                </li>
                <li>
                    Elanlar vaxtından əvvəl silinsə də, nömrə üçün nəzərdə tutulmuş
                    ödənişsiz yer, elan dərc ediləndən 30 gün sonra bərpa edilir.
                </li>
                <li>
                    bina.az saytında istifadə etdiyiniz ödənişli xidmətlər üçün nəzərdə
                    tutulan məbləğ geri qaytarılmır.
                </li>
                <li>
                    Zəhmət olmasa elanı yerləşdirən zaman əlaqə vasitələrini (telefon
                    nömrəsi, e-mail ünvanını) düzgün qeyd edin. Telefon nömrəsi ilə bağlı
                    heç bir dəyişiklik həyata keçirilmir.
                </li>
                <li>
                    Elanınızla bağlı bütün məlumatlar sizin e-mail ünvanınıza göndərilir.
                </li>
                <li>
                    Əmlakın təsvirində məlumatları böyük hərflərlə yazmaq, həmçinin
                    telefon nömrəsi, e-mail ünvanı və şirkət haqqında xidmətləri yazmaq
                    qadağandır.
                </li>
                <li>
                    Əmlakın fasad (günorta vaxtı çəkilmiş) və otaq şəkilləri mütləq
                    olmalıdır.
                </li>
                <li>
                    Üzərində bina.az saytı da daxil olmaqla digər saytların loqotipləri
                    olan şəkillər qəbul edilməyəcək.
                </li>
                <li>
                    Qiymət tam qeyd edilməlidir. (Qiyməti ilkin ödəniş və ya 1 sot, 1 m²
                    üçün yazmaq olmaz)
                </li>
                <li>Ünvanı xəritədə dəqiq göstərməyiniz vacibdir.</li>
                <li>
                    Fərqli vasitəçi və şirkətlər eyni elanı ödənişli yerləşdirə bilərlər.
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    const options = document.getElementById('options');
    const rentOptions = document.getElementById('rentOptions');
    const homeDetail = document.getElementsByClassName('homeDetail');
    const citySelection = document.getElementById('citySelection');
    const regionSelection = document.getElementById('regionSelection');
    let region = <?= isset($regionId) ? $regionId : 0 ?>;

    onCityChange();

    function displayAndHideInputs() {
        let selectedValue = options.value;

        for (let i = 0; i < homeDetail.length; i++)
            homeDetail[i].style.cssText = selectedValue == 'sell' ? "display: block !important" : 'display: none !important';

        rentOptions.style.cssText = selectedValue != 'sell' ? "display: block !important" : 'display: none !important';

    }


    function onCityChange() {
        let selectedValue = citySelection.value;
        $.get('api/regionSelectionForCorrespondingCity.php', {
            cityId: selectedValue
        }).done(
            function(regions) {
                let data = JSON.parse(regions);
                let code = '';
                for (let i = 0; i < data.length; i++) {
                    let selectionStatement = (region != 0 && region == data[i].id) ? 'selected' : '';
                    code += `<option value="${data[i].id}" ${selectionStatement}>${data[i].name}</option>`;
                }
                regionSelection.innerHTML = code;
            }
        );

    }
</script>