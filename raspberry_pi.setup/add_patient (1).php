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
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: auto; }
        
        /* تصميم كرت إضافة مريض */
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 30px; }
        h2 { color: #2c3e50; margin-top: 0; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        
        .form-group { display: flex; gap: 15px; flex-wrap: wrap; margin-top: 20px; }
        input { flex: 1; padding: 12px; border: 1px solid #ddd; border-radius: 8px; min-width: 200px; font-family: 'Cairo'; }
        
        .btn-add { background-color: #27ae60; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .btn-add:hover { background-color: #219150; }

        /* تصميم الجدول */
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        th, td { padding: 15px; text-align: right; border-bottom: 1px solid #eee; }
        th { background-color: #3498db; color: white; }
        tr:hover { background-color: #f9f9f9; }
        
        .btn-scan { color: #3498db; text-decoration: none; font-weight: bold; border: 1px solid #3498db; padding: 5px 10px; border-radius: 5px; }
        .btn-scan:hover { background: #3498db; color: white; }
        
        .back-link { display: inline-block; margin-bottom: 15px; color: #7f8c8d; text-decoration: none; }
    </style>
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