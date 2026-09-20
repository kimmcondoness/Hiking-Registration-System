<?php
include("../hikingdatabase.php");

if (isset($_POST["submit"])) {
    $name = sanitize($_POST["name"] ?? '');
    $tel_no = sanitize($_POST["tel_no"] ?? '');
    $age = intval($_POST["age"] ?? 0);
    $gender = sanitize($_POST["gender"] ?? '');
    $experience = sanitize($_POST["experience"] ?? '');
    $email = sanitize($_POST["email"] ?? '');
    $event_option = sanitize($_POST["event_option"] ?? '');
    $emergency_contact = sanitize($_POST["emergency_contact"] ?? '');
    $medical_notes = sanitize($_POST["medical_notes"] ?? '');

    // Validation
    if (empty($name) || empty($tel_no) || $age < 1 || empty($gender) || empty($email) || empty($event_option)) {
        echo "<script>alert('Please fill in all required fields!'); window.history.back();</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.history.back();</script>";
        exit();
    }

    // Insert with prepared statement
    $stmt = mysqli_prepare($conn, "INSERT INTO hikers (name, tel_no, age, gender, experience, email, event_option, emergency_contact, medical_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssissssss", $name, $tel_no, $age, $gender, $experience, $email, $event_option, $emergency_contact, $medical_notes);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registration successful! See you on the trail!'); window.location.href='../event.php';</script>";
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
