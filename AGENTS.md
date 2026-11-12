# دليل المشروع المرجعي والمعماري الشامل (AGENTS.md)

> **تنبيه إلزامي للـ AI Agents والمطورين:**
> هذا الملف هو المرجع الأساسي والموثق بالكامل لمشروع **`eng-abdulrahman-portfolio`** بناءً على الكود الفعلي فقط.
> الكود البرمجي لهذا المشروع يُراجع مباشرةً من قِبل أصحاب شركات البرمجة والـ CTOs في المقابلات التقنية؛ لذلك فإن جودة المعمارية، النظافة البرمجية، التوثيق الإنجليزي الاحترافي، والاختبارات الآلية هي جزء أساسي من البورتفوليو نفسه.
> **قاعدة أمنية صارمة:** يُمنع منعاً باتاً كتابة أي مفتاح سري (API Key / Secret / Token) أو كلمة مرور داخل هذا الملف.

---

## 1. نظرة عامة على المشروع وهويته (Project Overview & Vision)

### هوية المشروع وصاحبه
هذا المشروع هو **المنصة الرسمية ومعرض الأعمال الشخصي ونظام إدارة المحتوى (Personal Portfolio CMS & Public REST API)** الخاص بـ:
- **الاسم بالعربية:** **مهندس / عبدالرحمن أبو عيشة** (`م. عبدالرحمن أبو عيشة`)
- **الاسم بالإنجليزية:** **`Eng. Abdelrahman Abu Aishah`** (`Eng/Abdelrahman Abu Aishah`)
- **المسمى الوظيفي والتخصص:** **مهندس برمجيات متكامل (Full-Stack Software Engineer)**
  - **تطوير الواجهات الخلفية (Backend Engineering):** متخصص ومحترف في **PHP 8.3 & Laravel 10** (بناء الأنظمة المتكاملة، Clean Architecture، قواعد البيانات، RESTful APIs، لوحات التحكم الإدارية، الأمان وتحسين الأداء).
  - **تطوير الواجهات الأمامية (Frontend Engineering):** متقن لتقنيات الواجهات الأمامية (**HTML5, CSS3, Modern JavaScript ES6+, Bootstrap 5, Responsive UI**) ومتقن لمكتبة **React.js**.
  - **سنوات الخبرة:** **+4 سنوات من الخبرة العملية** في تطوير وتسليم مشاريع برمجية متنوعة وعالية الجودة.

### الهوية البرمجية وبيانات الـ SEO المعتمدة (Portfolio Identity & SEO)

| البند | القيمة المعتمدة (عربي) | القيمة المعتمدة (إنجليزي) |
| :--- | :--- | :--- |
| **اسم صاحب الموقع** | مهندس / عبدالرحمن أبو عيشة | Eng. Abdelrahman Abu Aishah |
| **المسمى الوظيفي** | مهندس برمجيات متكامل (Full-Stack Developer) | Full-Stack Software Engineer (PHP Laravel & React.js) |
| **التخصص الأساسي** | تطوير باك إند PHP Laravel وفرونت إند JavaScript & React | PHP Laravel Backend & React.js Frontend Development |
| **سنوات الخبرة** | +4 سنوات خبرة في تطوير البرمجيات | 4+ Years of Experience in Software Engineering |
| **عنوان الـ SEO الافتراضي** | م. عبدالرحمن أبو عيشة \| مهندس برمجيات PHP Laravel & React | Eng. Abdelrahman Abu Aishah \| Full-Stack Software Engineer |
| **الكلمات المفتاحية (Keywords)** | عبدالرحمن أبو عيشة, مهندس برمجيات, مبرمج PHP, مبرمج Laravel, مطور React, مطور Full Stack, تصميم وتطوير مواقع, برمجة أنظمة ولوحات تحكم, RESTful APIs | Abdelrahman Abu Aishah, Software Engineer, PHP Developer, Laravel Developer, React.js Developer, Full Stack Developer, Web Development, Portfolio |

---

## 2. القواعد المعمارية الإلزامية (Mandatory Architectural Rules)

يجب الالتزام التام بالقواعد الـ 12 التالية في كل ملف يتم إنشاؤه أو تعديله:

1. **مبادئ SOLID الخمسة (`SRP`, `OCP`, `LSP`, `ISP`, `DIP`):**
   - كل كلاس له مسؤولية واحدة واضحة فقط.
   - الاعتماد في الـ Controllers والـ Services يكون على **Interfaces (Contracts)** وليس على Implementations مباشرة.
2. **برمجة كائنية (OOP) بمعايير PHP 8.3 الحديثة:**
   - إضافة `declare(strict_types=1);` في أعلى كل ملف PHP جديد أو معدّل.
   - استخدام **Backed Enums (`app/Enums/`)** بدلاً من الـ Magic Strings في حالات المشاريع، تصنيفات التقنيات، أنواع الرسائل، ومفاتيح الإعدادات.
   - استخدام `readonly` properties، وTyped Properties، وReturn Types الصريحة في جميع الدوال.
