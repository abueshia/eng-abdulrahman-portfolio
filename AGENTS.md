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

## 5. الموديلات والـ Enums وهيكلة قاعدة البيانات بعد المرحلة 2 (Phase 2 Domain State)

### أولاً: الـ Backed Enums (`app/Enums/` — PHP 8.3 `string` Enums مع `label()`, `color()`, `values()`, `options()`)
1. [`ProjectStatusEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/ProjectStatusEnum.php): `draft`, `published`, `archived`.
2. [`ProjectTypeEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/ProjectTypeEnum.php): `web_app`, `saas`, `api_backend`, `ecommerce`, `cms_dashboard`, `full_stack`.
3. [`TechnologyCategoryEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/TechnologyCategoryEnum.php): `backend`, `frontend`, `database`, `devops`, `architecture`, `testing`, `tools`.
4. [`EmploymentTypeEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/EmploymentTypeEnum.php): `full_time`, `part_time`, `contract`, `freelance`, `remote`.
5. [`CredentialTypeEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/CredentialTypeEnum.php): `academic_degree`, `professional_certificate`, `course`, `award`.
6. [`ContactMessageTypeEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/ContactMessageTypeEnum.php): `general_contact`, `project_inquiry`, `job_offer`, `consultation`.
7. [`ContactMessageStatusEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/ContactMessageStatusEnum.php): `new`, `read`, `in_progress`, `replied`, `archived`.
8. [`BlogStatusEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/BlogStatusEnum.php): `draft`, `published`, `archived`.
9. [`SettingGroupEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/SettingGroupEnum.php): `general`, `hero`, `about`, `contact`, `seo`, `sections_visibility`, `cta`.
10. [`SettingTypeEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/SettingTypeEnum.php): `text`, `textarea`, `rich_text`, `image`, `file`, `url`, `email`, `boolean`, `json`.
11. [`SettingKeyEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/SettingKeyEnum.php): مصدر الحقيقة الوحيد (Single Source of Truth) لجميع مفاتيح الإعدادات (`35` مفتاحاً) مع الدوال `group()`, `type()`, `isTranslatable()`, `default()`, و`defaultForLocale()`.

### ثانياً: الموديلات المعتمدة وجداولها وعلاقاتها (`app/Models/`)
1. [`Project`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Project.php) (`projects` + pivot `project_technology`):
   - يمثل المشاريع البرمجية ودراسات الحالة (`title`, `slug`, `subtitle`, `short_description`, `description`, `challenge`, `solution`, `results`, `metrics`, `project_type`, `status`, `live_url`, `repo_url`).
   - العلاقات: `category()`, `technologies()`, `testimonials()`.
   - الـ Scopes: `scopeActive`, `scopePublished`, `scopeFeatured`, `scopeOfType`, `scopeOrdered`.
   - الميديا: `projects` (صورة الغلاف)، `projects_gallery` (معرض شاشات المشروع).
2. [`Technology`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Technology.php) (`technologies`):
   - يمثل اللغات والتقنيات (`PHP 8.3`, `Laravel 10`, `React.js`, `JavaScript ES6+`, `MySQL`, `Redis`, `Clean Architecture & SOLID`, `PHPUnit`...).
   - العلاقات: `projects()`, `experiences()`.
   - الـ Scopes: `scopeActive`, `scopeFeatured`, `scopeByCategory`, `scopeOrdered`.
3. [`Experience`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Experience.php) (`experiences` + pivot `experience_technology`):
   - يمثل المسيرة المهنية والخبرات العملية.
   - العلاقات: `technologies()`.
   - الـ Scopes: `scopeActive`, `scopeOrdered`.
4. [`Credential`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Credential.php) (`credentials`):
   - يمثل المؤهلات الأكاديمية والشهادات الاحترافية والدورات.
   - الـ Scopes: `scopeActive`, `scopeOfType`, `scopeOrdered`.
5. [`Service`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Service.php) (`services`):
   - يمثل الخدمات البرمجية التي يقدمها م. عبدالرحمن أبو عيشة.
   - الـ Scopes: `scopeActive`, `scopeFeatured`, `scopeOrdered`.
6. [`Setting`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Setting.php) (`settings`):
   - نظام الإعدادات الديناميكية الموحد (`group`, `key`, `value` JSON, `type`, `is_translatable`, `sort_order`) ويشمل بيانات التعريف (`about`) والتواصل (`contact`) والـ SEO.
   - الدوال والـ Scopes: `localizedValue()`, `scopeByGroup`, `scopeOrdered`.
7. [`ContactMessage`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/ContactMessage.php) (`contact_messages`):
   - يمثل رسائل التواصل وطلبات المشاريع وعروض العمل (تم حذف موديل `Message` القديم المكرر نهائياً).
   - الـ Scopes: `scopeOfType`, `scopeWithStatus`, `scopeUnread`, `scopeOrdered`.
8. [`Testimonial`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Testimonial.php) (`testimonials`):
   - يمثل آراء وتقييمات العملاء مع ربط اختياري بالمشروع `project()`.
9. [`Category`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Category.php) (`categories`) & [`Blog`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Blog.php) (`blogs`):
   - التصنيفات والمقالات التقنية ثنائية اللغة (مع ربط `Blog::status` بـ [`BlogStatusEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/BlogStatusEnum.php)).
