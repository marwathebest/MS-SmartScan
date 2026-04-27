<?php
include "connect.php";

// 1. معالجة إضافة مريض جديد عند إرسال النموذج
if (isset($_POST['add_patient'])) {
    $patient_name = $conn->real_escape_string($_POST['name']);
    $patient_phone = $conn->real_escape_string($_POST['phone']);
    $patient_id = $conn->real_escape_string($_POST['id']);

    $sql_insert = "INSERT INTO patients (patient_id, name, phone) VALUES ('$patient_id', '$patient_name', '$patient_phone')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('تم إضافة المريض بنجاح');</script>";
    } else {
        echo "<script>alert('خطأ: المريض مسجل مسبقاً أو هناك مشكلة في البيانات');</script>";
    }
}

// 2. جلب قائمة المرضى المسجلين لعرضها في الجدول
$sql_patients = "SELECT * FROM patients ORDER BY id DESC";
$result_patients = $conn->query($sql_patients);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المرضى - MS SmartScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <a href="dashboard.php" class="back-link">← العودة للوحة التحكم</a>

    <div class="card">
        <h2>إضافة مريض جديد +</h2>
        <form method="POST" class="form-group">
            <input type="text" name="id" placeholder="رقم المريض (ID)" required>
            <input type="text" name="name" placeholder="اسم المريض بالكامل" required>
            <input type="text" name="phone" placeholder="رقم الهاتف" required>
            <button type="submit" name="add_patient" class="btn-add">حفظ البيانات</button>
        </form>
    </div>

    <div class="card">
        <h2>قائمة المرضى المسجلين</h2>
        <table>
            <thead>
                <tr>
                    <th>رقم المريض</th>
                    <th>اسم المريض</th>
                    <th>رقم الهاتف</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_patients->num_rows > 0): ?>
                    <?php while($row = $result_patients->fetch_assoc()): ?>
                    <tr>
                        <td>#<?php echo $row['patient_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td>
                            <a href="scan.php?id=<?php echo $row['patient_id']; ?>" class="btn-scan">بدء الفحص</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center;">لا يوجد مرضى مسجلين حالياً</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>