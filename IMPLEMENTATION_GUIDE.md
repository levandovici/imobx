# IMOBX.MD - Implementation Guide

This guide explains how the services section and pricing packages were implemented, where the code is located, and how the multilingual functionality works.

## Services Section Implementation

### File Locations

The services section is implemented in two main files:

1. **`index.php`** - PHP version with server-side language handling
2. **`index.html`** - HTML version with client-side JavaScript language handling

### Implementation Structure

#### 1. **PHP Version (`index.php`)**

**Location**: Lines 40-120 (Translations array)

**How it works**:
```php
// Translations array with all text content
$translations = [
    'ru' => [
        'basic_package' => 'Базовый пакет',
        'basic_price' => '€500–800',
        'basic_features' => [
            'Современный адаптивный дизайн',
            'Посадочная страница / бизнес-сайт',
            // ... more features
        ],
        // ... other translations
    ],
    'ro' => [ /* Romanian translations */ ],
    'en' => [ /* English translations */ ]
];
```

**Location**: Lines 535-600 (Services section HTML)

**How it renders**:
```php
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
                <a href="#contact" class="cta-button">
                    <?php echo $t['cta_button']; ?>
                </a>
            </div>
            
            <!-- Professional Package (similar structure) -->
            <!-- Premium Package (similar structure) -->
        </div>
    </div>
</section>
```

#### 2. **HTML Version (`index.html`)**

**Location**: Lines 710-860 (JavaScript translations object)

**How it works**:
```javascript
const translations = {
    ru: {
        basic_package: 'Базовый пакет',
        basic_price: '€500–800',
        basic_features: [
            'Современный адаптивный дизайн',
            'Посадочная страница / бизнес-сайт',
            // ... more features
        ],
        // ... other translations
    },
    ro: { /* Romanian translations */ },
    en: { /* English translations */ }
};
```

**Location**: Lines 425-480 (Services section HTML)

**How it renders**:
```html
<section class="services" id="services">
    <div class="container">
        <div class="section-title">
            <h2 data-key="services_title">Наши услуги</h2>
            <p data-key="services_subtitle">Комплексные решения для вашего онлайн-присутствия</p>
        </div>

        <div class="pricing-grid">
            <!-- Basic Package -->
            <div class="pricing-card">
                <h3 data-key="basic_package">Базовый пакет</h3>
                <div class="price" data-key="basic_price">€500–800</div>
                <ul id="basic-features">
                    <!-- Features populated by JavaScript -->
                </ul>
                <a href="#contact" class="cta-button" data-key="cta_button">
                    Получить консультацию
                </a>
            </div>
            
            <!-- Professional Package (similar structure) -->
            <!-- Premium Package (similar structure) -->
        </div>
    </div>
</section>
```

**Location**: Lines 1080-1095 (JavaScript feature list population)

**Dynamic feature loading**:
```javascript
function updateFeatureLists(t) {
    const basicList = document.getElementById('basic-features');
    const professionalList = document.getElementById('professional-features');
    const premiumList = document.getElementById('premium-features');
    
    basicList.innerHTML = t.basic_features.map(f => `<li>${f}</li>`).join('');
    professionalList.innerHTML = t.professional_features.map(f => `<li>${f}</li>`).join('');
    premiumList.innerHTML = t.premium_features.map(f => `<li>${f}</li>`).join('');
}
```

## Detailed Breakdown of Each Package

### Basic Package (€500–800)

**PHP Implementation**:
- **Translation key**: `basic_package`, `basic_price`, `basic_features`
- **Location**: Lines 54-55 (titles), Lines 56-74 (features array)
- **HTML rendering**: Lines 545-570 (pricing card)
- **CSS styling**: Lines 240-310 (pricing card styles)

**Features included**:
1. Modern responsive design
2. Landing page / business website
3. About company
4. Services
5. Prices
6. Projects / portfolio
7. Customer reviews
8. Contact form
9. WhatsApp / Messenger buttons
10. Google Maps
11. Mobile optimization
12. Basic SEO
13. Domain setup
14. SSL certificate
15. Google Analytics
16. Google Search Console
17. Basic speed optimization

### Professional Package (€800–1,500)

**PHP Implementation**:
- **Translation key**: `professional_package`, `professional_price`, `professional_features`
- **Location**: Lines 75-77 (titles), Lines 78-103 (features array)
- **HTML rendering**: Lines 571-596 (pricing card with "featured" class)
- **CSS styling**: Lines 265-275 (featured card special styling)

**Special features**:
- **"POPULAR" badge**: Added via CSS `::before` pseudo-element
- **Featured styling**: 2px border with accent color
- **All Basic Package features** plus:
  1. More professional custom design
  2. Multiple service sections
  3. Better SEO structure
  4. Local SEO
  5. Google Business Profile optimization
  6. Conversion-focused landing page
  7. Lead generation forms
  8. Phone click tracking
  9. Form submission tracking
  10. Google Analytics setup
  11. Search Console setup
  12. Sitemap
  13. Meta titles and descriptions
  14. Image optimization
  15. Basic Google Ads setup
  16. 1-2 advertising campaigns
  17. Monthly performance report

### Premium Package (€1,500–3,000+)

**PHP Implementation**:
- **Translation key**: `premium_package`, `premium_price`, `premium_features`
- **Location**: Lines 104-106 (titles), Lines 107-130 (features array)
- **HTML rendering**: Lines 597-622 (pricing card)
- **CSS styling**: Lines 240-310 (standard pricing card styles)

