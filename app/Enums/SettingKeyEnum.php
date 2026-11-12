<?php

/**
 * SettingKeyEnum
 *
 * Single source of truth for all dynamic portfolio configuration keys, defining
 * each key's SettingGroupEnum, SettingTypeEnum, translatability, and default value.
 */

declare(strict_types=1);

namespace App\Enums;

enum SettingKeyEnum: string
{
    // 1. General Tab
    case SiteName = 'site_name';
    case OwnerName = 'owner_name';
    case JobTitle = 'job_title';
    case YearsOfExperience = 'years_of_experience';
    case AvailableForHire = 'available_for_hire';
    case Logo = 'logo';
    case Favicon = 'favicon';

    // 2. Hero & CV Tab
    case HeroGreeting = 'hero_greeting';
    case HeroHeadline = 'hero_headline';
    case HeroSubheadline = 'hero_subheadline';
    case HeroPrimaryCtaText = 'hero_primary_cta_text';
    case HeroSecondaryCtaText = 'hero_secondary_cta_text';
    case TerminalStackCommand = 'terminal_stack_command';
    case ProfileImage = 'profile_image';
    case CvFileAr = 'cv_file_ar';
    case CvFileEn = 'cv_file_en';

    // 3. About Tab
    case AboutTitle = 'about_title';
    case AboutSubtitle = 'about_subtitle';
    case AboutSummary = 'about_summary';
    case AboutPhilosophy = 'about_philosophy';
    case AboutImage = 'about_image';
    case ResumeUrl = 'resume_url';

    // 4. Contact & Social Tab
    case ContactEmail = 'contact_email';
    case ContactPhone = 'contact_phone';
    case ContactWhatsapp = 'contact_whatsapp';
    case ContactLocation = 'contact_location';
    case WorkingHours = 'working_hours';
    case GithubUrl = 'github_url';
    case LinkedinUrl = 'linkedin_url';
    case XUrl = 'x_url';
    case YoutubeUrl = 'youtube_url';

    // 5. SEO Tab
    case SeoMetaTitle = 'seo_meta_title';
    case SeoMetaDescription = 'seo_meta_description';
    case SeoMetaKeywords = 'seo_meta_keywords';
    case SeoOgImage = 'seo_og_image';

    // 6. Sections Visibility Tab
    case ShowHeroSection = 'show_hero_section';
    case ShowStatsSection = 'show_stats_section';
    case ShowAboutSection = 'show_about_section';
    case ShowServicesSection = 'show_services_section';
    case ShowProjectsSection = 'show_projects_section';
    case ShowTechnologiesSection = 'show_technologies_section';
    case ShowExperiencesSection = 'show_experiences_section';
    case ShowCredentialsSection = 'show_credentials_section';
    case ShowTestimonialsSection = 'show_testimonials_section';
    case ShowBlogsSection = 'show_blogs_section';
    case ShowFaqsSection = 'show_faqs_section';
    case ShowCtaSection = 'show_cta_section';
    case ShowContactSection = 'show_contact_section';

    // 7. CTA Tab
    case CtaBadge = 'cta_badge';
    case CtaTitle = 'cta_title';
    case CtaDescription = 'cta_description';
    case CtaButtonText = 'cta_button_text';
    case CtaButtonUrl = 'cta_button_url';

    /**
     * Get the setting group (tab) that owns this key.
     */
    public function group(): SettingGroupEnum
    {
        return match ($this) {
            self::SiteName,
            self::OwnerName,
            self::JobTitle,
            self::YearsOfExperience,
            self::AvailableForHire,
            self::Logo,
            self::Favicon => SettingGroupEnum::General,

            self::HeroGreeting,
            self::HeroHeadline,
            self::HeroSubheadline,
            self::HeroPrimaryCtaText,
            self::HeroSecondaryCtaText,
            self::TerminalStackCommand,
            self::ProfileImage,
            self::CvFileAr,
            self::CvFileEn => SettingGroupEnum::Hero,

            self::AboutTitle,
            self::AboutSubtitle,
            self::AboutSummary,
            self::AboutPhilosophy,
            self::AboutImage,
            self::ResumeUrl => SettingGroupEnum::About,

            self::ContactEmail,
            self::ContactPhone,
            self::ContactWhatsapp,
            self::ContactLocation,
            self::WorkingHours,
            self::GithubUrl,
            self::LinkedinUrl,
            self::XUrl,
            self::YoutubeUrl => SettingGroupEnum::Contact,

            self::SeoMetaTitle,
            self::SeoMetaDescription,
            self::SeoMetaKeywords,
            self::SeoOgImage => SettingGroupEnum::Seo,

            self::ShowHeroSection,
            self::ShowStatsSection,
            self::ShowAboutSection,
            self::ShowServicesSection,
            self::ShowProjectsSection,
            self::ShowTechnologiesSection,
            self::ShowExperiencesSection,
            self::ShowCredentialsSection,
            self::ShowTestimonialsSection,
            self::ShowBlogsSection,
            self::ShowFaqsSection,
            self::ShowCtaSection,
            self::ShowContactSection => SettingGroupEnum::SectionsVisibility,

            self::CtaBadge,
            self::CtaTitle,
            self::CtaDescription,
            self::CtaButtonText,
            self::CtaButtonUrl => SettingGroupEnum::Cta,
        };
    }

