<?php
include "connect.php";

// 1. معالجة إضافة مريض جديد
if (isset($_POST['add_patient'])) {
    // استقبال البيانات من النموذج مع تأمينها
    $id     = $conn->real_escape_string($_POST['id']);
    $name   = $conn->real_escape_string($_POST['name']);
    $phone  = $conn->real_escape_string($_POST['phone']);
    
    // تحديد قيم افتراضية للحقول التي تسبب أخطاء (تاريخ الميلاد والجنس)
    // بما أن النموذج لا يحتوي على حقول لهما حالياً
    $birth_date = '0000-00-00'; 
    $gender     = 'غير محدد';

    // استخدام المتغيرات الصحيحة في الاستعلام
    // ملاحظة: تم إدراج patient_id لأنكِ تستقبلينه يدوياً في النموذج كـ "الرقم الطبي"
    $sql_insert = "INSERT INTO patients (patient_id, full_name, birth_date, gender, phone_number) 
                   VALUES ('$id', '$name', '$birth_date', '$gender', '$phone')";
    
    // تنفيذ الاستعلام باستخدام المتغير الصحيح $sql_insert
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('تم إضافة المريض بنجاح'); window.location.href='index.php';</script>";
    } else {
        // إظهار الخطأ الحقيقي للمساعدة في التصحيح إذا فشل الإدخال
        echo "<script>alert('خطأ: " . $conn->error . "');</script>";
    }
}

// 2. جلب قائمة المرضى المسجلين
$sql_patients = "SELECT * FROM patients ORDER BY patient_id DESC";
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

<div id="welcome-overlay" class="welcome-overlay">
    <div class="welcome-content">
        <h1>MS SmartScan</h1>
        <p>نظام ذكي متكامل للكشف التلقائي عن بؤر التصلب المتعدد (MS) في صور الرنين المغناطيسي وتصنيف الحالة فورياً.</p>
        <div class="intro-steps">
            <span>🧠 تحليل بالذكاء الاصطناعي</span>
            <span>📂 أرشفة فورية للنتائج</span>
            <span>📷 فحص حي عبر الكاميرا</span>
        </div>
        <button onclick="closeWelcome()" class="btn-start-now">ابدأ إدارة المرضى</button>
    </div>
</div>

<div class="container">
    <div class="card">
        <h2>تسجيل مريض جديد</h2>
        <form method="POST">
            <input type="text" name="id" placeholder="الرقم الطبي (ID)" required>
            <input type="text" name="name" placeholder="اسم المريض بالكامل" required>
            <input type="text" name="phone" placeholder="رقم الهاتف" required>
            <button type="submit" name="add_patient" class="btn-add">حفظ البيانات</button>
        </form>
    </div>

    <div class="card">
        <h2>قائمة المرضى ونتائج الفحص</h2>
        <table>
            <thead>
                <tr>
                    <th>رقم المريض</th>
                    <th>اسم المريض</th>
                    <th>آخر تشخيص</th> <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($result_patients && $result_patients->num_rows > 0) {
                    while($row = $result_patients->fetch_assoc()) {
                        // تحديد لون النتيجة: أحمر للمصاب وأخضر للسليم
                        $status = $row['status'] ?? 'لم يفحص';
                        $statusClass = ($status == 'Infected') ? 'status-infected' : (($status == 'Healthy') ? 'status-healthy' : 'status-none');
                        
                        echo "<tr>";
                        echo "<td>#" . $row['patient_id'] . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td><span class='status-badge $statusClass'>" . $status . "</span></td>";
                        echo "<td><a href='scan.php?id=" . $row['patient_id'] . "' class='btn-scan'>إجراء فحص</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align:center;'>لا يوجد مرضى مسجلين</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // وظيفة إخفاء الواجهة الترحيبية
    function closeWelcome() {
        document.getElementById('welcome-overlay').style.display = 'none';
    }
</script>

</body>
</html>
