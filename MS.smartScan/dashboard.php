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
<link rel="stylesheet" href="style.css">
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
        <div class="form-card">
    <h2>تسجيل مريض جديد</h2>
    <form action="save_patient.php" method="POST">
        <div class="form-group">
            <input type="text" name="full_name" placeholder="الاسم الكامل للمريض" required>
        </div> 
        <div class="form-group">
            <input type="number" name="patient_id" placeholder="رقم الهوية / السجل المدني" required>
        </div>
       <select name="gender" required style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; font-family: 'Cairo';">
    <option value="" disabled selected>اختر الجنس</option>
    <option value="ذكر">ذكر</option>
    <option value="أنثى">أنثى</option>
</select>
        <div class="form-group">
            <input type="date" name="birth_date" title="تاريخ الميلاد" required>
        </div>
        <div class="form-group">
            <input type="text" name="phone_number" placeholder="رقم الجوال" required>
        </div>
        <button type="submit" name="add_patient" class="btn-submit">حفظ بيانات المريض</button>
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