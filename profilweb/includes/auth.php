<?php

include_once 'db.php';

session_start();


/**
 * Fungsi bantuan untuk membersihkan string
 */
function escape_string($str) {
    return pg_escape_string($str);
}

/**
 * Fungsi untuk memeriksa apakah user sudah login
 * return true jika user sudah login
 */
function is_login() {
    if (isset($_SESSION['id_user'])) {
        // cek apakah id_user valid
        $id = $_SESSION['id_user'];
        $result = pg_query("SELECT * FROM users WHERE id=$id");
        if (pg_num_rows($result) > 0) {
            return true;
        } else {
            // hapus session jika tidak valid
            logout();
        }
    }
    return false;
}

/**
 * Fungsi untuk login menggunakan username dan password
 * return empty string jika berhasil, return error jika gagal
 */
function login($username, $password) {
    $username = escape_string($username);
    $password = escape_string($password);

    $result = pg_query("SELECT * FROM users WHERE username='$username'");
    if(pg_num_rows($result) > 0) {
        $user = pg_fetch_array($result, null, PGSQL_ASSOC);
        // cek apakah hash password valid
        if (password_verify($password, $user['password'])) {
            // simpan id_user ke dalam session
            $_SESSION['id_user'] = $user['id'];
            return '';
        }
    }
    return "Username / password salah";
}

/**
 * Fungsi untuk register menggunakan username dan password
 * return empty string jika berhasil, return error jika gagal
 */
function register($username, $password, $ulangi_password) {
    $username = escape_string($username);
    $password = escape_string($password);
    $ulangi_password = escape_string($ulangi_password);

    if ($password != $ulangi_password) {
        return "Password tidak sama!";
    }

    // hash password, jangan simpan langsung
    $password = password_hash($password, PASSWORD_DEFAULT);

    $result = pg_query("INSERT INTO users (username, password) VALUES ('$username', '$password') RETURNING id");
    if (pg_affected_rows($result) > 0) {
        $insert_row = pg_fetch_row($result);
        // simpan id user di session
        $_SESSION['id_user'] = $insert_row[0];
        return '';
    }
    return pg_last_error();
}

/**
 * Fungsi untuk logout, hapus session
 */
function logout() {
    unset($_SESSION['id_user']);
}