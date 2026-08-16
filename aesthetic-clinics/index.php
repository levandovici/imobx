<?php
session_start();

// Form handling
$form_message = '';
$form_message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_message = 'Invalid email address';
        $form_message_type = 'error';
    } elseif (empty($name) || empty($message)) {
        $form_message = 'Please fill in all fields';
        $form_message_type = 'error';
    } else {
        $to = 'contact@imobx.md';
        $subject = 'Aesthetic Clinics Website Inquiry from IMOBX.MD';
        
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Message:\n$message\n";
        $email_content .= "\n---\n";
        $email_content .= "Niche: Aesthetic Clinics\n";
        $email_content .= "Sent from: " . $_SERVER['REMOTE_ADDR'];
        $email_content .= " at " . date('Y-m-d H:i:s');
        
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
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

if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_languages)) {
    $_SESSION['lang'] = $_GET['lang'];
    $current_lang = $_GET['lang'];
} elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $supported_languages)) {
    $current_lang = $_SESSION['lang'];
} else {
    $current_lang = $default_language;
}

// Translations array for Aesthetic Clinics niche
$translations = [
    'ru' => [
        'title' => 'IMOBX - Веб-сайты для эстетических клиник',
        'description' => 'Профессиональные веб-сайты для эстетических клиник в Молдове, Румынии и Украине. Лидогенерация, SEO и реклама.',
        'keywords' => 'веб-сайт эстетической клиники, сайт косметологии, веб-разработка, SEO, Молдова, Румыния, Украина',
        'hero_title' => 'Веб-сайты для эстетических клиник',
        'hero_subtitle' => 'Создаем сайты, которые приводят клиентов в эстетические клиники. Разработка, SEO и реклама.',
        'cta_button' => 'Получить консультацию',
        'services_title' => 'Наши услуги для эстетических клиник',
        'services_subtitle' => 'Комплексные решения для онлайн-присутствия эстетического бизнеса',
        'basic_package' => 'Базовый пакет',
        'basic_price' => '€700–1,500',
        'professional_package' => 'Профессиональный пакет',
        'professional_price' => '€1,500–2,500',
        'premium_package' => 'Премиум пакет',
        'premium_price' => '€2,500–4,000+',
        'website_dev' => 'Разработка веб-сайта',
        'website_management' => 'Управление сайтом',
        'ad_campaigns' => 'Рекламные кампании',
        'seo_optimization' => 'SEO оптимизация',
        'contact_title' => 'Свяжитесь с нами',
        'contact_subtitle' => 'Готовы обсудить проект веб-сайта для вашей эстетической клиники?',
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
            'Посадочная страница эстетической клиники',
            'О клинике',
            'Услуги косметологии',
            'Цены на процедуры',
            'Команда врачей',
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
        'why_us_subtitle' => 'Мы создаем веб-сайты, которые работают для эстетического бизнеса',
        'why_us_1_title' => 'Опыт в эстетике',
        'why_us_1_desc' => 'Специализируемся на веб-сайтах для эстетических клиник, где один клиент стоит дорого',
        'why_us_2_title' => 'Комплексный подход',
        'why_us_2_desc' => 'Разработка, SEO, реклама и аналитика в одном пакете',
        'why_us_3_title' => 'Ориентированный на результат',
        'why_us_3_desc' => 'Фокус на конверсиях и привлечении клиентов',
        'why_us_4_title' => 'Локальное SEO',
        'why_us_4_desc' => 'Оптимизация для Молдовы, Румынии и Украины',
        'portfolio_title' => 'Наши проекты',
        'portfolio_subtitle' => 'Примеры веб-сайтов для эстетических клиник',
        'process_title' => 'Как мы работаем',
        'process_subtitle' => 'Прозрачный процесс от идеи до запуска',
        'process_1_title' => 'Консультация',
        'process_1_desc' => 'Обсуждаем цели и требования вашей эстетической клиники',
        'process_2_title' => 'Разработка',
        'process_2_desc' => 'Создаем дизайн и функционал для эстетического сайта',
        'process_3_title' => 'Запуск',
        'process_3_desc' => 'Запускаем веб-сайт и настраиваем аналитику',
        'process_4_title' => 'Поддержка',
        'process_4_desc' => 'Обеспечиваем поддержку и оптимизацию'
    ],
    'ro' => [
        'title' => 'IMOBX - Site-uri web pentru clinici estetice',
        'description' => 'Site-uri web profesionale pentru clinici estetice în Moldova, România și Ucraina. Generare de lead-uri, SEO și publicitate.',
        'keywords' => 'site web clinică estetică, site cosmetologie, dezvoltare web, SEO, Moldova, România, Ucraina',
        'hero_title' => 'Site-uri web pentru clinici estetice',
        'hero_subtitle' => 'Creăm site-uri care aduc clienți în clinici estetice. Dezvoltare, SEO și publicitate.',
        'cta_button' => 'Obțineți o consultație',
        'services_title' => 'Serviciile noastre pentru clinici estetice',
        'services_subtitle' => 'Soluții complete pentru prezența online a afacerii estetice',
        'basic_package' => 'Pachetul de bază',
        'basic_price' => '€700–1,500',
        'professional_package' => 'Pachet profesional',
        'professional_price' => '€1,500–2,500',
        'premium_package' => 'Pachet premium',
        'premium_price' => '€2,500–4,000+',
        'website_dev' => 'Dezvoltare site web',
        'website_management' => 'Management site web',
        'ad_campaigns' => 'Campanii publicitare',
        'seo_optimization' => 'Optimizare SEO',
        'contact_title' => 'Contactați-ne',
        'contact_subtitle' => 'Sunteți gata să discutați proiectul site-ului pentru clinica dumneavoastră estetică?',
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
            'Pagină de aterizare pentru clinică estetică',
            'Despre clinică',
            'Servicii cosmetologie',
            'Prețuri proceduri',
            'Echipă medici',
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
        'why_us_subtitle' => 'Creăm site-uri web care lucrează pentru afacerile estetice',
        'why_us_1_title' => 'Experiență estetică',
        'why_us_1_desc' => 'Specializați pe site-uri web pentru clinici estetice unde un client valorează mult',
        'why_us_2_title' => 'Abordare completă',
        'why_us_2_desc' => 'Dezvoltare, SEO, publicitate și analiză într-un singur pachet',
        'why_us_3_title' => 'Orientat spre rezultate',
        'why_us_3_desc' => 'Focus pe conversii și atragerea clienților',
        'why_us_4_title' => 'SEO local',
        'why_us_4_desc' => 'Optimizare pentru Moldova, România și Ucraina',
        'portfolio_title' => 'Proiectele noastre',
        'portfolio_subtitle' => 'Exemple de site-uri web pentru clinici estetice',
        'process_title' => 'Cum lucrăm',
        'process_subtitle' => 'Proces transparent de la idee la lansare',
        'process_1_title' => 'Consultație',
        'process_1_desc' => 'Discutăm obiectivele și cerințele clinicii dumneavoastră estetice',
        'process_2_title' => 'Dezvoltare',
        'process_2_desc' => 'Creăm designul și funcționalitatea pentru site-ul estetic',
        'process_3_title' => 'Lansare',
        'process_3_desc' => 'Lansăm site-ul web și configurăm analiza',
        'process_4_title' => 'Suport',
        'process_4_desc' => 'Oferim suport și optimizare'
    ],
    'en' => [
        'title' => 'IMOBX - Websites for Aesthetic Clinics',
        'description' => 'Professional websites for aesthetic clinics in Moldova, Romania and Ukraine. Lead generation, SEO and advertising.',
        'keywords' => 'aesthetic clinic website, cosmetology website, web development, SEO, Moldova, Romania, Ukraine',
        'hero_title' => 'Websites for Aesthetic Clinics',
        'hero_subtitle' => 'We create websites that bring clients to aesthetic clinics. Development, SEO and advertising.',
        'cta_button' => 'Get a Consultation',
        'services_title' => 'Our Services for Aesthetic Clinics',
        'services_subtitle' => 'Comprehensive solutions for aesthetic business online presence',
        'basic_package' => 'Basic Package',
        'basic_price' => '€700–1,500',
        'professional_package' => 'Professional Package',
        'professional_price' => '€1,500–2,500',
        'premium_package' => 'Premium Package',
        'premium_price' => '€2,500–4,000+',
        'website_dev' => 'Web Development',
        'website_management' => 'Website Management',
        'ad_campaigns' => 'Advertising Campaigns',
        'seo_optimization' => 'SEO Optimization',
        'contact_title' => 'Contact Us',
        'contact_subtitle' => 'Ready to discuss your aesthetic clinic website project?',
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
            'Aesthetic clinic landing page',
            'About clinic',
            'Cosmetology services',
            'Procedure prices',
            'Medical team',
            'Client reviews',
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
        'why_us_subtitle' => 'We create websites that work for aesthetic business',
        'why_us_1_title' => 'Aesthetic Experience',
        'why_us_1_desc' => 'Specialized in websites for aesthetic clinics where one customer is worth a lot',
        'why_us_2_title' => 'Comprehensive Approach',
        'why_us_2_desc' => 'Development, SEO, advertising and analytics in one package',
        'why_us_3_title' => 'Results Oriented',
        'why_us_3_desc' => 'Focus on conversions and attracting clients',
        'why_us_4_title' => 'Local SEO',
        'why_us_4_desc' => 'Optimization for Moldova, Romania and Ukraine',
        'portfolio_title' => 'Our Projects',
        'portfolio_subtitle' => 'Examples of websites for aesthetic clinics',
        'process_title' => 'How We Work',
        'process_subtitle' => 'Transparent process from idea to launch',
        'process_1_title' => 'Consultation',
        'process_1_desc' => 'We discuss your aesthetic clinic goals and requirements',
        'process_2_title' => 'Development',
        'process_2_desc' => 'We create design and functionality for aesthetic website',
        'process_3_title' => 'Launch',
        'process_3_desc' => 'We launch the website and set up analytics',
        'process_4_title' => 'Support',
        'process_4_desc' => 'We provide support and optimization'
    ]
];

