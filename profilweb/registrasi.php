<?php

include_once 'includes/auth.php';

// sebelum masuk, cek apakah sudah login
// jika sudah login arahkan ke index.php
if (is_login()) {
    header('Location: index.php');
    die();
}

// cek data post, jika ada username & password berarti proses registrasi
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['ulangi_password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ulangi_password = $_POST['ulangi_password'];
    // jika register berhasil arahkan ke index.php
    // jika gagal tampilkan eror
    $register_message = register($username, $password, $ulangi_password);
    if (empty($register_message)) {
        header("Location: index.php");
        die();
    } else {
        $error = $register_message;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 100vh">
            <div class="col-12 col-md-6 col-lg-4">
                <h1 class="text-center mb-4">Aplikasi Data Siswa</h1>
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
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-4">
                                <label for="ulangi_password" class="form-label">Ulangi Password</label>
                                <input type="password" class="form-control" id="ulangi_password" name="ulangi_password" required>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary">
                                    Registrasi
                                </button>
                            </div>
                        </form>

                        <hr>

                        Sudah punya akun?
                        <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>