    /**
     * Get the input/storage data type for this setting key.
     */
    public function type(): SettingTypeEnum
    {
        return match ($this) {
            self::Logo,
            self::Favicon,
            self::ProfileImage,
            self::AboutImage,
            self::SeoOgImage => SettingTypeEnum::Image,

            self::CvFileAr,
            self::CvFileEn => SettingTypeEnum::File,

            self::ContactEmail => SettingTypeEnum::Email,

            self::ResumeUrl,
            self::GithubUrl,
            self::LinkedinUrl,
            self::XUrl,
            self::YoutubeUrl,
            self::CtaButtonUrl => SettingTypeEnum::Url,

            self::AvailableForHire,
            self::ShowHeroSection,
            self::ShowStatsSection,
            self::ShowAboutSection,
            self::ShowServicesSection,
            self::ShowProjectsSection,
            self::ShowTechnologiesSection,
            self::ShowExperiencesSection,
            self::ShowCredentialsSection,
            self::ShowTestimonialsSection,
            self::ShowBlogsSection,
            self::ShowFaqsSection,
            self::ShowCtaSection,
            self::ShowContactSection => SettingTypeEnum::Boolean,

            self::TerminalStackCommand => SettingTypeEnum::Json,

            self::HeroSubheadline,
            self::AboutSummary,
            self::AboutPhilosophy,
            self::SeoMetaDescription,
            self::SeoMetaKeywords,
            self::CtaDescription => SettingTypeEnum::Textarea,

            default => SettingTypeEnum::Text,
        };
    }

    /**
     * Determine whether this setting stores locale-specific (ar/en) values.
     */
    public function isTranslatable(): bool
    {
        return match ($this) {
            self::SiteName,
            self::OwnerName,
            self::JobTitle,
            self::HeroGreeting,
            self::HeroHeadline,
            self::HeroSubheadline,
            self::HeroPrimaryCtaText,
            self::HeroSecondaryCtaText,
            self::AboutTitle,
            self::AboutSubtitle,
            self::AboutSummary,
            self::AboutPhilosophy,
            self::ContactLocation,
            self::WorkingHours,
            self::SeoMetaTitle,
            self::SeoMetaDescription,
            self::SeoMetaKeywords,
            self::CtaBadge,
            self::CtaTitle,
            self::CtaDescription,
            self::CtaButtonText => true,
            default => false,
        };
    }

    /**
     * Determine whether this setting represents an uploaded image or document file.
     */
    public function isFileOrImage(): bool
    {
        return in_array($this->type(), [SettingTypeEnum::Image, SettingTypeEnum::File], true);
    }

    /**
     * Get the localized human-readable label for this setting key.
     */
    public function label(): string
    {
        $translated = __("enums.setting_key.{$this->value}");
        if (is_string($translated) && $translated !== "enums.setting_key.{$this->value}") {
            return $translated;
        }

        return ucwords(str_replace('_', ' ', $this->value));
    }

