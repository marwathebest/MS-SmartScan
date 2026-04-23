# دليل تشغيل النظام على Raspberry Pi 5 🍓

هذا الدليل مخصص لتشغيل مشروع **MS SmartScan** على جهاز الرازبيري باي لضمان عمل الكاميرا ونموذج الذكاء الاصطناعي بكفاءة.

## 1. المتطلبات التقنية (Hardware Requirements)
* جهاز Raspberry Pi 5.
* كاميرا Raspberry Pi Module V2.
* شاشة عرض (Display) متصلة عبر منفذ Micro-HDMI.
* نظام تشغيل Raspberry Pi OS (64-bit).

## 2. إعداد الكاميرا والبيئة
تأكد أولاً من تفعيل واجهة الكاميرا من خلال الإعدادات:
```bash
sudo raspi-config
(انتقل إلى Interface Options ثم Camera وتأكد من تفعيلها).
3. تثبيت المكتبات البرمجية
افتح الـ Terminal وقم بتثبيت المكتبات التالية:

Bash
# تحديث النظام
sudo apt update && sudo apt upgrade -y

# تثبيت مكتبات الذكاء الاصطناعي ومعالجة الصور
pip install ultralytics opencv-python --break-system-packages
4. إعداد خادم الويب (Apache & PHP)
قم بتنصيب خادم Apache و PHP إذا لم تكن مثبتة:

Bash
sudo apt install apache2 php libapache2-mod-php php-mysql -y
انقل ملفات المشروع إلى المسار: /var/www/html/MS.smartScan/.

مهم جداً: إعطاء صلاحيات الوصول للكاميرا والمجلدات:

Bash
sudo chown -R www-data:www-data /var/www/html/MS.smartScan/
sudo chmod -R 777 /var/www/html/MS.smartScan/uploads
5. إعداد قاعدة البيانات (MariaDB)
قم بإنشاء قاعدة البيانات عبر phpMyAdmin.

قم باستيراد ملف database.sql الموجود في المستودع.

تأكد من مطابقة بيانات الاتصال (المستخدم وكلمة المرور) في ملف db_config.php.

6. التشغيل النهائي
افتح متصفح Chromium في وضع ملء الشاشة (Kiosk Mode) وتوجه للرابط:
http://localhost/MS.smartScan/index.php

ملاحظة: تم تحسين الكود ليتوافق مع سرعة Raspberry Pi 5 واستخدام نظام المعالجة الجديد libcamera.


### الخطوة 3: الحفظ
اضغطي على **Commit changes**.

---
