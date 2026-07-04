<?php
session_start();

if (!isset($_SESSION['email']))
{
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != "admin")
{
    die("Access Denied! Only administrators can access this page.");
}

include "db.php";

$id = $_GET['id'];
$stmt = $conn->prepare(
"DELETE FROM students WHERE id=?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: view_students.php");
?>