    /**
     * Get the default value for this setting key.
     */
    public function default(): mixed
    {
        return match ($this) {
            // General
            self::SiteName => [
                'ar' => 'م. عبدالرحمن أبو عيشة | مهندس برمجيات Full-Stack',
                'en' => 'Eng. Abdelrahman Abu Aishah | Full-Stack Software Engineer',
            ],
            self::OwnerName => [
                'ar' => 'مهندس / عبدالرحمن أبو عيشة',
                'en' => 'Eng. Abdelrahman Abu Aishah',
            ],
            self::JobTitle => [
                'ar' => 'مهندس برمجيات متكامل (PHP Laravel & React.js)',
                'en' => 'Full-Stack Software Engineer (PHP Laravel & React.js)',
            ],
            self::YearsOfExperience => ['value' => '4+'],
            self::AvailableForHire => ['value' => true],
            self::Logo => ['value' => '/front/assets/img/logo/Silver-blue.png'],
            self::Favicon => ['value' => '/default-icon.png'],

            // Hero & CV
            self::HeroGreeting => [
                'ar' => 'مرحباً، أنا المهندس عبدالرحمن أبو عيشة',
                'en' => 'Hello, I am Eng. Abdelrahman Abu Aishah',
            ],
            self::HeroHeadline => [
                'ar' => 'أبني أنظمة باك إند قوية بـ PHP Laravel وواجهات تفاعلية حديثة بـ React.js',
                'en' => 'Architecting Scalable PHP Laravel Backends & Modern React.js Frontends',
            ],
            self::HeroSubheadline => [
                'ar' => 'خبرة عملية تزيد عن 4 سنوات في هندسة البرمجيات، بناء الـ RESTful APIs، لوحات التحكم المتقدمة، وتطبيق مبادئ SOLID و Clean Architecture.',
                'en' => '4+ years of hands-on experience engineering clean, testable web systems, RESTful APIs, and responsive user interfaces following SOLID principles.',
            ],
            self::HeroPrimaryCtaText => [
                'ar' => 'استعرض مشاريعي ودراسات الحالة',
                'en' => 'Explore Case Studies',
            ],
            self::HeroSecondaryCtaText => [
                'ar' => 'تواصل معي لبدء مشروعك',
                'en' => 'Start a Project Inquiry',
            ],
            self::TerminalStackCommand => [
                'command' => 'php artisan engineer:profile --stack',
                'backend' => ['PHP 8.3', 'Laravel 10', 'RESTful APIs', 'Clean Architecture', 'SOLID'],
                'frontend' => ['React.js', 'JavaScript ES6+', 'HTML5/CSS3', 'Bootstrap 5'],
                'database' => ['MySQL', 'Redis', 'Query Optimization'],
            ],
            self::ProfileImage => ['value' => null],
            self::CvFileAr => ['value' => null],
            self::CvFileEn => ['value' => null],

            // About
            self::AboutTitle => [
                'ar' => 'نبذة عن المهندس عبدالرحمن أبو عيشة',
                'en' => 'About Eng. Abdelrahman Abu Aishah',
            ],
            self::AboutSubtitle => [
                'ar' => 'مهندس برمجيات متكامل بخبرة +4 سنوات في PHP Laravel و React.js',
                'en' => 'Full-Stack Software Engineer with 4+ Years in PHP Laravel & React.js',
            ],
            self::AboutSummary => [
                'ar' => 'مهندس برمجيات متكامل (Full-Stack Software Engineer) بخبرة تتجاوز 4 سنوات في تصميم وتطوير الأنظمة السحابية، تطبيقات الويب المؤسسية، وواجهات برمجة التطبيقات (RESTful APIs) باستخدام PHP 8.3 و Laravel، مع إتقان تام لبناء الواجهات الأمامية التفاعلية باستخدام JavaScript و React.js.',
                'en' => 'Full-Stack Software Engineer with 4+ years of professional experience designing and building enterprise web applications, scalable RESTful APIs, and dynamic single-page applications using PHP 8.3, Laravel, Modern JavaScript (ES6+), and React.js.',
            ],
            self::AboutPhilosophy => [
                'ar' => 'أؤمن بأن الكود النظيف القابل للاختبار والصيانة (Clean, Maintainable & Testable Code) هو الأساس لأي منتج رقمي ناجح؛ لذلك ألتزم بمبادئ SOLID، ونمط المستودعات والخدمات (Repository & Service Pattern)، مع توثيق شامل واختبارات آلية.',
                'en' => 'I believe that clean, maintainable, and well-tested architecture is the foundation of every successful digital product. Every system I deliver strictly adheres to SOLID principles, Repository & Service patterns, PSR-12 standards, and automated PHPUnit testing.',
            ],
            self::AboutImage => ['value' => null],
            self::ResumeUrl => ['value' => '/files/Eng-Abdelrahman-Abu-Aishah-CV.pdf'],

            // Contact & Social
            self::ContactEmail => ['value' => 'contact@abdelrahman-dev.com'],
            self::ContactPhone => ['value' => '+201000000000'],
            self::ContactWhatsapp => ['value' => '+201000000000'],
            self::ContactLocation => [
                'ar' => 'القاهرة، مصر (متاح للعمل عن بُعد وعقود الشركات)',
                'en' => 'Cairo, Egypt (Available for Remote & Enterprise Roles)',
            ],
            self::WorkingHours => [
                'ar' => 'الأحد - الخميس: 9:00 صباحاً - 6:00 مساءً',
                'en' => 'Sun - Thu: 9:00 AM - 6:00 PM (GMT+2)',
            ],
            self::GithubUrl => ['value' => 'https://github.com/abdelrahman-abuaishah'],
            self::LinkedinUrl => ['value' => 'https://linkedin.com/in/abdelrahman-abuaishah'],
            self::XUrl => ['value' => 'https://x.com/abdelrahman_dev'],
            self::YoutubeUrl => ['value' => ''],

            // SEO
            self::SeoMetaTitle => [
                'ar' => 'م. عبدالرحمن أبو عيشة | مهندس برمجيات PHP Laravel & React.js',
                'en' => 'Eng. Abdelrahman Abu Aishah | Full-Stack Software Engineer (PHP Laravel & React)',
            ],
            self::SeoMetaDescription => [
                'ar' => 'الموقع الرسمي ومعرض الأعمال للمهندس عبدالرحمن أبو عيشة — مهندس برمجيات Full-Stack متخصص في تطوير الأنظمة بـ PHP Laravel والواجهات الأمامية بـ React.js بخبرة +4 سنوات.',
                'en' => 'Official portfolio of Eng. Abdelrahman Abu Aishah — Full-Stack Software Engineer specializing in PHP 8.3, Laravel, RESTful APIs, and React.js with 4+ years of experience.',
            ],
            self::SeoMetaKeywords => [
                'ar' => 'عبدالرحمن أبو عيشة, مهندس برمجيات, مبرمج PHP, مبرمج Laravel, مطور React, مطور Full Stack, تصميم وتطوير مواقع, برمجة أنظمة ولوحات تحكم, RESTful APIs',
                'en' => 'Abdelrahman Abu Aishah, Software Engineer, PHP Developer, Laravel Developer, React.js Developer, Full Stack Developer, Clean Architecture, Portfolio',
            ],
            self::SeoOgImage => ['value' => null],

            // Sections Visibility (all enabled by default)
            self::ShowHeroSection,
            self::ShowStatsSection,
            self::ShowAboutSection,
            self::ShowServicesSection,
            self::ShowProjectsSection,
            self::ShowTechnologiesSection,
            self::ShowExperiencesSection,
            self::ShowCredentialsSection,
            self::ShowTestimonialsSection,
            self::ShowBlogsSection,
            self::ShowFaqsSection,
            self::ShowCtaSection,
            self::ShowContactSection => ['value' => true],

            // CTA
            self::CtaBadge => [
                'ar' => 'متاح للمشاريع الجديدة والفرص الهندسية',
                'en' => 'Available for New Projects & Engineering Roles',
            ],
            self::CtaTitle => [
                'ar' => 'هل تبحث عن مهندس برمجيات لبناء نظامك القادم بمعايير عالمية؟',
                'en' => 'Ready to Architect and Ship Your Next High-Performance Web System?',
            ],
            self::CtaDescription => [
                'ar' => 'تواصل معي الآن لمناقشة متطلبات مشروعك أو الانضمام لفريقك التقني كمطور Full-Stack (PHP Laravel & React.js).',
                'en' => 'Let us discuss your system architecture, API requirements, or full-stack development roadmap.',
            ],
            self::CtaButtonText => [
                'ar' => 'ابدأ محادثة تقنية الآن',
                'en' => 'Schedule a Technical Consultation',
            ],
            self::CtaButtonUrl => ['value' => '#contact'],
        };
    }

    /**
     * Get the default value resolved for a specific locale.
     */
    public function defaultForLocale(?string $locale = null): mixed
    {
        $default = $this->default();
        if (! is_array($default)) {
            return $default;
        }

        if (! $this->isTranslatable()) {
            return array_key_exists('value', $default) ? $default['value'] : $default;
        }

        $targetLocale = $locale ?? app()->getLocale();

        return $default[$targetLocale] ?? $default['en'] ?? $default['ar'] ?? null;
    }

    /**
     * Retrieve all SettingKeyEnum cases belonging to a given SettingGroupEnum.
     *
     * @return array<int, self>
     */
    public static function forGroup(SettingGroupEnum $group): array
    {
        return array_values(array_filter(
            self::cases(),
            static fn (self $case): bool => $case->group() === $group
        ));
    }

    /**
     * Get all enum backing values.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

