<?php
require_once 'Database.php';

class Settings {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // GET SETTINGS
    // public function get() {
    //     $result = $this->conn->query("SELECT * FROM settings LIMIT 1");
    //     return $result->fetch_assoc();
    // }

public function get() {
    $result = $this->conn->query("SELECT * FROM settings LIMIT 1");
    $data = $result->fetch_assoc();

    if (!$data) {
        // create default row automatically
        $this->conn->query("INSERT INTO settings (id, site_name) VALUES (1, 'My Website')");
        
        $result = $this->conn->query("SELECT * FROM settings LIMIT 1");
        $data = $result->fetch_assoc();
    }

    return $data;
}

    // UPDATE SETTINGS
   public function update($data) {

    $existing = $this->get();

    $data = array_merge($existing, $data);

    $stmt = $this->conn->prepare("
        UPDATE settings SET 
        site_name=?,
        email=?,
        phone=?,
        address=?,
        facebook=?,
        instagram=?,
        linkedin=?,
        twitter=?,
        youtube=?
        WHERE id=1
    ");

    $stmt->bind_param(
        "sssssssss",
        $data['site_name'],
        $data['email'],
        $data['phone'],
        $data['address'],
        $data['facebook'],
        $data['instagram'],
        $data['linkedin'],
        $data['twitter'],
        $data['youtube']
    );

    return $stmt->execute();
}
    // public function update($data) {

    //     $stmt = $this->conn->prepare("
    //         UPDATE settings SET 
    //         site_name=?,
    //         email=?,
    //         phone=?,
    //         address=?,
    //         facebook=?,
    //         instagram=?,
    //         linkedin=?,
    //         twitter=?,
    //         youtube=?
    //         WHERE id=1
    //     ");

    //     $stmt->bind_param(
    //         "sssssssss",
    //         $data['site_name'],
    //         $data['email'],
    //         $data['phone'],
    //         $data['address'],
    //         $data['facebook'],
    //         $data['instagram'],
    //         $data['linkedin'],
    //         $data['twitter'],
    //         $data['youtube']
    //     );

    //     return $stmt->execute();
    // }

    // UPLOAD LOGO
    public function uploadLogo($file) {

        if ($file['name']) {

            $target = "../assets/uploads/" . time() . "_" . $file['name'];
            move_uploaded_file($file['tmp_name'], $target);

            $stmt = $this->conn->prepare("UPDATE settings SET logo=? WHERE id=1");
            $stmt->bind_param("s", $target);
            $stmt->execute();
        }
    }
}