<?php
include "connect.php"; // الاتصال بقاعدة البيانات

// جلب قائمة المرضى وتعريف المتغير لحل مشكلة السطر 115
$sql_patients = "SELECT * FROM patients ORDER BY patient_id DESC";
$result_patients = $conn->query($sql_patients);

// معالجة إضافة مريض جديد
if (isset($_POST['add_patient'])) {
    $patient_id = $conn->real_escape_string($_POST['id']);
    $patient_name = $conn->real_escape_string($_POST['name']);
    $patient_phone = $conn->real_escape_string($_POST['phone']);

    $sql_insert = "INSERT INTO patients (patient_id, full_name, phone_number) VALUES ('$patient_id', '$patient_name', '$patient_phone')";
    if ($conn->query($sql_insert) === TRUE) {
        header("Location: index.php");
    }
}
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
   <style> .system-status {
    display: flex;
    align-items: center;
    padding: 10px;
    background: #f0fdf4; /* لون خلفية هادئ */
    border-radius: 8px;
    width: fit-content;
    margin-bottom: 20px;
}

.status-dot {
    height: 12px;
    width: 12px;
    background-color: #22c55e; /* اللون الأخضر */
    border-radius: 50%;
    display: inline-block;
    margin-right: 10px;
    box-shadow: 0 0 8px #22c55e;
    animation: pulse 2s infinite; /* حركة نبض */
}

.status-text {
    color: #166534;
    font-weight: bold;
    font-size: 14px;
}

@keyframes pulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}
</style>
<div class="system-status">
    <span class="status-dot"></span>
    <span class="status-text">System Online</span>
</div>
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
             
       <select name="gender" required style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; font-family: 'Cairo';">
    <option value="" disabled selected>اختر الجنس</option>
    <option value="ذكر">ذكر</option>
    <option value="أنثى">أنثى</option>
</select>
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
            <th>آخر تشخيص</th> 
            <th>خيارات</th> 
        </tr> 
    </thead> 
    <tbody> 
        <?php  
        if ($result_patients && $result_patients->num_rows > 0) { 
            while($row = $result_patients->fetch_assoc()) { 
                
                $status = $row['status'] ?? 'لم يفحص'; 
                
                // تحديد لون "البطاقة" فقط بناءً على محتوى النص
                // سيبحث عن كلمة Infected أو بؤرة أو الرمز ⚠️ لتلوين النتيجة بالأحمر
                if (strpos($status, 'Infected') !== false || strpos($status, 'بؤرة') !== false || strpos($status, '⚠️') !== false) {
                    $statusClass = 'status-infected'; // أحمر للنتيجة
                } elseif (strpos($status, 'Healthy') !== false || strpos($status, 'سليم') !== false) {
                    $statusClass = 'status-healthy'; // أخضر للنتيجة
                } else {
                    $statusClass = 'status-none'; // رمادي
                }
                
                echo "<tr>"; 
                echo "<td>#" . $row['patient_id'] . "</td>"; 
                echo "<td>" . $row['full_name'] . "</td>"; // الاسم سيبقى بلونه الطبيعي
                
                // هنا التغيير: اللون يطبق فقط على ستايل النتيجة (status-badge)
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