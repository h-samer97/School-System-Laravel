# 🏫 نظام إدارة المدارس | School Management System (Core Backend)

نظام متكامل لإدارة المؤسسات التعليمية مبني بإطار عمل **Laravel 12**، يركز على أتمتة العمليات الأكاديمية والمالية من خلال **لوحة تحكم إدارية موحدة** وشاملة.

---

## 🚀 التقنيات المستخدمة (Tech Stack)
* **Framework:** Laravel 12.x
* **Frontend:** * **Template:** تم الاعتماد على قالب (Theme) جاهز لتنسيق الواجهات.
    * **Components:** Blade Templates, Livewire (Form Wizards).
* **Database:** MySQL
* **Key Packages:** `mcamara/laravel-localization` & `spatie/laravel-translatable`.

---

## 🛠 المحاور المنجزة (Core Features)

### 1. الإدارة المركزية (Unified Dashboard)
* **Centralized Control:** لوحة تحكم موحدة لإدارة كافة أركان النظام (طلاب، معلمين، حسابات) من مكان واحد.
* **Localization:** دعم كامل للغتين العربية والإنجليزية.

### 2. الهيكلية الأكاديمية والطلاب
* **Grades & Sections:** تنظيم المراحل الدراسية والأقسام وعلاقتها بالمعلمين.
* **Student Management:** نظام CRUD متكامل، مرفقات (Polymorphic)، وعمليات الترقية والتخرج.
* **Parent Portal (Livewire):** نموذج تسجيل أولياء الأمور بنظام الـ Wizard والتحقق اللحظي.

### 3. النظام المالي (Finance System)
* **Fee Management:** إدارة الرسوم، الفواتير، سندات القبض، ومعالجة الرسوم (Processing Fees).

---
> **ملاحظة:** تم تبسيط النظام ليعتمد على لوحة تحكم موحدة لزيادة كفاءة الإدارة وتقليل التعقيد البرمجي، مع الحفاظ على قوة الـ Backend Logic.

## ⚙️ متطلبات التشغيل (Installation)
1. قم بتحميل المستودع (Clone).
2. نفذ أمر `composer install`.
3. قم بإنشاء ملف `.env` وربط قاعدة البيانات.
4. نفذ الـ Migrations والـ Seeders: `php artisan migrate --seed`.
5. قم بتشغيل المشروع: `php artisan serve`.

### 🔐 بيانات الدخول الافتراضية:
* **Email:** root@root.com
* **Password:** root