$t = $translations[$current_lang];
$contact_phone = '+37369215845';
$contact_email = 'contact@imobx.md';
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XGRM0W468L"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XGRM0W468L');
</script>

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
    <link rel="canonical" href="https://imobx.md/aesthetic-clinics/<?php echo $current_lang === 'ru' ? '' : '?lang=' . $current_lang; ?>">
    
    <!-- Favicons / Icons -->
    <link rel="icon" href="../logo.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="512x512" href="../logo-512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../logo-512.png">
    <link rel="mask-icon" href="../logo.svg" color="#1a365d">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="../manifest.json">
    
    <!-- OpenSearch -->
    <link rel="search" type="application/opensearchdescription+xml" title="IMOBX" href="../opensearch.xml">
    
    <!-- Microsoft Tile Configuration -->
    <meta name="msapplication-config" content="../browserconfig.xml">
    <meta name="msapplication-TileColor" content="#1a365d">
    <meta name="msapplication-TileImage" content="../logo-512.png">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#1a365d">
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "IMOBX",
        "description": "<?php echo $t['description']; ?>",
        "url": "https://imobx.md/aesthetic-clinics",
        "telephone": "+37369215845",
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
        "priceRange": "€700-4000",
        "openingHours": "Mo-Fr 09:00-18:00",
        "availableLanguage": ["Russian", "Romanian", "English"],
        "serviceType": ["Web Development", "Website Management", "Advertising Campaigns", "SEO Optimization"]
    }
    </script>
    
    <style>
        /* CSS Variables */
        :root {
            --primary-color: #1a365d;
            --primary-light: #2c5282;
            --accent-color: #3182ce;
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
            background: var(--accent-color);
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

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

        .contact-item strong {
            display: block;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .contact-item a {
            color: var(--text-medium);
            text-decoration: none;
            transition: var(--transition);
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
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
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

        .form-message {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .form-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .form-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
            flex-direction: column;
            align-items: center;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 18px;
            }

            .header-content {
                flex-direction: column;
                gap: 20px;
            }

            nav ul {
                gap: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-content">
            <a href="../" class="logo">
                <picture>
                    <source srcset="../logo.svg" type="image/svg+xml">
                    <img src="../logo-512.png" alt="IMOBX Logo">
                </picture>
                IMOBX
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
                <a href="?lang=ru" class="lang-btn <?php echo $current_lang === 'ru' ? 'active' : ''; ?>">RU</a>
                <a href="?lang=ro" class="lang-btn <?php echo $current_lang === 'ro' ? 'active' : ''; ?>">RO</a>
                <a href="?lang=en" class="lang-btn <?php echo $current_lang === 'en' ? 'active' : ''; ?>">EN</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1><?php echo $t['hero_title']; ?></h1>
            <p><?php echo $t['hero_subtitle']; ?></p>
            <a href="#contact" class="cta-button"><?php echo $t['cta_button']; ?></a>
        </div>
    </section>

    <section class="services" id="services">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $t['services_title']; ?></h2>
                <p><?php echo $t['services_subtitle']; ?></p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3><?php echo $t['basic_package']; ?></h3>
                    <div class="price"><?php echo $t['basic_price']; ?></div>
                    <ul>
                        <?php foreach ($t['basic_features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pricing-card featured">
                    <h3><?php echo $t['professional_package']; ?></h3>
                    <div class="price"><?php echo $t['professional_price']; ?></div>
                    <ul>
                        <?php foreach ($t['professional_features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pricing-card">
                    <h3><?php echo $t['premium_package']; ?></h3>
                    <div class="price"><?php echo $t['premium_price']; ?></div>
                    <ul>
                        <?php foreach ($t['premium_features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="why-us" id="why-us">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $t['why_us_title']; ?></h2>
                <p><?php echo $t['why_us_subtitle']; ?></p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">💆</div>
                    <h3><?php echo $t['why_us_1_title']; ?></h3>
                    <p><?php echo $t['why_us_1_desc']; ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📦</div>
                    <h3><?php echo $t['why_us_2_title']; ?></h3>
                    <p><?php echo $t['why_us_2_desc']; ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
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

    <section class="contact" id="contact">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $t['contact_title']; ?></h2>
                <p><?php echo $t['contact_subtitle']; ?></p>
            </div>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <div class="contact-item">
                        <strong><?php echo $t['phone']; ?>:</strong>
                        <a href="tel:<?php echo $contact_phone; ?>"><?php echo $contact_phone; ?></a>
                    </div>
                    <div class="contact-item">
                        <strong><?php echo $t['email']; ?>:</strong>
                        <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                    </div>
                    <div class="contact-item">
                        <strong><?php echo $t['address']; ?>:</strong>
                        <span><?php echo $t['address_value']; ?></span>
                    </div>
                </div>
                <div class="contact-form">
                    <?php if ($form_message): ?>
                        <div class="form-message <?php echo $form_message_type; ?>">
                            <?php echo $form_message; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <input type="hidden" name="contact_form" value="1">
                        <div class="form-group">
                            <label for="name"><?php echo $t['form_name']; ?></label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo $t['form_email']; ?></label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message"><?php echo $t['form_message']; ?></label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="cta-button"><?php echo $t['form_submit']; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container footer-content">
            <a href="../" class="logo">
                <picture>
                    <source srcset="../logo.svg" type="image/svg+xml">
                    <img src="../logo-512.png" alt="IMOBX Logo">
                </picture>
                IMOBX
            </a>
            <div class="footer-links">
                <a href="../"><?php echo $t['language_switch']; ?></a>
                <a href="#services"><?php echo $t['services_title']; ?></a>
                <a href="#contact"><?php echo $t['contact_title']; ?></a>
            </div>
            <p>&copy; <?php echo date('Y'); ?> IMOBX. <?php echo $t['footer_rights']; ?></p>
        </div>
    </footer>
</body>
</html>