3. **نمط المستودعات (`Repository Pattern`):**
   - لكل موديول Interface في [`app/Repositories/Contracts/`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Repositories/Contracts) وتنفيذ Eloquent في [`app/Repositories/Eloquent/`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Repositories/Eloquent) يرث من [`BaseRepository`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Repositories/Eloquent/BaseRepository.php).
   - تُربط جميع الـ Interfaces بتطبيقاتها في [`RepositoryServiceProvider`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Providers/RepositoryServiceProvider.php).
4. **طبقة الخدمات (`Service Layer`):**
   - منطق الأعمال (Business Logic)، المعاملات (`DB::transaction`)، رفع الميديا، وإبطال الكاش (`Cache Invalidation`) يوضع في `app/Services/` فقط.
   - الـ Controller يكون **نحيفاً (Thin Controller)**: يستقبل الـ `FormRequest`، يستدعي الـ `Service`، ويُرجع `View` أو `JsonResponse` أو `RedirectResponse`.
5. **التحقق من المدخلات (`Form Requests`):**
   - يُمنع استخدام `$request->validate()` داخل الـ Controllers.
   - لكل عملية `Store` و`Update` كلاس `FormRequest` مستقل يحتوي على `authorize()` و`rules()` و`messages()`.
6. **كائنات نقل البيانات (`Pragmatic DTOs` - بدون إفراط هندسي):**
   - تُستخدم كلاسات `readonly class` في `app/DTOs/` **فقط للموديولات المعقدة**:
     - `ProjectData` (للمشاريع ودراسات الحالة)
     - `ContactMessageData` (لرسائل التواصل وطلبات المشاريع)
     - `SettingUpdateData` (لتحديث الإعدادات الديناميكية)
   - الموديولات البسيطة (`Technology`, `Experience`, `Credential`, `Service`, `Testimonial`, `Blog`, `Category`, `Faq`, `Stat`) تعتمد على `$request->validated()` مباشرةً لتجنب التكرار غير المبرر.
7. **نطاقات الاستعلام (`Eloquent Scopes`):**
   - تُعرّف الاستعلامات المتكررة كـ Local Scopes داخل الموديل (`scopeActive`, `scopeFeatured`, `scopePublished`, `scopeOrdered`).
   - يُمنع كتابة أي استعلام قاعدة بيانات في ملفات `Blade` أو في الـ `Controllers`.
8. **موارد الـ API (`API Resources`):**
   - جميع مسارات الـ API العامة (`/api/v1/*`) تكون للقراءة فقط (بالإضافة لمسار إرسال رسالة تواصل محمي بـ `throttle` Rate Limiting) بدون مصادقة معقدة أو مفاتيح ثابتة في الكود، وتُرجع استجاباتها عبر `JsonResource` مع `ApiResponseTrait`.
9. **الصلاحيات والسياسات (`Policies & Gates`):**
   - حماية جميع إجراءات لوحة التحكم عبر Spatie Permissions وLaravel Policies على الحارس `admin`.
