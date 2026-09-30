<?php
session_start();

require_once "../config/database.php";
require_once "../models/Student.php";

// Initialize the model using $conn defined in database.php
$studentModel = new Student($conn);

// Default to student ID 1 if no session exists yet
if (!isset($_SESSION['student_id'])) {
    $_SESSION['student_id'] = 1;
}

$studentId = $_SESSION['student_id'];
$student = $studentModel->getStudentById($studentId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
            margin: 0;
        }

        .profile-container {
            width: 500px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 20px auto;
            border: 2px solid #ddd;
        }

        .no-picture {
            text-align: center;
            color: #666;
            margin: 20px 0;
            font-style: italic;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Student Profile</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert-error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <?php if (!empty($student['profile_picture'])): ?>
        <img
            src="../uploads/profile/<?php echo htmlspecialchars($student['profile_picture']); ?>"
            class="profile-picture"
            alt="Profile Picture"
        >
    <?php else: ?>
        <p class="no-picture">No profile picture uploaded.</p>
    <?php endif; ?>

    <p>
        <strong>Name:</strong>
        <?php echo htmlspecialchars($student['name'] ?? 'N/A'); ?>
    </p>

    <p>
        <strong>NRIC:</strong>
        <?php echo htmlspecialchars($student['nric'] ?? 'N/A'); ?>
    </p>

    <p>
        <strong>Program:</strong>
        <?php echo htmlspecialchars($student['program'] ?? 'N/A'); ?>
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
        <small>Allowed: JPG, JPEG, PNG | Maximum size: 2MB</small>
        <br><br>
        <button type="submit">Upload Picture</button>
    </form>
</div>

</body>
</html>