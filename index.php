<?php
session_start();

// Form handling
$form_message = '';
$form_message_type = ''; // 'success' or 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    // Sanitize and validate form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_message = 'Invalid email address';
        $form_message_type = 'error';
    } elseif (empty($name) || empty($message)) {
        $form_message = 'Please fill in all fields';
        $form_message_type = 'error';
    } else {
        // Email configuration
        $to = 'contact@imobx.md';
        $subject = 'New Contact Form Submission from IMOBX.MD';
        
        // Build email content
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Message:\n$message\n";
        $email_content .= "\n---\n";
        $email_content .= "Sent from: " . $_SERVER['REMOTE_ADDR'];
        $email_content .= " at " . date('Y-m-d H:i:s');
        
        // Email headers
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Send email
        if (mail($to, $subject, $email_content, $headers)) {
            $form_message = 'Thank you! Your message has been sent successfully.';
            $form_message_type = 'success';
        } else {
            $form_message = 'Sorry, there was an error sending your message. Please try again.';
            $form_message_type = 'error';
        }
    }
}

// Language detection and handling
$supported_languages = ['ru', 'ro', 'en'];
$default_language = 'ru';

// Get language from URL parameter or session or default
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_languages)) {
    $_SESSION['lang'] = $_GET['lang'];
    $current_lang = $_GET['lang'];
} elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $supported_languages)) {
    $current_lang = $_SESSION['lang'];
} else {
    $current_lang = $default_language;
}