10. [`Faq`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Faq.php) (`faqs`) & [`Stat`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Stat.php) (`stats`):
    - الأسئلة الشائعة والإحصائيات الرقمية للبورتفوليو.
11. [`User`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/User.php), [`Role`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Role.php), [`Permission`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Permission.php):
    - إدارة المشرفين والصلاحيات على الحارس `admin`.

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

### المرحلة 2 (Phase 2 - Enums, Clean Migrations, Domain Models, Factories, Seeders & Schema Tests) — مكتملة ✅
1. **إنشاء 9 كلاسات PHP 8.3 Backed Enums في `app/Enums/` مع ملفات الترجمة (`resources/lang/{ar,en}/enums.php`):**
   - كل Enum يدعم `label()` و`color()` و`values()` و`options()`.
2. **إعادة بناء جميع ملفات الـ Migrations بشكل نظيف ومفهرس بالكامل:**
   - إنشاء جداول `settings`, `categories`, `technologies`, `projects`, `project_technology`, `experiences`, `experience_technology`, `credentials`, `services`, `testimonials`, `blogs`, `contact_messages`, `faqs`, `stats`, و`media` مع جميع الـ Foreign Keys والـ Indexes.
3. **بناء وتحديث جميع موديلات البورتفوليو في `app/Models/` والـ Factories في `database/factories/`:**
   - ربط الـ Casts بالـ Enums، توثيق العلاقات والـ Local Scopes بـ PHPDoc إنجليزي، وتفعيل `HasTranslations` و`InteractsWithMedia`.
4. **بناء الـ Seeders الغنية ببيانات م. عبدالرحمن أبو عيشة (`UserSeeder`, `RoleSeeder`, `SettingSeeder`, `PortfolioSeeder`) وتشغيل `migrate:fresh --seed` واختبارات `PortfolioDomainSchemaTest`.**

### المرحلة 3 (Phase 3 - Dynamic Settings Engine & Auth/Frontend Test Suite) — مكتملة ✅
1. **تنظيف اختبارات Laravel Breeze الموروثة وإضافة اختبارات المصادقة الفعلية (`AdminAuthenticationTest`):**
   - حذف `tests/Feature/Auth/`, `tests/Feature/ProfileTest.php`, `tests/Feature/ExampleTest.php`, و`tests/Unit/ExampleTest.php`.
   - إنشاء [`tests/Feature/Admin/AdminAuthenticationTest.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/tests/Feature/Admin/AdminAuthenticationTest.php) للتحقق من `/admin/login`، تسجيل الدخول والخروج بالحارس `admin`، حماية الصلاحيات (`403`)، وفتح الصفحة الرئيسية للموقع (`/ar` و`/en`).
2. **توحيد `ContactMessage` وإضافة `BlogStatusEnum`:**
   - حذف `app/Models/Message.php` المكرر نهائياً وتحديث جميع الكنترولرز لاستخدام [`ContactMessage`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/ContactMessage.php).
   - إنشاء [`app/Enums/BlogStatusEnum.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/BlogStatusEnum.php) وربطه بموديل [`Blog`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Models/Blog.php).
3. **بناء محرك الإعدادات الديناميكي المتكامل (Dynamic Settings Engine):**
   - إنشاء [`SettingKeyEnum`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Enums/SettingKeyEnum.php) كمصدر حقيقة وحيد (`group()`, `type()`, `isTranslatable()`, `default()`, `defaultForLocale()`).
   - إنشاء [`SettingRepositoryInterface`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Repositories/Contracts/SettingRepositoryInterface.php)، [`EloquentSettingRepository`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Repositories/Eloquent/EloquentSettingRepository.php)، [`SettingUpdateData`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/DTOs/SettingUpdateData.php) DTO، [`SettingObserver`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Observers/SettingObserver.php)، و[`SettingService`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Services/SettingService.php) مع الكاش الدائم `portfolio.settings`.
   - إنشاء [`UpdateSettingRequest`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Http/Requests/Admin/Setting/UpdateSettingRequest.php) وتحديث [`SettingController`](file:///d:/laragon/www/eng-abdulrahman-portfolio/app/Http/Controllers/Admin/SettingController.php) وصفحة التبويبات الـ 7 المتجاوبة [`resources/views/admin/pages/setting/index.blade.php`](file:///d:/laragon/www/eng-abdulrahman-portfolio/resources/views/admin/pages/setting/index.blade.php) واختبارات [`SettingServiceTest`](file:///d:/laragon/www/eng-abdulrahman-portfolio/tests/Feature/SettingServiceTest.php).
