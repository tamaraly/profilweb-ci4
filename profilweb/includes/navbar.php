<?php include_once 'auth.php' ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            Aplikasi Data Siswa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-auto" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php if (is_login()): ?>
                    <a class="nav-link" href="index.php">IPK</a>
                    <a class="nav-link" href="about.php">About</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="registrasi.php">Registrasi</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</nav>