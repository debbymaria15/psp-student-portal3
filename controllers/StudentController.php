<?php

session_start();

require_once "../config/database.php";
require_once "../models/Student.php";

$student = new Student($pdo);

if (!isset($_SESSION['student_id'])) {
    die("Please login first.");
}

$studentId = $_SESSION['student_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['profile_picture'])) {
        die("Please select a file.");
    }

    $file = $_FILES['profile_picture'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("File upload failed.");
    }

    // Maximum file size: 2MB
    $maxSize = 2 * 1024 * 1024;

    if ($file['size'] > $maxSize) {
        die("File size must not exceed 2MB.");
    }

    // Get file extension
    $extension = strtolower(
        pathinfo($file['name'], PATHINFO_EXTENSION)
    );

    // Allowed extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    if (!in_array($extension, $allowedExtensions)) {
        die("Only JPG, JPEG and PNG files are allowed.");
    }

    // Generate unique filename
    $newFilename = uniqid('profile_') . '.' . $extension;

    // Upload directory
    $uploadDirectory = "../uploads/profile/";

    $uploadPath = $uploadDirectory . $newFilename;

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {

        // Save filename into database
        if ($student->updateProfilePicture($studentId, $newFilename)) {

            echo "Profile picture uploaded successfully.";

        } else {

            echo "Failed to save profile picture information.";

        }

    } else {

        echo "Failed to upload file.";

    }
}

?>