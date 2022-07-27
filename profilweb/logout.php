<?php

include_once 'includes/auth.php';

logout();

header('Location: login.php');
die();