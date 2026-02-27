<!-- Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later

 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Documentation
 PATH: ./CHANGELOG.md
 VERSION: 03.08.01
 BRIEF: Changelog file documenting version history of MokoCassiopeia
 -->

# Changelog — MokoCassiopeia (VERSION: 03.08.01)

All notable changes to the MokoCassiopeia Joomla template are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [03.08.01] - 2026-02-27

### Removed - Fix Breaking Overrides

**Critical fix**: Removed mod_menu override that was causing menu links to break and language strings not to load.

#### Problem
- mod_menu override files (default.php, default_component.php, default_url.php) were attempting to load menu-specific layouts that don't exist in the template
- This broke Joomla's core menu rendering system
- Menu links were not functional
- Language strings were not loading properly in menus

#### Solution
- **Removed** entire `src/templates/html/mod_menu/` directory (4 files)
- Template now uses Joomla's default menu rendering
- Custom styling can still be applied via CSS using `.mod-menu` class
- All menu functionality restored to standard Joomla behavior

#### Documentation Updates
- Updated MODULE_OVERRIDES.md: Changed count from 20 to 19 module overrides, removed mod_menu section, added note about removal
- Updated STANDARD_MODULES_README.md: Removed mod_menu documentation, renumbered remaining modules, updated file structure
- Updated testing checklists to remove mod_menu references

#### Files Removed
- `src/templates/html/mod_menu/default.php`
- `src/templates/html/mod_menu/default_component.php`
- `src/templates/html/mod_menu/default_url.php`
- `src/templates/html/mod_menu/index.html`

**Note**: This is a patch release that removes problematic overrides to restore core functionality. Menu styling via CSS remains intact.

## [03.08.00] - 2026-02-22

### Added - Community Builder Component Overrides

Minor version bump adding **4 Community Builder component view overrides** to complement the existing CB module overrides (mod_cblogin, mod_comprofilerOnline).

#### Community Builder Components (4 views)
- **com_comprofiler/userprofile**: User profile display with avatar, tabs, and custom fields in responsive layout
- **com_comprofiler/userslist**: User directory with search functionality and responsive grid (1-3 columns)
- **com_comprofiler/registers**: User registration form with multi-step fieldsets, validation, captcha support
- **com_comprofiler/login**: Login page with remember me checkbox, registration and password recovery links

#### CSS Architecture (600+ lines)
- Mobile-first responsive design with Bootstrap breakpoints (576px, 768px, 992px)
- BEM naming convention (`.cb-profile__`, `.cb-userslist__`, `.cb-register__`, `.cb-login__`)
- Integrated with template CSS variables for consistent theming
- 48px touch targets on mobile, 44px on desktop (WCAG 2.1 Level AA)
- 16px input font size on mobile to prevent iOS zoom
- Responsive grids adapting from 1 column (mobile) to 2-3 columns (desktop)

#### Accessibility Features
- Full ARIA labels and descriptions for screen readers
- Semantic HTML5 structure with proper landmarks
- Keyboard navigation support throughout
- Required field indicators with visually-hidden labels
- Focus states with visible outlines

#### Security Best Practices
- Proper output escaping with htmlspecialchars() and ENT_QUOTES
- _JEXEC security checks in all PHP files
- index.html protection files in all directories (6 files)
- CSRF token support in forms
- Input validation and error display

### Technical Details
- **Files Added**: 11 (4 component view files + 6 index.html + 1 root index.html)
- **CSS Lines Added**: 600+ lines of responsive styles
- **PHP Validation**: All files pass syntax validation
- **Component Views**: userprofile, userslist, registers, login
- **Documentation**: Ready for MODULE_OVERRIDES.md update

## [03.07.00] - 2026-02-22

### Added - Mobile-Responsive Module & Component Overrides

This major release introduces **20 mobile-responsive module overrides** and **3 component overrides** designed to enhance the mobile user experience across standard Joomla, VirtueMart, Community Builder, and popular third-party extensions.

#### Search Module
- **mod_search**: Mobile-responsive search with multiple button positions (left, right, top, bottom), 48px touch targets, 16px input font to prevent iOS zoom

