<?php

include_once 'includes/auth.php';

// sebelum masuk, cek apakah sudah login
// jika belum login arahkan ke login.php
if (!is_login()) {
    header('Location: login.php');
    die();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Info Lengkap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <style>
        .info-label {
            width: 1%;
        }
    </style>
</head>
<body>
    <?php include_once 'includes/navbar.php' ?>

    <div class="container py-5">
        <h1 class="h3 mb-3">Info Lengkap</h1>
        <div class="card border-0 shadow">
            <div class="card-body">

                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="img/photo.png" alt="Photo">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th class="info-label">Nama</th>
                                    <td>: Nama Saya</td>
                                </tr>
                                <tr>
                                    <th class="info-label">NIM</th>
                                    <td>: NIM Saya</td>
                                </tr>
                                <tr>
                                    <th class="info-label">Kelas</th>
                                    <td>: Kelas Saya</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>