**Advanced features**:
1. Full website
2. Multiple landing pages
3. Advanced local SEO
4. Google Ads setup
5. Conversion tracking
6. Analytics dashboard
7. Professional copywriting
8. Professional image selection
9. Competitor research
10. Lead generation strategy
11. Google Business Profile optimization
12. Ongoing SEO
13. Google Ads management
14. Monthly optimization

## CSS Styling Implementation

**Location**: Both files, CSS section within `<style>` tags

**Key CSS classes**:

```css
/* Container and Grid */
.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

/* Pricing Card */
.pricing-card {
    background: white;
    border-radius: 8px;
    padding: 40px;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    border: 1px solid var(--border-color);
}

/* Featured Card */
.pricing-card.featured {
    border: 2px solid var(--accent-color);
    position: relative;
}

/* Popular Badge */
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

/* Feature List */
.pricing-card li::before {
    content: '✓';
    color: var(--success-color);
    font-weight: bold;
    margin-right: 10px;
}
```

## Multilingual Functionality

### PHP Version (Server-side)

**Language Detection** (Lines 10-22):
```php
$supported_languages = ['ru', 'ro', 'en'];
$default_language = 'ru';

// Check URL parameter, session, or default
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_languages)) {
    $_SESSION['lang'] = $_GET['lang'];
    $current_lang = $_GET['lang'];
} elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $supported_languages)) {
    $current_lang = $_SESSION['lang'];
} else {
    $current_lang = $default_language;
}
```

**Language Switching** (Lines 1070-1078):
```php
<div class="language-switcher">
    <button class="lang-btn <?php echo $current_lang === 'ru' ? 'active' : ''; ?>" 
            onclick="changeLanguage('ru')">RU</button>
    <button class="lang-btn <?php echo $current_lang === 'ro' ? 'active' : ''; ?>" 
            onclick="changeLanguage('ro')">RO</button>
    <button class="lang-btn <?php echo $current_lang === 'en' ? 'active' : ''; ?>" 
            onclick="changeLanguage('en')">EN</button>
</div>
```

### HTML Version (Client-side)

**Language Switching Function** (Lines 1030-1065):
```javascript
function changeLanguage(lang) {
    currentLanguage = lang;
    const t = translations[lang];
    
    // Update page title and meta tags
    document.title = t.title;
    document.querySelector('meta[name="description"]').setAttribute('content', t.description);
    // ... more meta tag updates
    
    // Update all elements with data-key attribute
    document.querySelectorAll('[data-key]').forEach(element => {
        const key = element.getAttribute('data-key');
        if (t[key]) {
            element.textContent = t[key];
        }
    });
    
    // Update feature lists
    updateFeatureLists(t);
    
    // Save to localStorage
    localStorage.setItem('imobx_language', lang);
}
```

**Initialization** (Lines 1219-1235):
```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Check for saved language preference
    const savedLanguage = localStorage.getItem('imobx_language');
    if (savedLanguage && translations[savedLanguage]) {
        changeLanguage(savedLanguage);
    } else {
        // Initialize with default language
        updateFeatureLists(translations[currentLanguage]);
    }
});
```

## How the Content Flows

### User Experience Flow:

1. **User visits website** → Loads default language (Russian)
2. **User clicks language button** → Triggers language change
3. **System updates content** → Replaces text with translated version
4. **System saves preference** → Stores in session (PHP) or localStorage (HTML)
5. **User navigates sections** → Content remains in selected language

### Technical Flow:

**PHP Version**:
```
User Request → Server detects language → PHP loads translations → 
Server renders HTML with translated content → Browser displays page
```

**HTML Version**:
```
User Request → Browser loads page → JavaScript detects saved language → 
JavaScript updates DOM elements → Browser displays translated content
```

## File Structure Summary

```
imobx/
├── index.php              # Main PHP file with server-side translations
├── index.html             # Main HTML file with client-side translations
├── .htaccess              # Apache configuration
├── robots.txt             # Search engine instructions
├── sitemap.xml            # XML sitemap
├── ads.txt                # Authorized digital sellers
├── humans.txt             # Human-readable information
├── security.txt           # Security policy
├── .well-known/
│   └── security.txt       # Security policy (standard location)
├── browserconfig.xml      # Microsoft browser configuration
├── manifest.json          # PWA manifest
├── opensearch.xml         # Browser search integration
├── SEO_SETUP.md           # SEO documentation
└── IMPLEMENTATION_GUIDE.md # This file
```

## Maintenance and Updates

### To Add New Features to Packages:

**PHP Version**:
1. Add feature to appropriate array in `$translations` (Lines 56-130)
2. No HTML changes needed (features are rendered dynamically)

**HTML Version**:
1. Add feature to appropriate array in `translations` object (Lines 710-860)
2. No HTML changes needed (features are rendered dynamically)

### To Change Prices:

**PHP Version**:
1. Update `basic_price`, `professional_price`, `premium_price` in translation arrays

**HTML Version**:
1. Update price values in `translations` object

### To Add New Language:

**PHP Version**:
1. Add new language array to `$translations` with all keys
2. Add language button in HTML
3. Add to `$supported_languages` array

**HTML Version**:
1. Add new language object to `translations` with all keys
2. Add language button in HTML
3. Update language switching function

## Key Advantages of This Implementation

1. **Separation of Concerns**: Content separated from structure
2. **Easy Maintenance**: Add features in one place, update everywhere
3. **Scalability**: Easy to add new languages or packages
4. **Performance**: Minimal JavaScript (HTML version) or server-side rendering (PHP version)
5. **SEO Friendly**: Proper meta tags and structured data
6. **User Experience**: Instant language switching, preference persistence
7. **Responsive**: Works on all devices
8. **Accessible**: Proper semantic HTML and ARIA labels

This implementation provides a solid foundation for a professional B2B website with excellent multilingual support and easy maintenance.