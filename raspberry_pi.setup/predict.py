from ultralytics import YOLO
import sys

# استخدمي المسار الكامل (Absolute Path) لضمان الوصول للملف
model = YOLO('/var/www/html/best.pt') 

# استلام مسار الصورة من الـ PHP
image_path = sys.argv[1]

# إجراء الفحص
results = model(image_path)

# طباعة النتائج لكي يستلمها الـ PHP
for r in results:
    if len(r.boxes) > 0:
        # طباعة التصنيف (Infected أو Healthy)
        print(r.names[int(r.boxes.cls[0])])
        # طباعة نسبة اليقين
        print(round(float(r.boxes.conf[0]) * 100, 2))
    else:
        print("No Detection")
        print(0)
# في نهاية ملف predict.py
if results[0].boxes:
    print("Infected")
    print(round(float(results[0].boxes.conf[0]) * 100, 1))
else:
    print("Healthy")
    print(99.0) # نسبة افتراضية لليقين