#### VirtueMart E-Commerce Modules (5 modules)
- **mod_virtuemart_cart**: Shopping cart with responsive product cards, remove buttons, price display
- **mod_virtuemart_product**: Product showcase with responsive grid (1-4 columns), hover effects, ratings
- **mod_virtuemart_currencies**: Currency selector dropdown with accessible styling
- **mod_virtuemart_category**: Category navigation with hierarchical display, product counts
- **mod_virtuemart_manufacturer**: Manufacturer/brand display with responsive grid (2-4 columns)
- **VIRTUEMART_MODULES_README.md**: Comprehensive master documentation for all VirtueMart overrides

#### Standard Joomla & Community Builder Modules (6 modules)
- **mod_menu**: Main navigation with multiple layout files (default, component, URL), responsive horizontal/vertical layouts
- **mod_breadcrumbs**: Breadcrumb navigation with Schema.org markup for SEO
- **mod_login**: User login/logout form with 2FA support, remember me checkbox
- **mod_articles_latest**: Latest articles with responsive cards, metadata, featured badges
- **mod_cblogin**: Community Builder login with avatar display, profile links
- **mod_comprofilerOnline**: CB online users with avatar grid, online status indicators
- **STANDARD_MODULES_README.md**: Comprehensive master documentation for standard module overrides

#### Industry Extension Modules (8 modules + 2 components)
- **mod_k2_content**: K2 content display with responsive grid (1-3 columns), featured images, metadata
- **mod_acymailing**: Newsletter subscription form with validation, GDPR compliance
- **mod_hikashop_cart**: HikaShop shopping cart with product list, quantity adjustment
- **mod_kunenalatest**: Kunena forum latest posts with excerpts, avatars, reply counts
- **mod_kunenalogin**: Kunena forum login with user avatar, statistics, quick login
- **mod_kunenasearch**: Kunena forum search with multiple button positions
- **mod_kunenastats**: Kunena forum statistics with visual cards, member/topic counts
- **mod_osmembership**: OS Membership Pro plans with pricing cards, feature lists, badges
- **com_kunena/category**: Kunena forum category list component view
- **com_osmembership/plans**: OS Membership Pro responsive pricing table component view
- **INDUSTRY_MODULES_README.md**: Comprehensive master documentation for industry extensions

#### CSS & Styling
- Added **2,000+ lines** of mobile-responsive CSS to `src/media/css/template.css`
- Four dedicated CSS sections for organized styling:
  - MOD_SEARCH MOBILE RESPONSIVE STYLES
  - VIRTUEMART MODULE MOBILE RESPONSIVE STYLES
  - STANDARD JOOMLA & COMMUNITY BUILDER MODULE STYLES
  - INDUSTRY EXTENSION MODULE STYLES
  - ADDITIONAL KUNENA & MEMBERSHIP PRO MODULE STYLES
- BEM naming convention for all CSS classes (`.mod-search__button`, `.mod-vm-product__grid`, etc.)
- Integration with existing template CSS variables for seamless theming
- Responsive grids with Bootstrap-aligned breakpoints (sm, md, lg, xl, xxl)

#### Documentation
- **docs/MODULE_OVERRIDES.md**: Comprehensive guide covering all 23 overrides
  - Feature descriptions and specifications
  - CSS architecture and customization guide
  - Accessibility features documentation
  - Troubleshooting guide
  - Best practices and usage examples
- Individual README.md files for VirtueMart module groups (5 modules)
- Master README files for each category (VirtueMart, Standard, Industry)
- Security index.html files in all override directories (23 files)

### Key Features Across All Overrides

#### Mobile-First Responsive Design
- Touch targets: 48px on mobile, 44px on desktop (WCAG 2.1 compliant)
- 16px minimum input font size on mobile (prevents iOS zoom)
- Responsive layouts: 1-4 columns based on screen size
- Mobile-first CSS with progressive enhancement
- Bootstrap-aligned breakpoints: 576px, 768px, 992px, 1200px, 1400px

#### Accessibility
- Full ARIA labels and descriptions on all interactive elements
- Keyboard navigation support throughout
- Screen reader compatible with semantic HTML5
- WCAG 2.1 Level AA compliance
- Proper heading hierarchy and focus management
- Alternative text for images and icons

#### Security
- Proper output escaping with Joomla escapeHtml()
- _JEXEC security checks in all PHP files
- index.html protection files in all directories
- Input validation where applicable
- CSRF token support in forms

