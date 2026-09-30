<?php

session_start();

$_SESSION['student_id'] = 1;

header("Location: views/profile.php");

exit();

?>