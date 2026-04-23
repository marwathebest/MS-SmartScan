دليل تشغيل النظام على Raspberry Pi 5
هذا الدليل مخصص لتشغيل المشروع في بيئته الأصلية، مع كافة الأوامر البرمجية اللازمة لإعداد النظام.

أولاً: تحديث النظام وتثبيت السيرفر
نسخ الكود وضعيه في الـ Terminal لتثبيت Apache و PHP وقاعدة البيانات:

 ```bash
sudo apt update && sudo apt upgrade -y && sudo apt install apache2 php libapache2-mod-php php-mysql mariadb-server -y
 ```
ثانياً: تثبيت مكتبات الذكاء الاصطناعي
هذا الأمر سيقوم بتثبيت YOLO11m والمكتبات المطلوبة لمعالجة الصور:

 ```bash
pip install ultralytics opencv-python pillow --break-system-packages
 ```
ثالثاً: إعداد الملفات وصلاحيات النظام
لكي يعمل النظام ويتمكن من التقاط الصور وحفظها، يجب تنفيذ هذه الأوامر بالترتيب:

نقل الملفات وإعطاء الصلاحيات:

 ```bash
sudo chown -R www-data:www-data /var/www/html/MS.smartScan/
sudo chmod -R 777 /var/www/html/MS.smartScan/uploads
 ```
السماح للسيرفر باستخدام الكاميرا:

 ```bash
sudo usermod -a -G video www-data
 ```
رابعاً: تفعيل الكاميرا من الإعدادات
نفذي هذا الأمر لفتح شاشة الإعدادات:

 ```bash
sudo raspi-config
 ```
(اذهبي إلى Interface Options، ثم اختر Legacy Camera واجعليها Yes، ثم أعيدي تشغيل الجهاز).

🚀 التشغيل النهائي:
افتحي المتصفح داخل الرازبيري وتوجهي للرابط:
http://localhost/MS.smartScan/index.php
