<?php

/**
 * PortfolioSeeder
 *
 * Seeds realistic bilingual (Arabic & English) portfolio data for
 * Eng. Abdelrahman Abu Aishah (Full-Stack Software Engineer: PHP Laravel & React.js, 4+ Years Exp).
 */

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\BlogStatusEnum;
use App\Enums\CredentialTypeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Enums\TechnologyCategoryEnum;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Credential;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Service;
use App\Models\Stat;
use App\Models\Technology;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedStats();
        $categories = $this->seedCategories();
        $technologies = $this->seedTechnologies();
        $this->seedServices();
        $projects = $this->seedProjects($categories, $technologies);
        $this->seedExperiences($technologies);
        $this->seedCredentials();
        $this->seedTestimonials($projects);
        $this->seedFaqs();
        $this->seedBlogs($categories);
    }

    /**
     * Seed quantitative career statistics.
     */
    private function seedStats(): void
    {
        $stats = [
            [
                'value' => '4',
                'prefix' => '+',
                'suffix' => null,
                'icon' => 'fa-solid fa-briefcase',
                'sort_order' => 1,
                'label' => [
                    'ar' => 'سنوات من الخبرة العملية',
                    'en' => 'Years of Hands-On Experience',
                ],
            ],
            [
                'value' => '30',
                'prefix' => '+',
                'suffix' => null,
                'icon' => 'fa-solid fa-diagram-project',
                'sort_order' => 2,
                'label' => [
                    'ar' => 'نظام ومشروع برمجي مكتمل',
                    'en' => 'Delivered Software Systems',
                ],
            ],
            [
                'value' => '99.9',
                'prefix' => null,
                'suffix' => '%',
                'icon' => 'fa-solid fa-server',
                'sort_order' => 3,
                'label' => [
                    'ar' => 'استقرار وجودة الأنظمة (Uptime)',
                    'en' => 'Production API Reliability',
                ],
            ],
            [
                'value' => '100',
                'prefix' => null,
                'suffix' => '%',
                'icon' => 'fa-solid fa-code-branch',
                'sort_order' => 4,
                'label' => [
                    'ar' => 'التزام بمعايير Clean Code & SOLID',
                    'en' => 'Clean Architecture & SOLID Compliance',
                ],
            ],
        ];

        foreach ($stats as $stat) {
            Stat::query()->updateOrCreate(
                ['sort_order' => $stat['sort_order']],
                $stat + ['is_active' => true]
            );
        }
    }

    /**
     * Seed project and article categories.
     *
     * @return array<string, Category>
     */
    private function seedCategories(): array
    {
        $items = [
            'enterprise-saas' => [
                'name' => [
                    'ar' => 'الأنظمة المؤسسية ومنصات الـ SaaS',
                    'en' => 'Enterprise Systems & SaaS Platforms',
                ],
                'description' => [
                    'ar' => 'أنظمة تخطيط الموارد ولوحات التحكم متعددة الصلاحيات المبنية بـ Laravel و React.',
                    'en' => 'Multi-tenant platforms, ERP modules, and role-based management systems.',
                ],
                'sort_order' => 1,
            ],
            'restful-apis-backend' => [
                'name' => [
                    'ar' => 'هندسة الباك إند والـ RESTful APIs',
                    'en' => 'Backend Architecture & RESTful APIs',
                ],
                'description' => [
                    'ar' => 'واجهات برمجية عالية الأداء ومؤمنة لتطبيقات الموبايل والويب.',
                    'en' => 'High-throughput, secure RESTful APIs and microservices integration.',
                ],
                'sort_order' => 2,
            ],
            'react-frontend-spas' => [
                'name' => [
                    'ar' => 'تطبيقات الواجهات التفاعلية (React.js)',
                    'en' => 'Interactive React.js SPAs & Dashboards',
                ],
                'description' => [
                    'ar' => 'واجهات مستخدم عصرية وسريعة الاستجابة باستخدام React.js و JavaScript الحديث.',
                    'en' => 'Responsive single-page applications and real-time analytics dashboards.',
                ],
                'sort_order' => 3,
            ],
        ];

        $result = [];
        foreach ($items as $slug => $data) {
            $result[$slug] = Category::query()->updateOrCreate(
                ['slug' => $slug],
                $data + ['is_active' => true]
            );
        }

        return $result;
    }

    /**
     * Seed core technologies in Eng. Abdelrahman Abu Aishah's stack.
     *
     * @return array<string, Technology>
     */
    private function seedTechnologies(): array
    {
        $items = [
            'php-8' => [
                'name' => ['ar' => 'PHP 8.3', 'en' => 'PHP 8.3'],
                'category' => TechnologyCategoryEnum::Backend,
                'icon' => 'fa-brands fa-php',
                'badge_color' => 'primary',
                'proficiency_percent' => 96,
                'years_of_experience' => 4.5,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            'laravel' => [
                'name' => ['ar' => 'Laravel 10', 'en' => 'Laravel 10'],
                'category' => TechnologyCategoryEnum::Backend,
                'icon' => 'fa-brands fa-laravel',
                'badge_color' => 'danger',
                'proficiency_percent' => 98,
                'years_of_experience' => 4.5,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            'react-js' => [
                'name' => ['ar' => 'React.js', 'en' => 'React.js'],
                'category' => TechnologyCategoryEnum::Frontend,
                'icon' => 'fa-brands fa-react',
                'badge_color' => 'info',
                'proficiency_percent' => 92,
                'years_of_experience' => 3.5,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            'javascript-es6' => [
                'name' => ['ar' => 'JavaScript (ES6+)', 'en' => 'JavaScript (ES6+)'],
                'category' => TechnologyCategoryEnum::Frontend,
                'icon' => 'fa-brands fa-js',
                'badge_color' => 'warning',
                'proficiency_percent' => 94,
                'years_of_experience' => 4.5,
                'is_featured' => true,
                'sort_order' => 4,
            ],
            'mysql' => [
                'name' => ['ar' => 'MySQL & Database Design', 'en' => 'MySQL & Database Design'],
                'category' => TechnologyCategoryEnum::Database,
                'icon' => 'fa-solid fa-database',
                'badge_color' => 'success',
                'proficiency_percent' => 95,
                'years_of_experience' => 4.5,
                'is_featured' => true,
                'sort_order' => 5,
            ],
            'restful-apis' => [
                'name' => ['ar' => 'RESTful APIs', 'en' => 'RESTful APIs'],
                'category' => TechnologyCategoryEnum::Backend,
                'icon' => 'fa-solid fa-network-wired',
                'badge_color' => 'primary',
                'proficiency_percent' => 97,
                'years_of_experience' => 4.5,
                'is_featured' => true,
                'sort_order' => 6,
            ],
            'clean-architecture-solid' => [
                'name' => ['ar' => 'Clean Architecture & SOLID', 'en' => 'Clean Architecture & SOLID'],
                'category' => TechnologyCategoryEnum::Architecture,
                'icon' => 'fa-solid fa-cubes',
                'badge_color' => 'dark',
                'proficiency_percent' => 95,
                'years_of_experience' => 4.0,
                'is_featured' => true,
                'sort_order' => 7,
            ],
            'html5-css3-bootstrap' => [
                'name' => ['ar' => 'HTML5, CSS3 & Bootstrap 5', 'en' => 'HTML5, CSS3 & Bootstrap 5'],
                'category' => TechnologyCategoryEnum::Frontend,
                'icon' => 'fa-brands fa-bootstrap',
                'badge_color' => 'info',
                'proficiency_percent' => 96,
                'years_of_experience' => 4.5,
                'is_featured' => true,
                'sort_order' => 8,
            ],
            'redis-caching' => [
                'name' => ['ar' => 'Redis & Performance Caching', 'en' => 'Redis & Performance Caching'],
                'category' => TechnologyCategoryEnum::Database,
                'icon' => 'fa-solid fa-bolt',
                'badge_color' => 'danger',
                'proficiency_percent' => 90,
                'years_of_experience' => 3.5,
                'is_featured' => false,
                'sort_order' => 9,
            ],
            'phpunit-testing' => [
                'name' => ['ar' => 'PHPUnit & Automated Testing', 'en' => 'PHPUnit & Automated Testing'],
                'category' => TechnologyCategoryEnum::Testing,
                'icon' => 'fa-solid fa-vial-circle-check',
                'badge_color' => 'success',
                'proficiency_percent' => 92,
                'years_of_experience' => 4.0,
                'is_featured' => true,
                'sort_order' => 10,
            ],
            'git-devops' => [
                'name' => ['ar' => 'Git, GitHub & Linux/cPanel Deployment', 'en' => 'Git, GitHub & Linux/cPanel Deployment'],
                'category' => TechnologyCategoryEnum::Devops,
                'icon' => 'fa-brands fa-git-alt',
                'badge_color' => 'secondary',
                'proficiency_percent' => 94,
                'years_of_experience' => 4.5,
                'is_featured' => false,
                'sort_order' => 11,
            ],
        ];

        $result = [];
        foreach ($items as $slug => $data) {
            $result[$slug] = Technology::query()->updateOrCreate(
                ['slug' => $slug],
                $data + ['is_active' => true]
            );
        }

        return $result;
    }

    /**
     * Seed software engineering services.
     */
    private function seedServices(): void
    {
        $services = [
            'laravel-backend-engineering' => [
                'title' => [
                    'ar' => 'تطوير وهندسة أنظمة الباك إند (PHP Laravel)',
                    'en' => 'Enterprise Backend Engineering (PHP Laravel)',
                ],
                'subtitle' => [
                    'ar' => 'أنظمة معمارية نظيفة قابلة للتوسع',
                    'en' => 'Scalable, Clean-Architected Server Systems',
                ],
                'short_description' => [
                    'ar' => 'بناء أنظمة ويب متكاملة وآمنة باستخدام PHP 8.3 و Laravel وفق مبادئ SOLID ونمط المستودعات والخدمات.',
                    'en' => 'Building secure, modular web backends using PHP 8.3 & Laravel 10 with Repository Pattern, Service Layer, and SOLID principles.',
                ],
                'description' => [
                    'ar' => 'تصميم وتنفيذ البنية التحتية للأنظمة السحابية والمؤسسية، هيكلة قواعد البيانات العلائقية، إدارة الصلاحيات المتقدمة (RBAC)، وتحسين سرعة الاستعلامات.',
                    'en' => 'End-to-end backend system design, relational database modeling, role-based access control (RBAC), queue jobs, and query optimization.',
                ],
                'features' => [
                    'ar' => 'معمارية SOLID نظيفة، أمان متقدم، أداء عالٍ، اختبارات PHPUnit',
                    'en' => 'SOLID Architecture, RBAC Security, High Performance, Automated Tests',
                ],
                'icon' => 'fa-brands fa-laravel',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            'react-frontend-development' => [
                'title' => [
                    'ar' => 'تطوير الواجهات الأمامية التفاعلية (React.js & JS)',
                    'en' => 'Interactive Frontend & SPA Development (React.js)',
                ],
                'subtitle' => [
                    'ar' => 'تجربة مستخدم سريعة ومتجاوبة على جميع الشاشات',
                    'en' => 'Fast, Responsive Component-Driven User Interfaces',
                ],
                'short_description' => [
                    'ar' => 'تحويل التصميمات المعقدة إلى تطبيقات ويب تفاعلية حديثة باستخدام React.js و JavaScript ES6+ و Bootstrap 5.',
                    'en' => 'Crafting modern, accessible, and responsive user interfaces using React.js, ES6+ JavaScript, HTML5, and CSS3.',
                ],
                'description' => [
                    'ar' => 'بناء مكونات واجهة مستخدم قابلة لإعادة الاستخدام، ربط سلس مع الـ REST APIs، ودعم كامل للغتين العربية (RTL) والإنجليزية (LTR).',
                    'en' => 'Developing reusable UI components, seamless REST API state management, and native bilingual RTL/LTR responsiveness.',
                ],
                'features' => [
                    'ar' => 'تطبيقات React.js أحادية الصفحة، دعم RTL/LTR، توافق كامل مع الموبايل',
                    'en' => 'React.js SPAs, Bilingual RTL/LTR Support, Mobile-First UI',
                ],
                'icon' => 'fa-brands fa-react',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            'restful-api-integration' => [
                'title' => [
                    'ar' => 'بناء الـ RESTful APIs والربط البرمجي',
                    'en' => 'RESTful API Architecture & Third-Party Integrations',
                ],
                'subtitle' => [
                    'ar' => 'واجهات برمجية موحدة لتطبيقات الموبايل والفرونت إند',
                    'en' => 'Standardized JSON APIs for Mobile & Web Clients',
                ],
                'short_description' => [
                    'ar' => 'تصميم وتطوير RESTful APIs موثقة ومحمية مع الربط ببوابات الدفع الإلكتروني وخدمات الطرف الثالث.',
                    'en' => 'Designing versioned, rate-limited RESTful APIs and integrating payment gateways, notifications, and external SaaS APIs.',
                ],
                'description' => [
                    'ar' => 'اعتماد Eloquent API Resources، التحقق الصارم عبر FormRequests، وتوحيد هيكلة الاستجابات والأخطاء.',
                    'en' => 'Implementing Eloquent API Resources, strict FormRequest validation, rate limiting, and standardized JSON envelopes.',
                ],
                'features' => [
                    'ar' => 'توثيق واضح، حماية Rate Limiting، ربط بوابات الدفع والإشعارات',
                    'en' => 'Versioned Endpoints, Rate Limiting, Payment & Webhook Integrations',
                ],
                'icon' => 'fa-solid fa-code-commit',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            'custom-cms-erp-dashboards' => [
                'title' => [
                    'ar' => 'برمجة لوحات التحكم وأنظمة الإدارة المخصصة (CMS & ERP)',
                    'en' => 'Custom Admin Dashboards, CMS & ERP Solutions',
                ],
                'subtitle' => [
                    'ar' => 'أتمتة العمليات الإدارية والتقارير التفصيلية',
                    'en' => 'Streamlined Workflows & Real-Time Reporting',
                ],
                'short_description' => [
                    'ar' => 'تطوير لوحات تحكم إدارية ذكية متعددة اللغات والصلاحيات لإدارة المحتوى، المبيعات، والعمليات التشغيلية.',
                    'en' => 'Engineering multi-language admin dashboards with granular permissions, dynamic settings, and interactive data tables.',
                ],
                'description' => [
                    'ar' => 'لوحات تحكم مبنية خصيصاً لاحتياجات الشركات مع إحصائيات فورية وجداول بيانات سريعة التصفية.',
                    'en' => 'Tailored administrative portals featuring real-time KPIs, Yajra DataTables, media management, and audit-ready workflows.',
                ],
                'features' => [
                    'ar' => 'صلاحيات دقيقة (Spatie)، جداول تفاعلية، تقارير وإحصائيات',
                    'en' => 'Granular Permissions, AJAX DataTables, Dynamic Configuration',
                ],
                'icon' => 'fa-solid fa-gauge-high',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($services as $slug => $data) {
            Service::query()->updateOrCreate(
                ['slug' => $slug],
                $data + ['is_active' => true]
            );
        }
    }

    /**
     * Seed flagship portfolio projects with full Case Study details.
     *
     * @param  array<string, Category>  $categories
     * @param  array<string, Technology>  $technologies
     * @return array<string, Project>
     */
    private function seedProjects(array $categories, array $technologies): array
    {
        $projectsData = [
            'enterprise-erp-inventory-platform' => [
                'category_id' => $categories['enterprise-saas']->id,
                'title' => [
                    'ar' => 'منصة إدارة الموارد والمخازن المؤسسية (Enterprise ERP & Inventory)',
                    'en' => 'Enterprise ERP & Multi-Branch Inventory Platform',
                ],
                'subtitle' => [
                    'ar' => 'نظام سحابي متكامل بـ Laravel 10 و React.js',
                    'en' => 'Full-Stack Cloud ERP Built with Laravel 10 & React.js',
                ],
                'short_description' => [
                    'ar' => 'منصة متكاملة لإدارة الفروع، المخزون، الفواتير، وصلاحيات الموظفين مع تقارير لحظية.',
                    'en' => 'A comprehensive multi-branch ERP for inventory tracking, invoicing, and role-based workflows with real-time analytics.',
                ],
                'description' => [
                    'ar' => 'تم تصميم وتنفيذ النظام لخدمة الشركات متوسطة وكبيرة الحجم، مع فصل كامل بين طبقة منطق الأعمال (Service Layer) وطبقة البيانات (Repositories) وواجهة تفاعلية بـ React.js.',
                    'en' => 'Engineered for mid-to-large enterprises with strict separation between the Service Layer, Eloquent Repositories, and an interactive React.js dashboard.',
                ],
                'challenge' => [
                    'ar' => 'الحاجة إلى مزامنة أرصدة المخزون والفواتير عبر فروع متعددة في نفس اللحظة دون تضارب في البيانات أو بطء في التقارير.',
                    'en' => 'Synchronizing real-time stock levels and financial ledgers across multiple branches under concurrent transactions without race conditions.',
                ],
                'solution' => [
                    'ar' => 'تطبيق المعاملات الذرية (Database Transactions) مع فهارس مركبة في MySQL، واستخدام Repository Pattern و Redis لتسريع لوحة الإحصائيات.',
                    'en' => 'Implemented atomic DB transactions with row-level locking, composite MySQL indexing, Repository Pattern, and Redis caching for KPI aggregation.',
                ],
                'results' => [
                    'ar' => 'تحسين سرعة إصدار التقارير المالية بنسبة 70% والقضاء التام على أخطاء المطابقة المخزنية.',
                    'en' => 'Accelerated financial report generation by 70% and eliminated cross-branch inventory discrepancies.',
                ],
                'client_name' => [
                    'ar' => 'مجموعة شركات تجارية ولوجستية',
                    'en' => 'Enterprise Trading & Logistics Group',
                ],
                'role_title' => [
                    'ar' => 'مهندس برمجيات رئيسي (Full-Stack Laravel & React)',
                    'en' => 'Lead Full-Stack Software Engineer',
                ],
                'project_type' => ProjectTypeEnum::FullStack,
                'status' => ProjectStatusEnum::Published,
                'live_url' => 'https://erp-demo.abdelrahman-dev.com',
                'repo_url' => 'https://github.com/abdelrahman-abuaishah',
                'completed_at' => '2026-06-15',
                'duration' => ['ar' => '4 أشهر', 'en' => '4 Months'],
                'metrics' => [
                    ['label_en' => 'Report Speedup', 'label_ar' => 'تسريع التقارير', 'value' => '70%'],
                    ['label_en' => 'API Response', 'label_ar' => 'زمن الاستجابة', 'value' => '< 90ms'],
                ],
                'is_featured' => true,
                'sort_order' => 1,
                'tech_slugs' => ['php-8', 'laravel', 'react-js', 'mysql', 'redis-caching', 'clean-architecture-solid'],
            ],
            'high-throughput-ecommerce-api' => [
                'category_id' => $categories['restful-apis-backend']->id,
                'title' => [
                    'ar' => 'محرك التجارة الإلكترونية وبوابات الدفع (E-Commerce REST API Engine)',
                    'en' => 'High-Throughput E-Commerce & Payment Gateway API Engine',
                ],
                'subtitle' => [
                    'ar' => 'واجهة برمجية RESTful API عالية الأداء لتطبيقات الويب والموبايل',
                    'en' => 'Scalable RESTful API Powering Web & Mobile Storefronts',
                ],
                'short_description' => [
                    'ar' => 'نظام باك إند متكامل لإدارة الكتالوج، سلة المشتريات، الكوبونات، والربط مع بوابات الدفع الإلكتروني.',
                    'en' => 'Modular backend API managing multi-lingual product catalogs, cart checkout pipelines, and webhook-verified payment gateways.',
                ],
                'description' => [
                    'ar' => 'بناء API معيارية تدعم تعدد اللغات والعملات مع نظام إشعارات وطوابير مهام (Queues) لمعالجة الطلبات.',
                    'en' => 'Built a versioned `/api/v1` architecture supporting multi-locale catalogs, asynchronous order processing queues, and automated PHPUnit test coverage.',
                ],
                'challenge' => [
                    'ar' => 'معالجة آلاف الطلبات المتزامنة أثناء العروض الموسمية مع ضمان أمان عمليات الدفع.',
                    'en' => 'Handling flash-sale traffic spikes while guaranteeing idempotent payment webhook processing.',
                ],
                'solution' => [
                    'ar' => 'اعتماد DTOs و Services معزولة لكل خطوة دفع، وتفعيل Rate Limiting و Eager Loading لمنع مشكلة N+1.',
                    'en' => 'Designed immutable DTOs, isolated Payment Services, strict rate limiting, and Eloquent eager-loading scopes.',
                ],
                'results' => [
                    'ar' => 'معالجة الطلبات بزمن استجابة أقل من 75 ملي ثانية واستقرار تام بنسبة 99.9%.',
                    'en' => 'Maintained sub-75ms average API response times and 99.9% checkout reliability.',
                ],
                'client_name' => [
                    'ar' => 'منصة تجارة إلكترونية إقليمية',
                    'en' => 'Regional E-Commerce Platform',
                ],
                'role_title' => [
                    'ar' => 'مهندس باك إند (Senior PHP Laravel Engineer)',
                    'en' => 'Senior Backend Engineer (PHP Laravel)',
                ],
                'project_type' => ProjectTypeEnum::ApiBackend,
                'status' => ProjectStatusEnum::Published,
                'live_url' => 'https://api-commerce.abdelrahman-dev.com',
                'repo_url' => 'https://github.com/abdelrahman-abuaishah',
                'completed_at' => '2026-02-20',
                'duration' => ['ar' => '3 أشهر', 'en' => '3 Months'],
                'metrics' => [
                    ['label_en' => 'Avg Latency', 'label_ar' => 'متوسط الاستجابة', 'value' => '75ms'],
                    ['label_en' => 'Test Coverage', 'label_ar' => 'تغطية الاختبارات', 'value' => '94%'],
                ],
                'is_featured' => true,
                'sort_order' => 2,
                'tech_slugs' => ['php-8', 'laravel', 'restful-apis', 'mysql', 'phpunit-testing', 'clean-architecture-solid'],
            ],
            'interactive-project-analytics-spa' => [
                'category_id' => $categories['react-frontend-spas']->id,
                'title' => [
                    'ar' => 'لوحة تحليلات وإدارة المشاريع التفاعلية (React.js & Laravel SPA)',
                    'en' => 'Interactive Project Management & Analytics SPA',
                ],
                'subtitle' => [
                    'ar' => 'تطبيق أحادي الصفحة بـ React.js مع باك إند Laravel',
                    'en' => 'Modern React.js Frontend Connected to a Laravel 10 API',
                ],
                'short_description' => [
                    'ar' => 'منصة تفاعلية لإدارة فرق العمل والمهام ومؤشرات الأداء بواجهة React.js سريعة تدعم العربية والإنجليزية.',
                    'en' => 'Bilingual project tracking workspace featuring drag-and-drop boards, real-time KPI charts, and instant filtering.',
                ],
                'description' => [
                    'ar' => 'تجربة مستخدم سلسة بدون إعادة تحميل الصفحة (SPA) مع نظام صلاحيات متكامل وتصدير التقارير.',
                    'en' => 'Delivered a responsive React.js SPA consuming standardized Laravel JSON Resources with full RTL/LTR support.',
                ],
                'challenge' => [
                    'ar' => 'تقديم واجهة غنية بالبيانات والرسوم البيانية تعمل بسلاسة تامة على الهواتف والشاشات المكتبية باللغتين.',
                    'en' => 'Rendering complex Kanban boards and live metrics smoothly across mobile and desktop viewports in both RTL and LTR.',
                ],
                'solution' => [
                    'ar' => 'بناء مكونات React معيارية مع تحسين حالة التطبيق (State Management) وربطها بـ Laravel API Resources.',
                    'en' => 'Created modular React components with optimized state hooks and paginated Laravel API endpoints.',
                ],
                'results' => [
                    'ar' => 'زيادة إنتاجية فرق العمل بنسبة 45% وتحسين تجربة الاستخدام على الهواتف.',
                    'en' => 'Boosted team task completion velocity by 45% with a 98/100 Lighthouse UI performance score.',
                ],
                'client_name' => [
                    'ar' => 'شركة تقنية ناشئة (SaaS Startup)',
                    'en' => 'Tech SaaS Startup',
                ],
                'role_title' => [
                    'ar' => 'مطور Full-Stack (Laravel & React.js)',
                    'en' => 'Full-Stack Developer (Laravel & React.js)',
                ],
                'project_type' => ProjectTypeEnum::Saas,
                'status' => ProjectStatusEnum::Published,
                'live_url' => 'https://analytics-spa.abdelrahman-dev.com',
                'repo_url' => 'https://github.com/abdelrahman-abuaishah',
                'completed_at' => '2025-10-10',
                'duration' => ['ar' => '3 أشهر', 'en' => '3 Months'],
                'metrics' => [
                    ['label_en' => 'Lighthouse UI', 'label_ar' => 'أداء الواجهة', 'value' => '98/100'],
                    ['label_en' => 'Productivity', 'label_ar' => 'زيادة الإنتاجية', 'value' => '+45%'],
                ],
                'is_featured' => true,
                'sort_order' => 3,
                'tech_slugs' => ['react-js', 'javascript-es6', 'html5-css3-bootstrap', 'laravel', 'restful-apis'],
            ],
        ];

        $result = [];
        foreach ($projectsData as $slug => $data) {
            $techSlugs = $data['tech_slugs'];
            unset($data['tech_slugs']);

            $project = Project::query()->updateOrCreate(
                ['slug' => $slug],
                $data + ['is_active' => true]
            );

            $syncData = [];
            foreach ($techSlugs as $index => $techSlug) {
                if (isset($technologies[$techSlug])) {
                    $syncData[$technologies[$techSlug]->id] = [
                        'role_in_project' => 'Core Stack',
                        'sort_order' => $index + 1,
                    ];
                }
            }
            $project->technologies()->sync($syncData);

            $result[$slug] = $project;
        }

        return $result;
    }

    /**
     * Seed professional work experience timeline.
     *
     * @param  array<string, Technology>  $technologies
     */
    private function seedExperiences(array $technologies): void
    {
        $experiences = [
            [
                'sort_order' => 1,
                'company_name' => [
                    'ar' => 'حلول البرمجيات المتقدمة والأنظمة السحابية',
                    'en' => 'Enterprise Software & Cloud Solutions',
                ],
                'role_title' => [
                    'ar' => 'مهندس برمجيات متكامل (Senior Full-Stack Engineer — PHP Laravel & React.js)',
                    'en' => 'Full-Stack Software Engineer (PHP Laravel & React.js)',
                ],
                'employment_type' => EmploymentTypeEnum::FullTime,
                'location' => [
                    'ar' => 'القاهرة، مصر (دوام كامل / عن بُعد)',
                    'en' => 'Cairo, Egypt (Hybrid / Remote)',
                ],
                'company_url' => 'https://abdelrahman-dev.com',
                'start_date' => '2024-01-01',
                'end_date' => null,
                'is_current' => true,
                'summary' => [
                    'ar' => 'قيادة تصميم وتطوير أنظمة الباك إند بـ PHP 8.3 و Laravel 10 وبناء واجهات المستخدم التفاعلية بـ React.js مع تطبيق معايير SOLID و Clean Architecture.',
                    'en' => 'Leading the architecture and development of scalable PHP 8.3 & Laravel 10 backends and interactive React.js frontends following SOLID principles.',
                ],
                'achievements' => [
                    'ar' => 'تطوير وتسليم أكثر من 15 نظاماً مؤسسياً وواجهة RESTful API مع تحسين أداء قواعد البيانات وأتمتة الاختبارات.',
                    'en' => 'Architected and delivered 15+ production web platforms and RESTful APIs with comprehensive automated test suites.',
                ],
                'tech_slugs' => ['php-8', 'laravel', 'react-js', 'javascript-es6', 'mysql', 'clean-architecture-solid', 'phpunit-testing'],
            ],
            [
                'sort_order' => 2,
                'company_name' => [
                    'ar' => 'استوديو تطوير تطبيقات الويب والأنظمة الرقمية',
                    'en' => 'Digital Web Systems & Development Studio',
                ],
                'role_title' => [
                    'ar' => 'مطور برمجيات ويب (Backend Laravel & Frontend Developer)',
                    'en' => 'Full-Stack Web Developer (PHP Laravel & JavaScript)',
                ],
                'employment_type' => EmploymentTypeEnum::FullTime,
                'location' => [
                    'ar' => 'مصر',
                    'en' => 'Egypt',
                ],
                'company_url' => null,
                'start_date' => '2022-03-01',
                'end_date' => '2023-12-31',
                'is_current' => false,
                'summary' => [
                    'ar' => 'تطوير مواقع الشركات، لوحات التحكم الإدارية المخصصة، وربط تطبيقات الموبايل عبر RESTful APIs باستخدام Laravel و JavaScript و Bootstrap.',
                    'en' => 'Developed custom CMS dashboards, e-commerce platforms, and mobile backend APIs using PHP Laravel, MySQL, JavaScript, and Bootstrap 5.',
                ],
                'achievements' => [
                    'ar' => 'بناء أنظمة متعددة اللغات (عربي/إنجليزي) وتحسين سرعة تحميل الصفحات والسيو التقني.',
                    'en' => 'Delivered bilingual RTL/LTR web applications and optimized SQL queries and technical SEO performance.',
                ],
                'tech_slugs' => ['php-8', 'laravel', 'javascript-es6', 'html5-css3-bootstrap', 'mysql', 'restful-apis'],
            ],
        ];

        foreach ($experiences as $item) {
            $techSlugs = $item['tech_slugs'];
            unset($item['tech_slugs']);

            $experience = Experience::query()->updateOrCreate(
                ['sort_order' => $item['sort_order']],
                $item + ['is_active' => true]
            );

            $techIds = [];
            foreach ($techSlugs as $slug) {
                if (isset($technologies[$slug])) {
                    $techIds[] = $technologies[$slug]->id;
                }
            }
            $experience->technologies()->sync($techIds);
        }
    }

    /**
     * Seed academic degrees and professional certifications.
     */
    private function seedCredentials(): void
    {
        $credentials = [
            [
                'sort_order' => 1,
                'type' => CredentialTypeEnum::AcademicDegree,
                'issued_at' => '2022-07-01',
                'credential_id' => 'BSC-SE-2022',
                'title' => [
                    'ar' => 'درجة البكالوريوس في هندسة البرمجيات وعلوم الحاسب',
                    'en' => 'Bachelor of Science in Computer Science & Software Engineering',
                ],
                'organization' => [
                    'ar' => 'كلية الهندسة / علوم الحاسب',
                    'en' => 'Faculty of Engineering & Computer Science',
                ],
                'description' => [
                    'ar' => 'دراسة متعمقة لهندسة البرمجيات، الخوارزميات، هياكل البيانات، قواعد البيانات العلائقية، وشبكات الحاسب.',
                    'en' => 'Core focus on Software Engineering, Object-Oriented Programming, Database Systems, and Web Architecture.',
                ],
            ],
            [
                'sort_order' => 2,
                'type' => CredentialTypeEnum::ProfessionalCertificate,
                'issued_at' => '2024-05-15',
                'credential_id' => 'LARAVEL-ARCH-2024',
                'title' => [
                    'ar' => 'شهادة احتراف معمارية Laravel النظيفة ومبادئ SOLID',
                    'en' => 'Advanced Laravel Clean Architecture, SOLID & Automated Testing',
                ],
                'organization' => [
                    'ar' => 'منصة التطوير الاحترافي لهندسة البرمجيات',
                    'en' => 'Professional Software Architecture Academy',
                ],
                'description' => [
                    'ar' => 'تطبيق عملي لأنماط التصميم (Repository, Service, DTOs, Observers, Policies) مع اختبارات PHPUnit.',
                    'en' => 'Mastery of Repository Pattern, Service Layer, DTOs, Policies, and Feature Testing in PHP 8.3 & Laravel.',
                ],
            ],
            [
                'sort_order' => 3,
                'type' => CredentialTypeEnum::Course,
                'issued_at' => '2024-09-10',
                'credential_id' => 'REACT-FS-2024',
                'title' => [
                    'ar' => 'تخصص تطوير الواجهات الأمامية الحديثة باستخدام React.js و ES6+',
                    'en' => 'Modern React.js & Full-Stack Frontend Engineering',
                ],
                'organization' => [
                    'ar' => 'أكاديمية تطوير الويب المتقدم',
                    'en' => 'Modern Web Engineering Institute',
                ],
                'description' => [
                    'ar' => 'بناء تطبيقات React.js أحادية الصفحة، إدارة الحالة، والربط الآمن مع واجهات Laravel البرمجية.',
                    'en' => 'Component architecture, React Hooks, performance optimization, and RESTful API integration.',
                ],
            ],
        ];

        foreach ($credentials as $item) {
            Credential::query()->updateOrCreate(
                ['sort_order' => $item['sort_order']],
                $item + ['is_active' => true]
            );
        }
    }

    /**
     * Seed realistic client testimonials.
     *
     * @param  array<string, Project>  $projects
     */
    private function seedTestimonials(array $projects): void
    {
        $testimonials = [
            [
                'sort_order' => 1,
                'project_id' => $projects['enterprise-erp-inventory-platform']->id ?? null,
                'rating' => 5,
                'name' => [
                    'ar' => 'م. خالد المنصور',
                    'en' => 'Eng. Khaled Al-Mansour',
                ],
                'name_job' => [
                    'ar' => 'المدير التقني (CTO)',
                    'en' => 'Chief Technology Officer (CTO)',
                ],
                'company_name' => [
                    'ar' => 'شركة النخبة للحلول الرقمية',
                    'en' => 'Elite Digital Solutions',
                ],
                'description' => [
                    'ar' => 'المهندس عبدالرحمن أبو عيشة من أفضل مهندسي البرمجيات الذين تعاملنا معهم؛ كود Laravel و React منظم للغاية ومكتوب بمعايير SOLID واضحة سهّلت على فريقنا التوسع في المشروع.',
                    'en' => 'Eng. Abdelrahman Abu Aishah is an exceptional Full-Stack Engineer. His Laravel and React codebase follows strict SOLID and Repository patterns, making our platform effortless to scale.',
                ],
            ],
            [
                'sort_order' => 2,
                'project_id' => $projects['high-throughput-ecommerce-api']->id ?? null,
                'rating' => 5,
                'name' => [
                    'ar' => 'أ. طارق عبد العزيز',
                    'en' => 'Tarek Abdelaziz',
                ],
                'name_job' => [
                    'ar' => 'مدير المنتجات الرقمية (Product Manager)',
                    'en' => 'Senior Product Manager',
                ],
                'company_name' => [
                    'ar' => 'منصة فاست كومرس',
                    'en' => 'FastCommerce Platform',
                ],
                'description' => [
                    'ar' => 'التزام تام بالمواعيد، فهم عميق لمعمارية قواعد البيانات والـ APIs، واهتمام رائع بأدق التفاصيل في لوحة التحكم وتجربة المستخدم.',
                    'en' => 'Outstanding attention to detail in both database optimization and UI responsiveness. Delivered our REST API and admin portal ahead of schedule.',
                ],
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::query()->updateOrCreate(
                ['sort_order' => $item['sort_order']],
                $item + ['is_featured' => true, 'is_active' => true]
            );
        }
    }

    /**
     * Seed bilingual FAQs.
     */
    private function seedFaqs(): void
    {
        $faqs = [
            [
                'sort_order' => 1,
                'category' => 'architecture',
                'question' => [
                    'ar' => 'ما هي التقنيات الأساسية التي يعتمد عليها م. عبدالرحمن أبو عيشة؟',
                    'en' => 'What is Eng. Abdelrahman Abu Aishah’s core technology stack?',
                ],
                'answer' => [
                    'ar' => 'أتخصص في تطوير الباك إند باستخدام PHP 8.3 و Laravel 10 مع قواعد بيانات MySQL و Redis، وتطوير الواجهات الأمامية باستخدام HTML5, CSS3, Bootstrap 5, JavaScript ES6+ ومكتبة React.js.',
                    'en' => 'I specialize in backend engineering with PHP 8.3, Laravel 10, MySQL, and Redis, paired with modern frontend development using JavaScript (ES6+), React.js, HTML5, CSS3, and Bootstrap 5.',
                ],
            ],
            [
                'sort_order' => 2,
                'category' => 'process',
                'question' => [
                    'ar' => 'كيف تضمن جودة الكود وسهولة صيانته مستقبلاً؟',
                    'en' => 'How do you ensure code quality, scalability, and maintainability?',
                ],
                'answer' => [
                    'ar' => 'أطبق مبادئ SOLID الخمسة، ونمط المستودعات والخدمات (Repository & Service Layer)، مع strict_types في PHP 8.3، وتنسيق PSR-12 عبر Laravel Pint، واختبارات آلية عبر PHPUnit.',
                    'en' => 'Every project adheres to SOLID principles, Repository and Service layers, PHP 8.3 strict typing, PSR-12 formatting via Laravel Pint, English PHPDoc comments, and automated PHPUnit feature tests.',
                ],
            ],
        ];

        foreach ($faqs as $item) {
            Faq::query()->updateOrCreate(
                ['sort_order' => $item['sort_order']],
                $item + ['is_active' => true]
            );
        }
    }

    /**
     * Seed bilingual technical articles.
     *
     * @param  array<string, Category>  $categories
     */
    private function seedBlogs(array $categories): void
    {
        $articles = [
            'clean-architecture-solid-in-laravel-10' => [
                'category_id' => $categories['restful-apis-backend']->id,
                'name' => [
                    'ar' => 'تطبيق Clean Architecture ومبادئ SOLID في مشاريع Laravel 10',
                    'en' => 'Implementing Clean Architecture & SOLID Principles in Laravel 10',
                ],
                'short_description' => [
                    'ar' => 'دليل عملي لفصل منطق الأعمال باستخدام Repository Pattern و Service Layer و PHP 8.3 Enums.',
                    'en' => 'A practical guide to decoupling business logic using Repositories, Services, DTOs, and PHP 8.3 Backed Enums.',
                ],
                'description' => [
                    'ar' => 'يستعرض هذا المقال كيفية بناء أنظمة Laravel قابلة للتوسع والاختبار عبر فصل المسؤوليات (SRP) والاعتماد على العقود (Interfaces) بدلاً من الكلاسات المباشرة.',
                    'en' => 'In this article, we explore how to structure enterprise Laravel applications using thin controllers, service layers, repository contracts, and automated PHPUnit tests.',
                ],
                'reading_time_minutes' => 7,
                'status' => BlogStatusEnum::Published,
                'is_featured' => true,
                'published_at' => now()->subDays(10),
                'sort_order' => 1,
            ],
            'building-bilingual-apps-with-laravel-and-react' => [
                'category_id' => $categories['react-frontend-spas']->id,
                'name' => [
                    'ar' => 'أفضل الممارسات في ربط React.js مع واجهات Laravel RESTful APIs',
                    'en' => 'Best Practices for Integrating React.js with Laravel RESTful APIs',
                ],
                'short_description' => [
                    'ar' => 'كيفية تصميم استجابات JSON قياسية عبر API Resources وإدارة حالة الواجهة الأمامية بكفاءة.',
                    'en' => 'Designing standardized Eloquent API Resources and handling bilingual RTL/LTR state in React.js.',
                ],
                'description' => [
                    'ar' => 'شرح عملي لتوحيد استجابات الـ API، التعامل مع اللغتين العربية والإنجليزية، وتحسين سرعة تحميل البيانات في تطبيقات Full-Stack.',
                    'en' => 'A deep dive into building predictable JSON API contracts in Laravel and consuming them cleanly in modern React.js applications.',
                ],
                'reading_time_minutes' => 6,
                'status' => BlogStatusEnum::Published,
                'is_featured' => true,
                'published_at' => now()->subDays(4),
                'sort_order' => 2,
            ],
        ];

        foreach ($articles as $slug => $data) {
            Blog::query()->updateOrCreate(
                ['slug' => $slug],
                $data + ['is_active' => true]
            );
        }
    }
}
