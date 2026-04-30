<?php
include "connect.php";

// 1. معالجة إضافة مريض جديد (بناءً على أسماء أعمدتك الحقيقية)
if (isset($_POST['add_patient'])) {
    $p_id = $conn->real_escape_string($_POST['patient_id']);
    $p_name = $conn->real_escape_string($_POST['full_name']);
    $p_phone = $conn->real_escape_string($_POST['phone_number']);

    // استخدام الأسماء الصحيحة: patient_id, full_name, phone_number
    $sql_add = "INSERT INTO patients (patient_id, full_name, phone_number) VALUES ('$p_id', '$p_name', '$p_phone')";
    
    if ($conn->query($sql_add) === TRUE) {
        echo "<script>alert('تم تسجيل المريض بنجاح'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('خطأ: رقم المريض موجود مسبقاً أو هناك مشكلة في البيانات');</script>";
    }
}

// 2. جلب قائمة المرضى وترتيبهم حسب patient_id
$sql = "SELECT * FROM patients ORDER BY patient_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم | MS SmartScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f0f2f5; margin: 0; padding: 20px; }
        .container { max-width: 1100px; margin: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 20px; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .main-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 25px; }
        .card, .table-card { background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        h2 { font-size: 18px; margin-bottom: 20px; color: #2c3e50; border-right: 4px solid #3498db; padding-right: 10px; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Cairo'; box-sizing: border-box; }
        .btn-submit { width: 100%; background: #27ae60; color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 15px; text-align: right; border-bottom: 2px solid #eee; color: #7f8c8d; }
        td { padding: 15px; border-bottom: 1px solid #eee; }
        .btn-scan { background: #3498db; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; font-size: 13px; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>لوحة تحكم <span style="color:#3498db">MS SmartScan</span></h1>
        <div>مرحباً، مروة</div>
    </div>

    <div class="main-grid">
        <div class="card">
            <h2>إضافة مريض جديد +</h2>
            <form method="POST">
                <div class="form-group">
                    <input type="number" name="patient_id" placeholder="رقم المريض (ID)" required>
                </div>
                <div class="form-group">
                    <input type="text" name="full_name" placeholder="الاسم الكامل للمريض" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone_number" placeholder="رقم الهاتف" required>
                </div>
                <button type="submit" name="add_patient" class="btn-submit">حفظ المريض</button>
            </form>
        </div>

        <div class="table-card">
            <h2>المرضى المسجلين</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>اسم المريض</th>
                        <th>الهاتف</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo $row['patient_id']; ?></strong></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td>
                                <a href="scan.php?id=<?php echo $row['patient_id']; ?>" class="btn-scan">بدء الفحص</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center;">لا يوجد مرضى حالياً</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>