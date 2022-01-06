<?php

$errors = [
    'fullName' => '',
    'tel' => '',
    'email' => ''
];

$fullName = $tel = $email = '';
$ownership = 'agent';

if (isset($_POST['publisherSubmit'])) {

    $fullName = $_POST['fullName'];
    $ownership = $_POST['ownership'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];


    if ($fullName == "") {
        $errors['fullName'] = "Əlaqədar şəxs doldurulmalıdır.";
    }

    if ($tel == "") {
        $errors['tel'] = "Telefon nömrəsi doldurulmalıdır.";
    } elseif (!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/', $tel)) {
        $errors['tel'] = 'Nömrə aşağıdakı formata uyğun olmalıdır.';
    }

    if ($email == "") {
        $errors['email'] = "E-mail doldurulmalıdır.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "E-mail düzgün formatda deyil.";
    }

    if ($errors['fullName'] == '' && $errors['tel'] == '' && $errors['email'] == '') {
        $sql = "SELECT * FROM `publisher` WHERE `phone` = '$tel'";
        $result = getQueryResult($conn, $sql);

        date_default_timezone_set('America/Los_Angeles');
        $date = date("m/d/Y H:i", strtotime('+12 hours'));

        $sql = "INSERT INTO `publisher` (`fullName`, `ownership`, `phone`, `email`, `postDate`) VALUES ('$fullName', '$ownership', '$tel', '$email', '$date')";

        if (count($result) < 3) {
            mysqli_query($conn, $sql); //insert command executes here;
            $userId = mysqli_insert_id($conn);
            header("Location: ?page=create&user=$userId");
        } else {
            echo '<h5 class="text-center text-primary pt-3">Siz artıq bu ay üçün maksimum elan limitinə (3) çatmısınız, hər bir növbəti elanın qiyməti - 5 AZN.</h5>';
        }
    }
}

?>
<div class="container pt-3">
    <div class="row d-flex justify-content-center">
        <div class="col-6 pb-4">
            <div class="contact border-bottom border-dark">
                <h2 class="text-center fs-4 bg-999 text-light py-1 rounded mb-0">
                    Əlaqə
                </h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="bg-f3 pt-4">
                        <div class="pb-3 row justify-content-center">
                            <label for="inptuFullName" class="col-sm-2 col-form-label fw-bold">Əlaqədar&nbsp;şəxs*</label>
                            <div class="col-sm-10 w-50 ps-4">
                                <input type="text" name="fullName" class="form-control <?= $errors['fullName'] ? 'is-invalid' : '' ?>" id="inputFullName" value="<?= $fullName ?>" />
                                <div class="invalid-feedback">
                                    <?= $errors['fullName'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="pb-3 d-flex justify-content-center">
                            <div class="ps-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ownership" id="first" value="owner" <?= $ownership == 'owner' ? 'checked' : '' ?> />
                                    <label class="form-check-label" for="first">
                                        Öz elanımı yerləşdirirəm
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ownership" id="second" value="agent" <?= $ownership == 'agent' ? 'checked' : '' ?> />
                                    <label class="form-check-label" for="second">
                                        Mən vasitəçiyəm (agent)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="pb-3 row justify-content-center">
                            <label for="inputTel" class="col-sm-2 col-form-label fw-bold">Telefon*</label>
                            <div class="col-sm-10 w-50 ps-4">
                                <input type="tel" name="tel" class="form-control <?= $errors['tel'] ? 'is-invalid' : '' ?>" id="inputTel" value="<?= $tel ?>" />
                                <div class="invalid-feedback">
                                    <?= $errors['tel'] ?>
                                </div>
                                <small>
                                    Format: 000-000-00-00
                                </small>
                            </div>
                        </div>

                        <div class="pb-3 row justify-content-center">
                            <label for="inputEmail" class="col-sm-2 col-form-label fw-bold">E-mail*</label>
                            <div class="col-sm-10 w-50 ps-4">
                                <input type="text" class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>" id="inputEmail" name="email" placeholder="saytda göstərilmir" value="<?= $email ?>" />
                                <div class="invalid-feedback">
                                    <?= $errors['email'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="text-center pe-3 pb-3">
                            <input class="btn btn-danger w-25" type="submit" name="publisherSubmit" value="Davam etmək" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-3 pt-3">
            <p class="txt-72 ps-5">
                bina.az-da bir ay ərzində 3 pulsuz elan yerləşdirmək olar. Hər bir
                növbəti elanın qiyməti - 5 AZN.
            </p>

            <div class="bg-f3 txt-72 p-2 ms-3">
                <p class="fs-4 text-justify">
                    Siz 3 pulsuz elan yerləşdirə bilərsiniz.
                </p>
            </div>
        </div>
    </div>
</div>