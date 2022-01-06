<div class="container-fluid bg-ad7a5a py-3">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form method="GET" class="d-flex">
                <select class="form-select c-pointer" name="status">
                    <option value="sell" <?= $status == 'sell' ? 'selected' : '' ?>>Alış</option>
                    <option value="rent" <?= $status == 'rent' ? 'selected' : '' ?>>Kirayə</option>
                </select>

                <select class="form-select c-pointer ms-1" name="category">
                    <?php
                    $sql = "SELECT * FROM `apartment`";
                    $result = getQueryResult($conn, $sql);

                    foreach ($result as $row) :
                    ?>
                        <option value="<?= $row['id'] ?>" <?= $category == $row['id'] ? 'selected' : '' ?>><?= ucfirst(substr($row['name'], 2)) ?></option>
                    <?php endforeach; ?>
                </select>

                <select class="form-select c-pointer ms-1" name="roomCount">
                    <option value="all" <?= !is_numeric($roomCount) ? 'selected' : '' ?>>İstənilən otaq sayı</option>
                    <?php
                    for ($i = 1; $i <= 20; $i++) :
                    ?>
                        <option <?= $roomCount == $i ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>

                <div class="ms-1">
                    <input class="btn btn-light dropdown-toggle" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false" placeholder="Qiymət, AZN" readonly />

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuClickableOutside">
                        <div class="d-flex">
                            <input class="form-control m-2" type="number" placeholder="min" name="min" value="<?= $min ?>" />
                            <input class="form-control m-2" type="number" placeholder="maks" name="max" value="<?= $max ?>" />
                        </div>
                    </div>
                </div>


                <select class="form-select c-pointer ms-1" name="city">
                    <option value="all" <?= !is_numeric($city) ? 'selected' : '' ?>>İstənilən şəhər</option>
                    <?php
                    $sql = "SELECT * FROM `city`";
                    $result = getQueryResult($conn, $sql);

                    foreach ($result as $row) :
                    ?>

                        <option value="<?= $row['id'] ?>" <?= $city == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>

                    <?php endforeach; ?>
                </select>

                <input class="btn btn-primary ms-1 w-100" type="submit" name="filterSubmit" value="Axtar" />

            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>