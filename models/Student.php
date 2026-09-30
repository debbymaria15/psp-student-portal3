<?php

class Student
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getStudentById($studentId)
    {
        $sql = "SELECT * FROM students WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $studentId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfilePicture($studentId, $filename)
    {
        $sql = "UPDATE students
                SET profile_picture = :profile_picture
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':profile_picture' => $filename,
            ':id' => $studentId
        ]);
    }
}

?>