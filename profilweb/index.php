<?php

include_once 'includes/auth.php';

// sebelum masuk, cek apakah sudah login
// jika belum login arahkan ke login.php
if (!is_login()) {
    header('Location: login.php');
    die();
}

// get ipk milik user
$id_user = $_SESSION['id_user'];
$result = pg_query("SELECT * FROM ipk WHERE id_user=$id_user ORDER BY semester");

?>

<!DOCTYPE html>
<html>
<head>
    <title>IPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once 'includes/navbar.php' ?>

    <div class="container py-5">
        <div class="d-flex align-items-center">
            <h1 class="h3 mb-3">Daftar IPK</h1>
            <a class="ms-auto btn btn-primary" href="ipk_input.php">Input IPK</a>
        </div>

        <?php if (pg_num_rows($result) > 0): ?>
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th style="width: 20%">Semester</th>
                        <th style="width: 40%">IPK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = pg_fetch_array($result, null, PGSQL_ASSOC)): ?>
                        <tr>
                            <td><?= $row['semester'] ?></td>
                            <td><?= $row['ipk'] ?></td>
                            <td>
                                <a href="ipk_edit.php?semester=<?= $row['semester'] ?>" class="btn btn-warning">
                                    Edit
                                </a>
                                <a href="ipk_delete.php?semester=<?= $row['semester'] ?>" class="btn btn-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-danger">
                <p class="mb-0">Belum ada data</p>
            </div>
        <?php endif ?>
    </div>
</body>
</html>