#### Maintainability
- BEM naming convention for CSS classes
- Consistent code structure across all overrides
- Comprehensive inline documentation
- Modular, reusable components
- Integration with template CSS variables

### Changed
- **Version**: Updated to 03.07.00 across all files

### Technical Details
- **Total Files**: 66 new files created
  - 42 PHP override files
  - 23 index.html security files  
  - 1 comprehensive MODULE_OVERRIDES.md documentation
- **CSS Added**: 2,000+ lines of responsive styles
- **Documentation**: 15,000+ words across all README files

### Migration Notes
- All overrides are opt-in and non-breaking
- Existing sites will continue to work without changes
- Overrides automatically apply when modules are used
- No database changes or migration required
- Custom overrides can coexist with template overrides

### Testing
- All PHP syntax validated
- Code review completed (all issues resolved)
- CodeQL security scan passed
- Responsive design tested across breakpoints
- Accessibility validated with ARIA compliance

---

## [03.06.03] - 2026-01-30

### Added
- **Templates Directory**: Created `/templates/` directory with ready-to-use color palette templates
  - `colors_custom_light.css` - Comprehensive light mode color template with all available variables
  - `colors_custom_dark.css` - Comprehensive dark mode color template with all available variables
- **CSS Variables Documentation**: Added complete CSS variables reference guide (`docs/CSS_VARIABLES.md`)
  - Complete list of all customizable CSS variables
  - Organized by category (colors, typography, borders, etc.)
  - Usage examples and tips for customization
  - Light and dark mode variable differences documented

### Changed
- **README**: Updated title to "README - MokoCassiopeia (VERSION: 03.06.03)"
- **README**: Fixed custom color variables instructions with correct file paths
- **README**: Updated example CSS variables to use actual template variable names (e.g., `--color-link` instead of `--cassiopeia-color-link`)
- **README**: Added note that custom color files are excluded from version control via `.gitignore`
- **README**: Enhanced Custom Color Palettes section with step-by-step instructions
- **README**: Added link to CSS Variables documentation for complete reference
- **TOC CSS**: Updated bootstrap-toc.css to use template color variables for proper theme integration
- **Version**: Updated version to 03.06.03 across all files

### Documentation
- **docs/README.md**: Added CSS Variables Reference to developer documentation section
- **docs/README.md**: Updated project structure to include `/templates/` directory
- **docs/README.md**: Updated version to 03.06.03
- Clarified that `colors_custom.css` files are gitignored to prevent fork-specific customizations from being committed

## [03.06.02] - 2026-01-30

### Major Rebrand
This release includes a complete rebrand from "Moko-Cassiopeia" (hyphenated) to "MokoCassiopeia" (camelCase).

### Changed
- **Naming Convention**: Changed template identifier from `moko-cassiopeia` to `mokocassiopeia` across all files
- **Display Name**: Updated from "Moko-Cassiopeia" to "MokoCassiopeia" in all documentation and language files
- **Language Constants**: Renamed all language keys from `TPL_MOKO-CASSIOPEIA_*` to `TPL_MOKOCASSIOPEIA_*`
- **Language Files**: Renamed from `tpl_moko-cassiopeia.*` to `tpl_mokocassiopeia.*` (4 files)
- **Media Paths**: Updated from `media/templates/site/moko-cassiopeia/` to `media/templates/site/mokocassiopeia/`
- **Repository URLs**: Updated all references to use `MokoCassiopeia` casing
- **Template Element**: Changed Joomla extension element name from `moko-cassiopeia` to `mokocassiopeia`
- **Documentation**: Updated all markdown files, XML manifests, and code comments

### Removed
- **Default Assets**: Removed `logo.svg` and `favicon.ico` to allow clean installations
- **Template Overrides**: Removed all template override files (48 files, ~4,500 lines)
  - Removed `src/templates/html/` folder entirely
  - Removed overrides for: com_content, com_contact, com_engage, mod_menu, mod_custom, mod_gabble, layouts/chromes
  - Template now inherits all rendering from Joomla Cassiopeia defaults
  - Updated `templateDetails.xml` to remove html folder reference

