<?php
require_once '../core/Auth.php';

$auth = new Auth();
$auth->logout();

header("Location:../index.php");
exit;