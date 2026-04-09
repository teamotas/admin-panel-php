<?php
require_once '../core/Settings.php';

$settings = new Settings();

$data = $_POST;

$settings->update($data);

// logo upload
if (!empty($_FILES['logo']['name'])) {
    $settings->uploadLogo($_FILES['logo']);
}

header("Location: ../pages/settings.php");
exit;