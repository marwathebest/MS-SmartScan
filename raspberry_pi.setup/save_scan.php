<?php
include "connect.php";

// 1. التأكد من وصول البيانات
if (isset($_POST['image']) && isset($_POST['patient_id'])) {
    
    $patient_id = $_POST['patient_id'];

    // 2. تحويل الصورة من Base64 إلى ملف حقيقي
    $imageData = $_POST['image'];
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageBinary = base64_decode($imageData);

    // 3. حفظ الصورة في مجلد uploads (تأكدي أن المجلد موجود وصلاحياته 777)
    $image_path = '/var/www/html/uploads/temp_scan.png';
    file_put_contents($image_path, $imageBinary);

    // 4. تشغيل كود الذكاء الاصطناعي (YOLO)
    // لاحظي استخدمنا python3 والمسار الكامل
    exec("python3 /var/www/html/predict.py $image_path 2>&1", $output);

    // 5. استخراج النتيجة من مخرجات البايثون
    $label = "Unknown";
    $confidence = "0";

    foreach ($output as $line) {
        $line = trim($line);
        if (is_numeric($line)) {
            $confidence = $line;
        } elseif ($line == "Infected" || $line == "Healthy") {
            $label = $line;
        }
    }

    // 6. تحديث قاعدة البيانات
    $sql_update = "UPDATE patients SET status = '$label' WHERE patient_id = '$patient_id'";
    $conn->query($sql_update);

    // 7. إرسال النتيجة فقط (بدون أي HTML) لكي يفهمها ملف scan.php
    echo $label . "," . $confidence;

} else {
    echo "Error,0";
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نتيجة فحص MS SmartScan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .result-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            margin: 50px auto;
        }
        .status { color: #666; font-size: 0.9em; }
        .infected { color: #e74c3c; font-weight: bold; }
        .healthy { color: #27ae60; font-weight: bold; }
    </style>
</head>
<body>

    <div class="result-box">
        <h1>نتيجة فحص MS SmartScan</h1>
        <p class="status"><?php echo $status_message; ?></p>
        
        <hr>
        
        <h3>التشخيص النهائي:</h3>
        <h2 class="<?php echo (strtolower($result) == 'infected' || $result == 'مصاب') ? 'infected' : 'healthy'; ?>">
            <?php echo $result; ?>
        </h2>
        
        <p>نسبة التأكد: <strong><?php echo $accuracy; ?></strong></p>
        
        <div style="margin-top: 20px;">
            <img src="<?php echo $file_path; ?>" width="200" style="border-radius: 10px; border: 2px solid #ddd;">
        </div>

        <br>
        <a href="dashboard.php"><button>العودة للوحة التحكم</button></a>
    </div>

</body>
</html>
