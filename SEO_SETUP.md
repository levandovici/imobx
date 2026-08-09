# IMOBX.MD - SEO and Search Engine Setup

This document describes all the SEO and search engine optimization files created for IMOBX.MD.

## Files Created

### 1. `.htaccess` - Apache Configuration
**Purpose**: Server configuration for SEO, security, and performance optimization

**Features**:
- **HTTPS enforcement**: Redirects all HTTP traffic to HTTPS
- **WWW removal**: Canonical URL without www (imobx.md instead of www.imobx.md)
- **URL rewriting**: Clean URLs and language parameter handling
- **GZIP compression**: Reduces file sizes for faster loading
- **Browser caching**: Sets expiration headers for static assets
- **Security headers**: X-Frame-Options, X-Content-Type-Options, CSP, etc.
- **Directory protection**: Prevents directory browsing
- **File protection**: Blocks access to sensitive files (.env, .git, config files)
- **Error handling**: Custom error pages (404, 500, 503)
- **PHP configuration**: Upload limits, memory limits, execution time

### 2. `robots.txt` - Web Crawler Configuration
**Purpose**: Instructions for search engine crawlers and AI bots

**Features**:
- **Sitemap location**: Points to sitemap.xml
- **Crawl delay**: Prevents server overload
- **Search engine access**: Allows Google, Bing, Yahoo, DuckDuckGo, Yandex, Baidu
- **AI crawler access**: Allows OpenAI (GPT), Anthropic (Claude), Google AI, Common Crawl
- **Social media crawlers**: Facebook, Twitter/X, LinkedIn, Apple, Amazon
- **Sensitive file blocking**: Protects configuration files and directories
- **Regional optimization**: Specific settings for Yandex (Russia) and Baidu (China)

### 3. `sitemap.xml` - XML Sitemap
**Purpose**: XML sitemap for search engines to discover and index pages

**Features**:
- **Multilingual support**: Russian (default), Romanian, English versions
- **Language alternates**: Proper hreflang tags for multilingual SEO
- **Priority settings**: Homepage gets highest priority (1.0)
- **Change frequency**: Weekly updates for dynamic content
- **Last modification dates**: Current date for all pages
- **Canonical URLs**: Proper URL structure for each language

### 4. `ads.txt` - Authorized Digital Sellers
**Purpose**: Verify authorized advertising sellers and prevent ad fraud

**Features**:
- **Publisher verification**: Format for adding publisher IDs
- **Direct sales information**: Contact for direct advertising
- **Transparency**: Helps prevent unauthorized ad inventory

### 5. `humans.txt` - Human-Readable Information
**Purpose**: Information for human developers and curious visitors

**Features**:
- **Team information**: Contact details and location
- **Services overview**: Web development, management, advertising
- **Technology stack**: PHP, HTML, CSS, JavaScript
- **Standards compliance**: SEO, accessibility, performance, security
- **Last updated**: Current date

### 6. `security.txt` - Security Policy
**Purpose**: Security policy and contact information for security researchers

**Features**:
- **Security contact**: Email for vulnerability reports
- **Expiration date**: One year from creation
- **PGP encryption**: Key for secure communication
- **Response policy**: 48-hour response time commitment
- **Located in**: `.well-known/security.txt` (standard location)

### 7. `browserconfig.xml` - Microsoft Edge/IE Configuration
**Purpose**: Windows browser tile configuration for pinned sites

**Features**:
- **Tile images**: Various sizes for Windows tiles
- **Tile color**: Matches brand color (#1a365d)
- **Live tiles**: Enhanced Windows integration

### 8. `manifest.json` - Progressive Web App (PWA) Manifest
**Purpose**: PWA configuration for mobile app-like experience

**Features**:
- **App information**: Name, description, short name
- **Display settings**: Standalone mode for app-like experience
- **Theme colors**: Consistent branding
- **Icons**: Multiple sizes for various devices
- **Categories**: Business, services, web development
- **Shortcuts**: Quick access to Services and Contact sections
- **Orientation**: Portrait primary for mobile

### 9. `opensearch.xml` - OpenSearch Description
**Purpose**: Browser search engine integration

**Features**:
- **Search plugin**: Add IMOBX to browser search
- **Auto-suggest**: Search suggestions functionality
- **Multi-language**: Russian, Romanian, English support
- **Brand integration**: Custom search experience

### 10. Updated HTML/PHP Files
**Enhancements added**:
- **PWA manifest link**: Progressive web app support
- **OpenSearch link**: Browser search integration
- **Microsoft tile config**: Windows browser configuration
- **Theme color meta**: Mobile browser theme color
- **Apple touch icon**: iOS device integration
- **Structured data (JSON-LD)**: Schema.org markup for rich snippets

## Structured Data (JSON-LD)

The website now includes Schema.org structured data for:

- **ProfessionalService**: Business information
- **Contact details**: Phone, email, address
- **Geographic data**: Chisinau coordinates
- **Service area**: Moldova, Romania, Ukraine
- **Price range**: €500-3000
- **Opening hours**: Business hours
- **Languages**: Russian, Romanian, English
- **Service types**: Web development, management, advertising, SEO

## Benefits

### Search Engine Optimization (SEO)
- Better indexing by search engines
- Multilingual SEO with proper hreflang tags
- Structured data for rich snippets
- Geographic targeting for Moldova, Romania, Ukraine
- Canonical URLs to prevent duplicate content issues

### AI Engine Optimization
- Permissions for major AI crawlers (OpenAI, Anthropic, Google AI)
- Structured data for AI understanding
- Clear content structure for AI processing
- Multilingual support for AI translation services

### Performance
- GZIP compression for faster loading
- Browser caching for repeat visitors
- Optimized asset delivery
- HTTPS enforcement for security and SEO

### Security
- Security headers for protection
- Sensitive file protection
- Security policy for researchers
- HTTPS only access
- CSP to prevent XSS attacks

### User Experience
- PWA capabilities for mobile users
- Progressive enhancement
- Browser search integration
- Consistent branding across platforms
- Better mobile experience

## Implementation Notes

1. **Server Requirements**: Apache server with mod_rewrite, mod_headers, mod_expires, mod_deflate

2. **PHP Version**: Compatible with PHP 7.x and 8.x

3. **SSL Certificate**: Required for HTTPS enforcement

4. **File Permissions**: Ensure .htaccess and other config files are readable by server

5. **Regular Updates**: 
   - Update sitemap.xml when adding new pages
   - Update security.txt expiration date annually
   - Update lastmod dates in sitemap regularly

6. **Monitoring**: Use Google Search Console and Bing Webmaster Tools to monitor indexing

## Next Steps

1. **Generate favicon files** in various sizes (16x16 to 512x512)
2. **Create apple-touch-icon.png** (180x180)
3. **Submit sitemap to search engines**:
   - Google Search Console
   - Bing Webmaster Tools
   - Yandex Webmaster
4. **Monitor performance** using tools like:
   - Google PageSpeed Insights
   - GTmetrix
   - WebPageTest
5. **Set up analytics** (Google Analytics, etc.)
6. **Create additional pages** and update sitemap accordingly

## Geographic Targeting

The configuration specifically targets:
- **Moldova**: Primary market (Chisinau location)
- **Romania**: Secondary market (Romanian language support)
- **Ukraine**: Tertiary market (regional SEO)

Files include proper geo meta tags and structured data for these regions.