// Translations array
$translations = [
    'ru' => [
        'title' => 'IMOBX - Разработка веб-сайтов для бизнеса',
        'description' => 'Профессиональная разработка веб-сайтов, управление и рекламные кампании для бизнеса в Молдове, Румынии и Украине',
        'keywords' => 'разработка веб-сайтов, создание сайтов, веб-дизайн, SEO, Google Ads, Молдова, Румыния, Украина, B2B',
        'hero_title' => 'Профессиональные веб-сайты для вашего бизнеса',
        'hero_subtitle' => 'Мы создаем веб-сайты, которые приводят клиентов. Разработка, управление и рекламные кампании для бизнеса.',
        'cta_button' => 'Получить консультацию',
        'services_title' => 'Наши услуги',
        'services_subtitle' => 'Комплексные решения для вашего онлайн-присутствия',
        'basic_package' => 'Базовый пакет',
        'basic_price' => '€500–800',
        'professional_package' => 'Профессиональный пакет',
        'professional_price' => '€800–1,500',
        'premium_package' => 'Премиум пакет',
        'premium_price' => '€1,500–3,000+',
        'website_dev' => 'Разработка веб-сайтов',
        'website_management' => 'Управление веб-сайтами',
        'ad_campaigns' => 'Рекламные кампании',
        'seo_optimization' => 'SEO оптимизация',
        'contact_title' => 'Свяжитесь с нами',
        'contact_subtitle' => 'Готовы обсудить ваш проект?',
        'phone' => 'Телефон',
        'email' => 'Email',
        'address' => 'Адрес',
        'address_value' => 'Кишинёв, Республика Молдова',
        'form_name' => 'Ваше имя',
        'form_email' => 'Email',
        'form_message' => 'Сообщение',
        'form_submit' => 'Отправить',
        'footer_rights' => 'Все права защищены.',
        'language_switch' => 'Язык',
        'basic_features' => [
            'Современный адаптивный дизайн',
            'Посадочная страница / бизнес-сайт',
            'О компании',
            'Услуги',
            'Цены',
            'Проекты / портфолио',
            'Отзывы клиентов',
            'Контактная форма',
            'Кнопки WhatsApp / Messenger',
            'Google Maps',
            'Мобильная оптимизация',
            'Базовое SEO',
            'Настройка домена',
            'SSL сертификат',
            'Google Analytics',
            'Google Search Console',
            'Базовая оптимизация скорости'
        ],
        'professional_features' => [
            'Все из базового пакета',
            'Более профессиональный дизайн',
            'Несколько разделов услуг',
            'Улучшенная структура SEO',
            'Локальное SEO',
            'Оптимизация Google Business Profile',
            'Целевая посадочная страница',
            'Формы лидогенерации',
            'Отслеживание звонков',
            'Отслеживание форм',
            'Настройка Google Analytics',
            'Настройка Search Console',
            'Карта сайта',
            'Мета-теги и описания',
            'Оптимизация изображений',
            'Базовая настройка Google Ads',
            '1-2 рекламные кампании',
            'Ежемесячный отчет о результатах'
        ],
        'premium_features' => [
            'Полнофункциональный веб-сайт',
            'Несколько посадочных страниц',
            'Продвинутое локальное SEO',
            'Настройка Google Ads',
            'Отслеживание конверсий',
            'Аналитическая панель',
            'Профессиональное копирайтинг',
            'Профессиональный выбор изображений',
            'Исследование конкурентов',
            'Стратегия лидогенерации',
            'Оптимизация Google Business Profile',
            'Постоянное SEO',
            'Управление Google Ads',
            'Ежемесячная оптимизация'
        ],
        'why_us_title' => 'Почему выбирают нас',
        'why_us_subtitle' => 'Мы создаем веб-сайты, которые работают на ваш бизнес',
        'why_us_1_title' => 'Опыт в B2B',
        'why_us_1_desc' => 'Специализируемся на веб-сайтах для бизнеса, где один клиент стоит дорого',
        'why_us_2_title' => 'Комплексный подход',
        'why_us_2_desc' => 'Разработка, SEO, реклама и аналитика в одном пакете',
        'why_us_3_title' => 'Ориентированный на результат',
        'why_us_3_desc' => 'Фокус на конверсиях и привлечении клиентов, а не только на дизайне',
        'why_us_4_title' => 'Локальное SEO',
        'why_us_4_desc' => 'Оптимизация для Молдовы, Румынии и Украины',
        'portfolio_title' => 'Наши проекты',
        'portfolio_subtitle' => 'Примеры работ для различных отраслей',
        'process_title' => 'Как мы работаем',
        'process_subtitle' => 'Прозрачный процесс от идеи до запуска',
        'process_1_title' => 'Консультация',
        'process_1_desc' => 'Обсуждаем ваши цели и требования',
        'process_2_title' => 'Разработка',
        'process_2_desc' => 'Создаем дизайн и функционал',
        'process_3_title' => 'Запуск',
        'process_3_desc' => 'Запускаем веб-сайт и настраиваем аналитику',
        'process_4_title' => 'Поддержка',
        'process_4_desc' => 'Обеспечиваем поддержку и оптимизацию'
    ],
    'ro' => [
        'title' => 'IMOBX - Dezvoltare site-uri web pentru afaceri',
        'description' => 'Dezvoltare profesională de site-uri web, management și campanii publicitare pentru afaceri în Moldova, România și Ucraina',
        'keywords' => 'dezvoltare site-uri web, creare site-uri, design web, SEO, Google Ads, Moldova, România, Ucraina, B2B',
        'hero_title' => 'Site-uri web profesionale pentru afacerea ta',
        'hero_subtitle' => 'Creăm site-uri web care aduc clienți. Dezvoltare, management și campanii publicitare pentru afaceri.',
        'cta_button' => 'Obțineți o consultație',
        'services_title' => 'Serviciile noastre',
        'services_subtitle' => 'Soluții complete pentru prezența dumneavoastră online',
        'basic_package' => 'Pachetul de bază',
        'basic_price' => '€500–800',
        'professional_package' => 'Pachet profesional',
        'professional_price' => '€800–1,500',
        'premium_package' => 'Pachet premium',
        'premium_price' => '€1,500–3,000+',
        'website_dev' => 'Dezvoltare site-uri web',
        'website_management' => 'Management site-uri web',
        'ad_campaigns' => 'Campanii publicitare',
        'seo_optimization' => 'Optimizare SEO',
        'contact_title' => 'Contactați-ne',
        'contact_subtitle' => 'Sunteți gata să discutați proiectul dumneavoastră?',
        'phone' => 'Telefon',
        'email' => 'Email',
        'address' => 'Adresă',
        'address_value' => 'Chișinău, Republica Moldova',
        'form_name' => 'Numele dumneavoastră',
        'form_email' => 'Email',
        'form_message' => 'Mesaj',
        'form_submit' => 'Trimiteți',
        'footer_rights' => 'Toate drepturile rezervate.',
        'language_switch' => 'Limbă',
        'basic_features' => [
            'Design responsive modern',
            'Pagină de aterizare / site de afaceri',
            'Despre companie',
            'Servicii',
            'Prețuri',
            'Proiecte / portofoliu',
            'Recenzii ale clienților',
            'Formular de contact',
            'Butoane WhatsApp / Messenger',
            'Google Maps',
            'Optimizare mobilă',
            'SEO de bază',
            'Configurare domeniu',
            'Certificat SSL',
            'Google Analytics',
            'Google Search Console',
            'Optimizare de bază a vitezei'
        ],
        'professional_features' => [
            'Tot din pachetul de bază',
            'Design personalizat mai profesionist',
            'Mai multe secțiuni de servicii',
            'Structură SEO îmbunătățită',
            'SEO local',
            'Optimizare Google Business Profile',
            'Pagină de aterizare orientată spre conversie',
            'Formulare de generare de lead-uri',
            'Urmărire apeluri telefonice',
            'Urmărire formulare',
            'Configurare Google Analytics',
            'Configurare Search Console',
            'Hartă site',
            'Meta titluri și descrieri',
            'Optimizare imagini',
            'Configurare de bază Google Ads',
            '1-2 campanii publicitare',
            'Raport lunar de performanță'
        ],
        'premium_features' => [
            'Site web complet',
            'Mai multe pagini de aterizare',
            'SEO local avansat',
            'Configurare Google Ads',
            'Urmărire conversii',
            'Panou de analiză',
            'Copywriting profesionist',
            'Selecție profesionistă de imagini',
            'Cercetare competitori',
            'Strategie de generare de lead-uri',
            'Optimizare Google Business Profile',
            'SEO continuu',
            'Management Google Ads',
            'Optimizare lunară'
        ],
        'why_us_title' => 'De ce ne aleg',
        'why_us_subtitle' => 'Creăm site-uri web care lucrează pentru afacerea dumneavoastră',
        'why_us_1_title' => 'Experiență B2B',
        'why_us_1_desc' => 'Specializați pe site-uri web pentru afaceri unde un client valorează mult',
        'why_us_2_title' => 'Abordare completă',
        'why_us_2_desc' => 'Dezvoltare, SEO, publicitate și analiză într-un singur pachet',
        'why_us_3_title' => 'Orientat spre rezultate',
        'why_us_3_desc' => 'Focus pe conversii și atragerea clienților, nu doar pe design',
        'why_us_4_title' => 'SEO local',
        'why_us_4_desc' => 'Optimizare pentru Moldova, România și Ucraina',
        'portfolio_title' => 'Proiectele noastre',
        'portfolio_subtitle' => 'Exemple de lucru pentru diverse industrii',
        'process_title' => 'Cum lucrăm',
        'process_subtitle' => 'Proces transparent de la idee la lansare',
        'process_1_title' => 'Consultație',
        'process_1_desc' => 'Discutăm obiectivele și cerințele dumneavoastră',
        'process_2_title' => 'Dezvoltare',
        'process_2_desc' => 'Creăm designul și funcționalitatea',
        'process_3_title' => 'Lansare',
        'process_3_desc' => 'Lansăm site-ul web și configurăm analiza',
        'process_4_title' => 'Suport',
        'process_4_desc' => 'Oferim suport și optimizare'
    ],
    'en' => [
        'title' => 'IMOBX - Web Development for Business',
        'description' => 'Professional web development, management and advertising campaigns for businesses in Moldova, Romania and Ukraine',
        'keywords' => 'web development, website creation, web design, SEO, Google Ads, Moldova, Romania, Ukraine, B2B',
        'hero_title' => 'Professional Websites for Your Business',
        'hero_subtitle' => 'We create websites that bring customers. Development, management and advertising campaigns for businesses.',
        'cta_button' => 'Get a Consultation',
        'services_title' => 'Our Services',
        'services_subtitle' => 'Comprehensive solutions for your online presence',
        'basic_package' => 'Basic Package',
        'basic_price' => '€500–800',
        'professional_package' => 'Professional Package',
        'professional_price' => '€800–1,500',
        'premium_package' => 'Premium Package',
        'premium_price' => '€1,500–3,000+',
        'website_dev' => 'Web Development',
        'website_management' => 'Website Management',
        'ad_campaigns' => 'Advertising Campaigns',
        'seo_optimization' => 'SEO Optimization',
        'contact_title' => 'Contact Us',
        'contact_subtitle' => 'Ready to discuss your project?',
        'phone' => 'Phone',
        'email' => 'Email',
        'address' => 'Address',
        'address_value' => 'Chisinau, Republic of Moldova',
        'form_name' => 'Your Name',
        'form_email' => 'Email',
        'form_message' => 'Message',
        'form_submit' => 'Send',
        'footer_rights' => 'All rights reserved.',
        'language_switch' => 'Language',
        'basic_features' => [
            'Modern responsive design',
            'Landing page / business website',
            'About company',
            'Services',
            'Prices',
            'Projects / portfolio',
            'Customer reviews',
            'Contact form',
            'WhatsApp / Messenger buttons',
            'Google Maps',
            'Mobile optimization',
            'Basic SEO',
            'Domain setup',
            'SSL certificate',
            'Google Analytics',
            'Google Search Console',
            'Basic speed optimization'
        ],
        'professional_features' => [
            'Everything from Basic Package',
            'More professional custom design',
            'Multiple service sections',
            'Better SEO structure',
            'Local SEO',
            'Google Business Profile optimization',
            'Conversion-focused landing page',
            'Lead generation forms',
            'Phone click tracking',
            'Form submission tracking',
            'Google Analytics setup',
            'Search Console setup',
            'Sitemap',
            'Meta titles and descriptions',
            'Image optimization',
            'Basic Google Ads setup',
            '1-2 advertising campaigns',
            'Monthly performance report'
        ],
        'premium_features' => [
            'Full website',
            'Multiple landing pages',
            'Advanced local SEO',
            'Google Ads setup',
            'Conversion tracking',
            'Analytics dashboard',
            'Professional copywriting',
            'Professional image selection',
            'Competitor research',
            'Lead generation strategy',
            'Google Business Profile optimization',
            'Ongoing SEO',
            'Google Ads management',
            'Monthly optimization'
        ],
        'why_us_title' => 'Why Choose Us',
        'why_us_subtitle' => 'We create websites that work for your business',
        'why_us_1_title' => 'B2B Experience',
        'why_us_1_desc' => 'Specialized in websites for businesses where one customer is worth a lot',
        'why_us_2_title' => 'Comprehensive Approach',
        'why_us_2_desc' => 'Development, SEO, advertising and analytics in one package',
        'why_us_3_title' => 'Results Oriented',
        'why_us_3_desc' => 'Focus on conversions and attracting customers, not just design',
        'why_us_4_title' => 'Local SEO',
        'why_us_4_desc' => 'Optimization for Moldova, Romania and Ukraine',
        'portfolio_title' => 'Our Projects',
        'portfolio_subtitle' => 'Work examples for various industries',
        'process_title' => 'How We Work',
        'process_subtitle' => 'Transparent process from idea to launch',
        'process_1_title' => 'Consultation',
        'process_1_desc' => 'We discuss your goals and requirements',
        'process_2_title' => 'Development',
        'process_2_desc' => 'We create design and functionality',
        'process_3_title' => 'Launch',
        'process_3_desc' => 'We launch the website and set up analytics',
        'process_4_title' => 'Support',
        'process_4_desc' => 'We provide support and optimization'
    ]
];