### Breaking Changes
⚠️ **Important**: This release contains breaking changes:
- Existing installations will see template name change in Joomla admin
- Custom code referencing old language constants (`TPL_MOKO-CASSIOPEIA_*`) will need updates
- Custom code referencing old media paths will need updates
- Sites relying on custom template overrides will revert to Cassiopeia defaults
- Extension element name changed (may require reinstallation in some cases)

### Migration Notes
- Backup your site before upgrading
- Review any custom code for references to old naming convention
- Test thoroughly after upgrade, especially if using custom overrides

## [03.06.00] - 2026-01-28

### Changed
- Updated version to 03.06.00 across all files
- Standardized version numbering format

## [03.05.01] - 2026-01-09

### Added
- Added `dependency-review.yml` workflow for dependency vulnerability scanning
- Added `standards-compliance.yml` workflow for MokoStandards validation
- Added `.github/dependabot.yml` configuration for automated security updates
- Added `docs/README.md` as documentation index

### Changed
- Removed custom `codeql-analysis.yml` workflow (repository uses GitHub's default CodeQL setup)
- Enforced repository compliance with MokoStandards requirements
- Improved security posture with automated scanning and dependency management

## [03.05.00] - 2026-01-04

### Added
- Created `.github/workflows` directory structure

### Changed
- Replaced `./CODE_OF_CONDUCT.md` from `MokoStandards`
- Replaced `./CONTRIBUTING.md` from `MokoStandards`
- TODO split to own file

## [03.01.00] - 2025-12-16

### Added
- Created `.github/workflows/` directory for GitHub Actions

## [03.00.00] - 2025-12-09

### Changed
- Copyright Headers updated to MokoCodingDefaults standards
- Fixed `./templates/mokocassiopeia/index.php` color style injection
- Upgraded Font Awesome 6 to Font Awesome 7 Free
- Added Font Awesome 7 Free style fallback

### Removed
- Removed `./CODE_OF_CONDUCT.md` (replaced with MokoStandards version)
- Removed `./CONTRIBUTING.md` (replaced with MokoStandards version)

## [02.01.05] - 2025-09-04

### Changed
- Repaired template.css and colors_standard.css

### Removed
- Removed vmbasic.css

## [02.00.00] - 2025-08-30

### Added - Dark Mode Toggle
- Frontend toggle switch included in template
- JavaScript handles switching between light/dark modes
- Dark mode CSS rules applied across template styles
- Automatic persistence of user choice (via localStorage)
- Admins can override default mode in template settings

### Added - Header Parameters Update
- Added logo parameter support in template settings
- Updated metadata & copyright header

### Added - Expanded TOC (Table of Contents)
- Automatic TOC injection when enabled
- User selects placement via article > options > layout (`toc-left` or `toc-right`)

### Changed
- Cleaned up `index.php` by removing skip-to-content duplicate calls
- Consolidated JavaScript asset loading (ensuring dark-mode script is loaded correctly from external JS file)
- Streamlined CSS for toggle switch, ensuring it inherits Bootstrap/Cassiopeia defaults
- General accessibility refinements in typography and color contrast
- Fixed missing logo param in header output
- Corrected stylesheet inconsistencies between Bootstrap 5 helpers and template overrides
- Patched redundant calls in script includes

## [01.00.00] - 2025-01-01

### Added - Initial Public Release
- Font Awesome 6 integration (later upgraded to FA7)
- Bootstrap 5 helpers (grid, utility classes)
- Automatic Table of Contents (TOC) utility
- Moko Expansions: Google Tag Manager / GA4 hooks
- Built on top of Joomla's default Cassiopeia template
- Minimal core template overrides for maximum upgrade compatibility

---

## Links

- **Full Roadmap**: [MokoCassiopeia Roadmap](https://mokoconsulting.tech/support/joomla-cms/mokocassiopeia-roadmap)
- **Repository**: [GitHub](https://github.com/mokoconsulting-tech/MokoCassiopeia)
- **Issue Tracker**: [GitHub Issues](https://github.com/mokoconsulting-tech/MokoCassiopeia/issues)

## Version Format

This project uses semantic versioning: `MAJOR.MINOR.PATCH`
- **MAJOR**: Incompatible API changes or major overhauls
- **MINOR**: New features, backwards-compatible
- **PATCH**: Bug fixes, backwards-compatible
