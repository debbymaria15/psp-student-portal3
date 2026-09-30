<?php

session_start();

require_once "../config/database.php";
require_once "../models/Student.php";

$studentModel = new Student($pdo);

if (!isset($_SESSION['student_id'])) {
    die("Please login first.");
}

$studentId = $_SESSION['student_id'];

$student = $studentModel->getStudentById($studentId);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Student Profile</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }

        .profile-container {
            width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 20px auto;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

    </style>

</head>

<body>

<div class="profile-container">

    <h2>Student Profile</h2>

    <?php if (!empty($student['profile_picture'])): ?>

        <img
            src="../uploads/profile/<?php echo htmlspecialchars($student['profile_picture']); ?>"
            class="profile-picture"
            alt="Profile Picture"
        >

    <?php else: ?>

        <p>No profile picture uploaded.</p>

    <?php endif; ?>


    <p>
        <strong>Name:</strong>
        <?php echo htmlspecialchars($student['name']); ?>
    </p>


    <p>
        <strong>NRIC:</strong>
        <?php echo htmlspecialchars($student['nric']); ?>
    </p>


    <p>
        <strong>Program:</strong>
        <?php echo htmlspecialchars($student['program']); ?>
    </p>


    <hr>


    <h3>Upload Profile Picture</h3>


    <form
        action="../controllers/StudentController.php"
        method="POST"
        enctype="multipart/form-data"
    >

        <input
            type="file"
            name="profile_picture"
            accept=".jpg,.jpeg,.png"
            required
        >

        <br><br>

        <small>
            Allowed: JPG, JPEG, PNG | Maximum size: 2MB
        </small>

        <br><br>

        <button type="submit">
            Upload Picture
        </button>

    </form>

</div>

</body>

</html>