$t = $translations[$current_lang];
$contact_phone = '+37368690699';
$contact_email = 'contact@imobx.md';
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $t['title']; ?></title>
    <meta name="description" content="<?php echo $t['description']; ?>">
    <meta name="keywords" content="<?php echo $t['keywords']; ?>">
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="<?php echo $t['title']; ?>">
    <meta property="og:description" content="<?php echo $t['description']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?php echo $current_lang === 'ru' ? 'ru_RU' : ($current_lang === 'ro' ? 'ro_RO' : 'en_US'); ?>">
    
    <!-- Geo targeting for Moldova, Romania, Ukraine -->
    <meta name="geo.region" content="MD">
    <meta name="geo.region" content="RO">
    <meta name="geo.region" content="UA">
    <meta name="geo.placename" content="Moldova, Romania, Ukraine">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://imobx.md/<?php echo $current_lang === 'ru' ? '' : '?lang=' . $current_lang; ?>">
    
    <!-- Favicons / Icons -->
    <link rel="icon" href="logo.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="512x512" href="logo-512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="logo-512.png">
    <link rel="mask-icon" href="logo.svg" color="#1a365d">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="manifest.json">
    
    <!-- OpenSearch -->
    <link rel="search" type="application/opensearchdescription+xml" title="IMOBX" href="opensearch.xml">
    
    <!-- Microsoft Tile Configuration -->
    <meta name="msapplication-config" content="browserconfig.xml">
    <meta name="msapplication-TileColor" content="#1a365d">
    <meta name="msapplication-TileImage" content="logo-512.png">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#1a365d">
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "IMOBX",
        "description": "<?php echo $t['description']; ?>",
        "url": "https://imobx.md",
        "telephone": "+37368690699",
        "email": "contact@imobx.md",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Chisinau",
            "addressLocality": "Chisinau",
            "addressCountry": "MD"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "47.0117",
            "longitude": "28.9319"
        },
        "areaServed": [
            {
                "@type": "Country",
                "name": "Moldova"
            },
            {
                "@type": "Country", 
                "name": "Romania"
            },
            {
                "@type": "Country",
                "name": "Ukraine"
            }
        ],
        "priceRange": "€500-3000",
        "openingHours": "Mo-Fr 09:00-18:00",
        "availableLanguage": ["Russian", "Romanian", "English"],
        "serviceType": ["Web Development", "Website Management", "Advertising Campaigns", "SEO Optimization"]
    }
    </script>
    
    <style>
        /* CSS Variables */
        :root {
            --primary-color: #1a365d; /* Deep navy */
            --primary-light: #2c5282;
            --accent-color: #3182ce; /* Modern blue accent */
            --accent-hover: #2b6cb0;
            --text-dark: #1a202c;
            --text-medium: #4a5568;
            --text-light: #718096;
            --bg-white: #ffffff;
            --bg-light: #f7fafc;
            --bg-gray: #edf2f7;
            --border-color: #e2e8f0;
            --success-color: #48bb78;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }

        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--bg-white);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-md);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 28px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            letter-spacing: -1px;
        }

        .logo picture,
        .logo img {
            height: 40px;
            width: auto;
            display: block;
        }

        .logo:hover {
            color: var(--accent-color);
            opacity: 0.95;
        }

        .logo:hover img {
            opacity: 0.9;
        }

        footer .logo img {
            height: 36px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        nav a:hover {
            color: var(--accent-color);
        }

        .language-switcher {
            display: flex;
            gap: 10px;
        }

        .lang-btn {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 14px;
        }

        .lang-btn:hover,
        .lang-btn.active {
            background: var(--accent-color);
            border-color: var(--accent-color);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 15px 40px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .cta-button:hover {
            background-color: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background-color: var(--bg-light);
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 36px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .section-title p {
            font-size: 18px;
            color: var(--text-medium);
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .pricing-card {
            background: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-color);
        }

        .pricing-card.featured {
            border: 2px solid var(--accent-color);
            position: relative;
        }

        .pricing-card.featured::before {
            content: 'POPULAR';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent-color);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .pricing-card h3 {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .pricing-card .price {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 30px;
        }

        .pricing-card ul {
            list-style: none;
            margin-bottom: 30px;
        }

        .pricing-card li {
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-medium);
            font-size: 15px;
        }

        .pricing-card li:last-child {
            border-bottom: none;
        }

        .pricing-card li::before {
            content: '✓';
            color: var(--success-color);
            font-weight: bold;
            margin-right: 10px;
        }

        /* Why Us Section */
        .why-us {
            padding: 80px 0;
            background-color: var(--bg-white);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .feature-card {
            text-align: center;
            padding: 30px;
            background: var(--bg-light);
            border-radius: 8px;
            transition: var(--transition);
        }

        .feature-card:hover {
            background: var(--bg-gray);
        }

        .feature-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .feature-card p {
            color: var(--text-medium);
            font-size: 15px;
        }

        /* Process Section */
        .process {
            padding: 80px 0;
            background-color: var(--bg-light);
        }

        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .process-step {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            margin: 0 auto 20px;
        }

        .process-step h3 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .process-step p {
            color: var(--text-medium);
            font-size: 15px;
        }

        /* Contact Section */
        .contact {
            padding: 80px 0;
            background-color: var(--bg-white);
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-top: 50px;
        }

        .contact-info h3 {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .contact-item {
            margin-bottom: 20px;
        }

        .contact-item label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .contact-item a,
        .contact-item span {
            color: var(--text-medium);
            font-size: 16px;
            text-decoration: none;
        }

        .contact-item a:hover {
            color: var(--accent-color);
        }

        .contact-form {
            background: var(--bg-light);
            padding: 40px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
            font-family: inherit;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background-color: var(--accent-color);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
        }

        .submit-btn:hover {
            background-color: var(--accent-hover);
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent-color);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
            }

            nav ul {
                gap: 15px;
                font-size: 14px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .contact-content {
                grid-template-columns: 1fr;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .section-title h2 {
                font-size: 28px;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Button active state */
        .cta-button:active {
            transform: translateY(0);
        }

        /* Form messages */
        .form-message {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-message.success {
            background: var(--success-color);
            color: white;
        }

        .form-message.error {
            background: #e53e3e;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-content">
            <a href="index.php" class="logo" aria-label="IMOBX">
                <picture>
                    <source srcset="logo.svg" type="image/svg+xml">
                    <img src="logo-512.png" alt="IMOBX" width="40" height="40"
                         srcset="logo-512.png 1x, logo-1254.png 2x">
                </picture>
                <span>IMOBX</span>
            </a>
            <nav>
                <ul>
                    <li><a href="#services"><?php echo $t['services_title']; ?></a></li>
                    <li><a href="#why-us"><?php echo $t['why_us_title']; ?></a></li>
                    <li><a href="#process"><?php echo $t['process_title']; ?></a></li>
                    <li><a href="#contact"><?php echo $t['contact_title']; ?></a></li>
                </ul>
            </nav>
            <div class="language-switcher">
                <button class="lang-btn <?php echo $current_lang === 'ru' ? 'active' : ''; ?>" onclick="changeLanguage('ru')">RU</button>
                <button class="lang-btn <?php echo $current_lang === 'ro' ? 'active' : ''; ?>" onclick="changeLanguage('ro')">RO</button>
                <button class="lang-btn <?php echo $current_lang === 'en' ? 'active' : ''; ?>" onclick="changeLanguage('en')">EN</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1><?php echo $t['hero_title']; ?></h1>
            <p><?php echo $t['hero_subtitle']; ?></p>
            <a href="#contact" class="cta-button"><?php echo $t['cta_button']; ?></a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $t['services_title']; ?></h2>
                <p><?php echo $t['services_subtitle']; ?></p>
            </div>

            <div class="pricing-grid">
                <!-- Basic Package -->
                <div class="pricing-card">
                    <h3><?php echo $t['basic_package']; ?></h3>
                    <div class="price"><?php echo $t['basic_price']; ?></div>
                    <ul>
                        <?php foreach ($t['basic_features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#contact" class="cta-button" style="width: 100%; text-align: center;"><?php echo $t['cta_button']; ?></a>
                </div>

                <!-- Professional Package -->
                <div class="pricing-card featured">
                    <h3><?php echo $t['professional_package']; ?></h3>
                    <div class="price"><?php echo $t['professional_price']; ?></div>
                    <ul>
                        <?php foreach ($t['professional_features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#contact" class="cta-button" style="width: 100%; text-align: center;"><?php echo $t['cta_button']; ?></a>
                </div>

                <!-- Premium Package -->
                <div class="pricing-card">
                    <h3><?php echo $t['premium_package']; ?></h3>
                    <div class="price"><?php echo $t['premium_price']; ?></div>
                    <ul>
                        <?php foreach ($t['premium_features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#contact" class="cta-button" style="width: 100%; text-align: center;"><?php echo $t['cta_button']; ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="why-us" id="why-us">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $t['why_us_title']; ?></h2>
                <p><?php echo $t['why_us_subtitle']; ?></p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3><?php echo $t['why_us_1_title']; ?></h3>
                    <p><?php echo $t['why_us_1_desc']; ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔄</div>
                    <h3><?php echo $t['why_us_2_title']; ?></h3>
                    <p><?php echo $t['why_us_2_desc']; ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3><?php echo $t['why_us_3_title']; ?></h3>
                    <p><?php echo $t['why_us_3_desc']; ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌍</div>
                    <h3><?php echo $t['why_us_4_title']; ?></h3>
                    <p><?php echo $t['why_us_4_desc']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process" id="process">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $t['process_title']; ?></h2>
                <p><?php echo $t['process_subtitle']; ?></p>
            </div>

            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3><?php echo $t['process_1_title']; ?></h3>
                    <p><?php echo $t['process_1_desc']; ?></p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3><?php echo $t['process_2_title']; ?></h3>
                    <p><?php echo $t['process_2_desc']; ?></p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3><?php echo $t['process_3_title']; ?></h3>
                    <p><?php echo $t['process_3_desc']; ?></p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3><?php echo $t['process_4_title']; ?></h3>
                    <p><?php echo $t['process_4_desc']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $t['contact_title']; ?></h2>
                <p><?php echo $t['contact_subtitle']; ?></p>
            </div>

            <div class="contact-content">
                <div class="contact-info">
                    <h3><?php echo $t['contact_title']; ?></h3>
                    
                    <div class="contact-item">
                        <label><?php echo $t['phone']; ?>:</label>
                        <a href="tel:<?php echo $contact_phone; ?>"><?php echo $contact_phone; ?></a>
                    </div>
                    
                    <div class="contact-item">
                        <label><?php echo $t['email']; ?>:</label>
                        <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                    </div>
                    
                    <div class="contact-item">
                        <label><?php echo $t['address']; ?>:</label>
                        <span><?php echo $t['address_value']; ?></span>
                    </div>
                </div>

                <div class="contact-form">
                    <?php if ($form_message): ?>
                        <div class="form-message <?php echo $form_message_type; ?>">
                            <?php 
                            if ($form_message_type === 'success') {
                                echo $current_lang === 'ru' ? 'Спасибо! Ваше сообщение отправлено.' : 
                                     ($current_lang === 'ro' ? 'Mulțumim! Mesajul dvs. a fost trimis.' : 
                                     'Thank you! Your message has been sent.');
                            } else {
                                echo $current_lang === 'ru' ? 'Ошибка: ' . $form_message : 
                                     ($current_lang === 'ro' ? 'Eroare: ' . $form_message : 
                                     'Error: ' . $form_message);
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="contact_form" value="1">
                        
                        <div class="form-group">
                            <label for="name"><?php echo $t['form_name']; ?></label>
                            <input type="text" id="name" name="name" required 
                                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email"><?php echo $t['form_email']; ?></label>
                            <input type="email" id="email" name="email" required
                                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="message"><?php echo $t['form_message']; ?></label>
                            <textarea id="message" name="message" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn"><?php echo $t['form_submit']; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="logo" aria-label="IMOBX">
                    <picture>
                        <source srcset="logo.svg" type="image/svg+xml">
                        <img src="logo-512.png" alt="IMOBX" width="36" height="36"
                             srcset="logo-512.png 1x, logo-1254.png 2x">
                    </picture>
                    <span>IMOBX</span>
                </div>
                <div class="footer-links">
                    <a href="#services"><?php echo $t['services_title']; ?></a>
                    <a href="#why-us"><?php echo $t['why_us_title']; ?></a>
                    <a href="#contact"><?php echo $t['contact_title']; ?></a>
                </div>
                <div>
                    &copy; <?php echo date('Y'); ?> IMOBX. <?php echo $t['footer_rights']; ?>
                </div>
            </div>
        </div>
    </footer>

    <!-- Integrated JavaScript -->
    <script>
        // Language switching function
        function changeLanguage(lang) {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('lang', lang);
            window.location.href = currentUrl.toString();
        }

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
            } else {
                header.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
            }
        });

        // Mobile menu toggle (for future enhancement)
        function toggleMobileMenu() {
            const nav = document.querySelector('nav ul');
            nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
        }

        // Add active state to navigation based on scroll position
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('nav a[href^="#"]');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.style.color = '';
                if (link.getAttribute('href') === '#' + current) {
                    link.style.color = '#3182ce';
                }
            });
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('IMOBX website loaded successfully');
            console.log('Current language: <?php echo $current_lang; ?>');
            
            // Clear form after successful submission
            <?php if ($form_message_type === 'success'): ?>
                // Optionally clear the form after successful submission
                // The form is already cleared via PHP redirect
            <?php endif; ?>
        });
    </script>
</body>
</html>