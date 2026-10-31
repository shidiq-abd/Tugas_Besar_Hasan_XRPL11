<?php

session_start();

$_SESSION = [];

session_destroy();
header("location: form_login.php");
exit;