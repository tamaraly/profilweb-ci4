<?php

$db_host = "localhost";
$db_port = "5432";
$db_name = "data_siswa";
$db_user = "postgres";
$db_pass = "dino";

// Connecting, selecting database
$db = pg_connect("host=$db_host port=$db_port dbname=$db_name user=$db_user password=$db_pass")
    or die('DB Error: ' . pg_last_error());