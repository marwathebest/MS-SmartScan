<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $birht_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone_number'];

    // التعديل للأسماء الإنجليزية
    $sql = "INSERT INTO patients (full_name, birth_date, gender, phone_number) 
            VALUES ('$full_name', '$birth_date', '$gender', '$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?msg=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>تم الحفظ</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="success-box">

<h2>✔ تم حفظ بيانات المريض بنجاح</h2>

<a href="dashboard.php">
<button>العودة إلى لوحة التحكم</button>
</a>

</div>

</body>
</html>