<?php

include_once 'includes/auth.php';

// sebelum masuk, cek apakah sudah login
// jika belum login arahkan ke login.php
if (!is_login()) {
    header('Location: login.php');
    die();
}

// cek data post, jika ada semester & ipk berarti proses input
if (isset($_POST['semester']) && isset($_POST['ipk'])) {
    $semester = $_POST['semester'];
    $ipk = $_POST['ipk'];
    $id_user = $_SESSION['id_user'];

    // cek apakah sudah ada semester
    // jika belum berarti insert, jika sudah berarti update
    $data_db = pg_query("SELECT * FROM ipk WHERE semester=$semester AND id_user=$id_user");
    if (pg_num_rows($data_db) > 0) {
        $data_db = pg_fetch_array($data_db, null, PGSQL_ASSOC);
        $id = $data_db['id'];
        $result = pg_query("UPDATE ipk SET ipk='$ipk' WHERE id=$id");
        if (pg_affected_rows($result) > 0) {
            header("Location: index.php");
            die();
        } else {
            $error = pg_last_error();
        }
    } else {
        $result = pg_query("INSERT INTO ipk (semester, ipk, id_user) VALUES ($semester, '$ipk', $id_user)");
        if (pg_affected_rows($result) > 0) {
            header("Location: index.php");
            die();
        } else {
            $error = pg_last_error();
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Input IPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once 'includes/navbar.php' ?>

    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: calc(100vh - 56px)">
            <div class="col-12 col-md-6 col-lg-4">
                <h1 class="display-4 mb-4">Input IPK</h1>
                <div class="card">
                    <div class="card-body">

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <p class="mb-0">
                                    <?= $error ?>
                                </p>
                            </div>
                        <?php endif ?>

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="number" class="form-control" id="semester" name="semester" required>
                            </div>
                            <div class="mb-4">
                                <label for="ipk" class="form-label">IPK</label>
                                <input type="text" class="form-control" id="ipk" name="ipk" required>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <button type="button" class="btn btn-light ms-2" onclick="window.history.back()">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>