10. **معايير الكود (`PSR-12` & `Laravel Pint`):**
    - الالتزام الكامل بـ PSR-12 وتمرير جميع الملفات على `./vendor/bin/pint` (المضبوط عبر [`pint.json`](file:///d:/laragon/www/eng-abdulrahman-portfolio/pint.json)) قبل اعتماد أي مرحلة.
11. **التوثيق الإنجليزي الاحترافي (`English Documentation & PHPDoc`):**
    - جميع التعليقات داخل الكود، وملخصات أعلى الملفات، والـ `PHPDoc`، وملفات `README.md` و`docs/*.md` تُكتب **باللغة الإنجليزية فقط**.
    - ملف `AGENTS.md` فقط يُكتب باللغة العربية.
12. **الاختبارات الآلية (`PHPUnit Feature Tests`):**
    - إرفاق اختبارات `Feature` في `tests/Feature/` للتحقق من الـ Services ومسارات الـ API في كل مرحلة، والتأكد من نجاح `php artisan test`.

---

## 3. التقنيات والإصدارات (Tech Stack & Versions)

| التقنية / الحزمة | الإصدار | الاستخدام في المشروع |
| :--- | :--- | :--- |
| **PHP** | `^8.3` (`8.3.26`) | لغة الخادم الأساسية مع `strict_types=1`، `Enums`، و`readonly` classes. |
| **Laravel Framework** | `^10.10` (`10.50.3`) | إطار العمل الأساسي. |
| **Spatie Permission** | `^6.10` | إدارة الأدوار والصلاحيات (`roles`, `permissions`) على الحارس `admin`. |
| **Spatie MediaLibrary** | `^10.0` | إدارة رفع الصور والملفات وربطها بالموديلات (`media` table). |
| **Spatie Translatable** | `^6.8` | تخزين الحقول متعددة اللغات (`ar`, `en`) بصيغة JSON في قاعدة البيانات. |
| **Spatie View Models** | `^1.6` | تمرير البيانات لصفحات النماذج في لوحة التحكم. |
| **Yajra DataTables** | `^10.11` | عرض جداول البيانات التفاعلية عبر AJAX في لوحة التحكم. |
| **Laravel Localization** | `^2.0` (`mcamara`) | إدارة تعدد اللغات في الروابط (`/ar/...` و`/en/...`) ودعم `RTL/LTR`. |
| **Laravel Pint** | `^1.0` | فحص وتنسيق الكود تلقائياً وفق معيار `PSR-12` و`pint.json`. |
| **PHPUnit** | `^10.1` | إطار الاختبارات الآلية (`Unit` & `Feature Tests`). |

---

## 4. هيكل المجلدات المعماري (Directory Structure)

```text
eng-abdulrahman-portfolio/
├── app/
│   ├── Console/                    # أوامر Artisan وجدولة المهام
│   ├── DTOs/                       # كائنات نقل البيانات للموديولات المعقدة (Project, ContactMessage, Setting)
│   ├── Enums/                      # PHP 8.3 Backed Enums (تُضاف في المرحلة 2 و3)
│   ├── Exceptions/                 # معالجة الاستثناءات والأخطاء
│   ├── Helpers/                    # الدوال المساعدة المحملة تلقائياً
│   │   ├── HelperFunctions.php     # دوال: setting(), activeLink(), hoverLink(), showLink()...
│   │   ├── ReorderHelper.php       # منطق الترتيب
│   │   └── TranslationHelper.php   # دالة TranslationHelper::translate()
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # كنترولرز لوحة التحكم النحيفة (Thin Admin Controllers)
│   │   │   ├── API/                # كنترولرز الـ API العامة للبورتفوليو
│   │   │   ├── Auth/               # كنترولرز مصادقة المشرفين
│   │   │   └── Front/              # كنترولرز الموقع الأمامي (WebController, BlogController)
│   │   ├── Middleware/             # وسطاء الحماية واللغة (AdminCheck, ApiSetting بدون x-api-key...)
│   │   ├── Requests/               # Form Requests للتحقق من المدخلات
│   │   └── Resources/              # API JSON Resources
│   ├── Models/                     # موديلات Eloquent
│   ├── Observers/                  # مراقبو الموديلات (مثل SettingObserver لإبطال الكاش)
│   ├── Policies/                   # سياسات الصلاحيات (Policies)
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── RepositoryServiceProvider.php # ربط Repository Contracts بالـ Eloquent Implementations
│   │   └── RouteServiceProvider.php
│   ├── Repositories/
│   │   ├── Contracts/              # Interfaces (BaseRepositoryInterface + Domain Contracts)
│   │   └── Eloquent/               # Implementations (BaseRepository + Domain Repositories)
│   ├── Services/                   # طبقة منطق الأعمال (Business Logic Layer)
│   ├── Traits/
│   │   ├── ApiResponseTrait.php    # توحيد استجابات الـ JSON في الـ API
│   │   └── HandleUploadFile.php    # دوال رفع وتحديث الصور عبر Spatie MediaLibrary
│   └── ViewModels/                 # كلاسات ViewModels للنماذج
├── config/                         # ملفات الإعدادات
├── database/
│   ├── factories/
│   ├── migrations/                 # ملفات بناء الجداول النظيفة
│   └── seeders/                    # البيانات الأولية للبورتفوليو
├── public/
│   ├── dashboard/assets/           # ملفات Metronic 8 للوحة التحكم
│   └── front/assets/               # ملفات الواجهة الأمامية
├── resources/
│   ├── lang/                       # ملفات الترجمة (ar و en)
│   └── views/                      # قوالب Blade (admin و front)
├── routes/
│   ├── web.php                     # مسارات البورتفوليو الأمامية + /sitemap.xml
│   ├── admin.php                   # مسارات لوحة التحكم
│   ├── api.php                     # مسارات الـ API العامة المحمية بـ Rate Limiting
│   └── auth.php                    # مسارات تسجيل دخول/خروج الأدمن (/admin/login)
├── tests/
│   ├── Feature/                    # اختبارات الميزات والـ API والـ Architecture
│   └── Unit/                       # اختبارات الوحدات
└── pint.json                       # إعدادات Laravel Pint الصارمة (PSR-12 + strict_types)
```

---

## 5. حالة الموديلات والملفات الحالية بعد تنظيف المرحلة 1 (Phase 1 State)

### ما تم حذفه نهائياً في المرحلة 1 (Legacy Cleanup):
- **الموديلات المحذوفة:** `About`, `Banner`, `Client`, `Contact`, `Gallery`, `Otp`, `Privacypolicy`, `Termsandcondition`.
- **الخدمات (Services) المحذوفة:** `AboutService`, `BannerService`, `ClientService`, `ContactService`, `GalleryService`, `NewsService`, `PrivacypolicyService`, `TermsandconditionService`.
- **الكنترولرز المحذوفة:**
  - `Admin`: `AboutController`, `BannerController`, `ClientController`, `ContactController`, `GalleryController`, `PrivacypolicyController`, `RateController`, `TermsandconditionController`.
  - `API`: `AboutusController`, `BannerController`, `ClientController`, `ContactController`, `LoginController`, `PrivacypolicyController`, `TermsandconditionController`, `VoucherspageController`.
  - `Front`: `AuthController`.
- **الـ Jobs المحذوفة:** `FetchAirportData`, `FetchJsonData`, `ProcessCityBatch`.
- **الـ ViewModels المحذوفة:** 35 ملف ViewModel قديم موروث من قوالب السياحة والعيادة.
- **الـ Migrations المحذوفة:** جميع جداول السياحة، العملاء (`clients`)، الـ OTP، البانرات القديمة (`banners`)، المعرض (`galleries`)، سياسة الخصوصية والشروط (`privacy_policy`, `terms_and_condition`)، و`about_uses` و`contacts` (حيث سيتم دمج بيانات التعريف والتواصل في نظام الإعدادات الديناميكي `Settings` في المرحلة 2 و3).

### الموديلات الأساسية المتبقية حالياً (وستُبنى عليها هيكلة المرحلة 2):
1. [`Blog`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Blog.php) (المقالات التقنية)
2. [`Category`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Category.php) (التصنيفات التقنية)
3. [`Message`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Message.php) (رسائل التواصل وطلبات المشاريع — ستُطوّر في المرحلة 2)
4. [`Permission`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Permission.php) & [`Role`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Role.php) (الأدوار والصلاحيات على الحارس `admin`)
5. [`Setting`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Setting.php) (الإعدادات الديناميكية)
6. [`Testimonial`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Testimonial.php) (آراء وتقييمات العملاء)
7. [`User`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/User.php) (حساب المشرف الإداري للبورتفوليو)

---

## 6. سجل الشغل والتعديلات المعمارية (Changelog)

### المرحلة 1 (Phase 1 - Foundation, Legacy Cleanup & Base Repository Architecture) — مكتملة ✅
1. **توثيق القواعد المعمارية الإلزامية في `AGENTS.md`:**
   - اعتماد مبادئ SOLID، `declare(strict_types=1)`، Enums، Repository Pattern، Service Layer، Pragmatic DTOs، والتوثيق الإنجليزي الكامل، وحذف أي مفاتيح سرية من التوثيق.
2. **التنظيف الجذري للملفات الموروثة (Legacy Cleanup):**
   - حذف جميع الموديلات والخدمات والكنترولرز والـ Jobs والـ ViewModels والـ Requests والـ Resources والـ Migrations الخاصة بالعيادة أو القالب السياحي القديم، بالإضافة لحذف `Privacypolicy` و`Termsandcondition` و`About` و`Contact` المستقلة تمهيداً لدمج بيانات التعريف والتواصل في `Settings`.
3. **تنظيف الدوال المساعدة والـ Middleware والمسارات:**
   - إعادة كتابة [`app/Helpers/HelperFunctions.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Helpers/HelperFunctions.php) بمعيار `strict_types=1` وحذف جميع دوال الفنادق والمطارات القديمة.
   - تحديث [`app/Http/Middleware/ApiSetting.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Http/Middleware/ApiSetting.php) لإزالة فحص `x-api-key` الثابت نهائياً، والاكتفاء بضبط لغة الـ API (`ar`/`en`) من الهيدر `Accept-Language`.
   - تنظيف [`routes/web.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/routes/web.php)، [`routes/admin.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/routes/admin.php)، و[`routes/api.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/routes/api.php) مع إضافة Rate Limiting (`throttle:5,1`) على إرسال الرسائل.
4. **تأسيس البنية التحتية للـ Repository Pattern وLaravel Pint والاختبارات:**
   - إنشاء [`BaseRepositoryInterface`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Repositories/Contracts/BaseRepositoryInterface.php)، [`BaseRepository`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Repositories/Eloquent/BaseRepository.php)، و[`RepositoryServiceProvider`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Providers/RepositoryServiceProvider.php).
   - إعداد [`pint.json`](file:///d:/laragon/www/eng-abdulrahman-portfolio/pint.json) وإنشاء اختبار [`ArchitectureFoundationTest`](file:///d:/laragon/www/eng-abdulrahman-portfolio/tests/Feature/ArchitectureFoundationTest.php).
