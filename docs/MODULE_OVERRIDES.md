<!--
 Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 3 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with this program. If not, see <https://www.gnu.org/licenses/>.


 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Documentation
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 FILE: docs/MODULE_OVERRIDES.md
 VERSION: 03.08.03
 BRIEF: Comprehensive guide to MokoCassiopeia mobile-responsive module overrides
 PATH: /docs/MODULE_OVERRIDES.md
-->

# Module & Component Overrides — MokoCassiopeia

This document provides a comprehensive guide to all mobile-responsive module and component overrides included in MokoCassiopeia.

## Overview

MokoCassiopeia includes **16 mobile-responsive module overrides** and **12 component view overrides** designed to enhance the mobile user experience for third-party extensions and the Main Menu navigation.

**Important**: Following Cassiopeia template best practices, MokoCassiopeia avoids overriding standard Joomla core modules (such as mod_search, mod_login, mod_breadcrumbs) to ensure proper language loading and compatibility. **Exception**: mod_menu "Main Menu" override provides essential Bootstrap 5 collapsible dropdown functionality.

### Alternative Layouts, Not Replacements

**All MokoCassiopeia overrides use alternative layout names (`mobile.php`) instead of replacing default layouts (`default.php`).** This means:

- ✅ Default Joomla layouts continue to work unchanged
- ✅ You must explicitly select the "mobile" layout in module/menu item settings
- ✅ Joomla core updates don't break your site
- ✅ Full control over which modules use enhanced layouts

**📖 See [OVERRIDE_PHILOSOPHY.md](OVERRIDE_PHILOSOPHY.md) for complete details on how to activate and use these alternative layouts.**

### Key Features

All module overrides share these characteristics:

- **Mobile-First Design**: Optimized for mobile devices with responsive breakpoints
- **Touch Targets**: 48px on mobile, 44px on desktop (WCAG 2.1 compliant)
- **Input Font Size**: 16px minimum on mobile (prevents iOS zoom)
- **Accessibility**: Full ARIA labels, keyboard navigation, semantic HTML
- **BEM Naming**: Consistent CSS class naming convention
- **CSS Variables**: Integration with template color schemes
- **Security**: Proper escaping, _JEXEC checks, index.html protection
- **Documentation**: Each override includes comprehensive README

## Module Categories

### 1. VirtueMart E-Commerce Modules

Five comprehensive overrides for VirtueMart shopping functionality.

**Master Documentation**: [VIRTUEMART_MODULES_README.md](../src/html/VIRTUEMART_MODULES_README.md)

#### mod_virtuemart_cart
**Location**: `src/html/mod_virtuemart_cart/`

Shopping cart display with product list and checkout button.

**Features**:
- Responsive product cards
- Remove item buttons with confirmations
- Price display with currency formatting
- Checkout button with prominent styling

#### mod_virtuemart_product
**Location**: `src/html/mod_virtuemart_product/`

Product showcase with grid layouts.

**Features**:
- Responsive grid: 1-4 columns based on screen size
- Product images with hover effects
- Price display and "Add to Cart" buttons
- Rating display support

#### mod_virtuemart_currencies
**Location**: `src/html/mod_virtuemart_currencies/`

Currency selector dropdown for multi-currency stores.

**Features**:
- Accessible dropdown with proper labels
- Currency symbol and name display
- Responsive button styling

#### mod_virtuemart_category
**Location**: `src/html/mod_virtuemart_category/`

Category navigation with hierarchical display.

**Features**:
- Expandable subcategories
- Product count display
- Hierarchical indentation
- Active category highlighting

#### mod_virtuemart_manufacturer
**Location**: `src/html/mod_virtuemart_manufacturer/`

Manufacturer/brand display with grid layout.

**Features**:
- Responsive grid: 2-4 columns
- Logo display support
- Product count per manufacturer

---

### 2. Main Menu & Community Builder Modules

Three essential Community Builder and navigation module overrides.

#### mod_menu (Main Menu)
**Location**: `src/html/mod_menu/`

Bootstrap 5 responsive navigation menu with collapsible dropdown functionality.

**Files**:
- `mainmenu.php` - Main layout with Bootstrap navbar
- `mainmenu_component.php` - Component menu items
- `mainmenu_heading.php` - Heading menu items
- `mainmenu_separator.php` - Separator menu items
- `mainmenu_url.php` - URL menu items

**Features**:
- Bootstrap 5 navbar structure with collapsible hamburger menu
- Multi-level dropdown support (hover on desktop, tap on mobile)
- WCAG 2.1 compliant touch targets (48px mobile, 44px desktop)
- BEM naming convention: `.mod-menu-main__*`
- Active state indicators for current menu items
- ARIA labels and keyboard navigation support
- Alternative layout named `mainmenu.php` (not `default.php`)

**Activation**: Select "Mainmenu" layout in Joomla Administrator → Modules → Menu Module → Advanced Tab → Alternative Layout

**Note**: Unlike the broken mod_menu override removed in v03.08.01, this v03.08.03 version is properly structured based on Joomla core layouts and Bootstrap 5, ensuring language strings load correctly and menu functionality works as expected.

#### mod_cblogin
**Location**: `src/html/mod_cblogin/`

Community Builder login with avatar display.

**Features**:
- User avatar when logged in
- CB-specific login form
- Profile link
- Logout button

#### mod_comprofilerOnline
**Location**: `src/html/mod_comprofilerOnline/`

Community Builder online users display.

**Features**:
- User count display
- Avatar grid layout
- Username display
- Online status indicators

---

### 3. Industry Extension Modules

Eight popular third-party extension module overrides plus component views.

#### K2 Content Extension

##### mod_k2_content
**Location**: `src/html/mod_k2_content/`

K2 content display with advanced layouts.

**Features**:
- Responsive grid: 1-3 columns
- Featured images with lazy loading
- Category, author, date metadata
- Excerpt support
- Tag display

#### AcyMailing Newsletter

##### mod_acymailing
**Location**: `src/html/mod_acymailing/`

Newsletter subscription form.

**Features**:
- Email validation
- Privacy checkbox
- Success/error messaging
- GDPR compliance fields

#### HikaShop E-Commerce

##### mod_hikashop_cart
**Location**: `src/html/mod_hikashop_cart/`

HikaShop shopping cart module.

**Features**:
- Product list with images
- Quantity adjustment
- Price totals
- Checkout button

#### Kunena Forum

Four comprehensive forum modules plus component view.

##### mod_kunenalatest
**Location**: `src/html/mod_kunenalatest/`

Latest forum posts display.

**Features**:
- Post excerpts
- Author avatars
- Reply count
- Post date

##### mod_kunenalogin
**Location**: `src/html/mod_kunenalogin/`

Forum-specific login module.

**Features**:
- User avatar display
- Forum statistics
- Quick login form
- Profile link

##### mod_kunenasearch
**Location**: `src/html/mod_kunenasearch/`

Forum search with button positions.

**Features**:
- Multiple button positions (left, right, top)
- Search placeholder text
- Icon support
- 48px touch targets

##### mod_kunenastats
**Location**: `src/html/mod_kunenastats/`

Forum statistics display.

**Features**:
- Visual stat cards
- Member count
- Topic/post totals
- Latest member
- Responsive grid layout

##### com_kunena (Component)
**Location**: `src/html/com_kunena/`

Forum category list view.

**Views**:
- `category/default.php` - Category listing with icons

#### OS Membership Pro

Module and component overrides for membership management.

##### mod_osmembership
**Location**: `src/html/mod_osmembership/`

Membership plans module.

**Features**:
- Plan cards with pricing
- Feature lists
- Signup buttons
- Badge displays (popular, featured)

##### com_osmembership (Component)
**Location**: `src/html/com_osmembership/`

Membership pricing tables.

**Views**:
- `plans/default.php` - Responsive pricing table with comparison features

---

### 4. Community Builder Components

Four comprehensive component view overrides for Community Builder user management.

#### com_comprofiler
**Location**: `src/html/com_comprofiler/`

Mobile-responsive views for Community Builder user profiles, registration, and login.

##### userprofile
User profile display with tabbed interface.

**Features**:
- Large avatar display (150px)
- Tabbed interface for profile sections
- Custom field display with labels
- Online status indicator
- Responsive layout: vertical mobile → horizontal desktop

##### userslist
User directory with search and grid layout.

**Features**:
- Search functionality with accessible form
- Responsive grid: 1 column mobile → 2-3 columns desktop
- User cards with avatars (80px)
- Custom field display
- Profile view buttons
- Pagination support

##### registers
Multi-step registration form with validation.

**Features**:
- Fieldset organization with legends
- Required field indicators (*)
- Input validation and error display
- Captcha support section
- Terms & conditions checkbox
- GDPR-compliant design
- 16px input font on mobile

##### login
Login page with remember me and helper links.

**Features**:
- Centered login container (max-width: 450px)
- Username/password fields with autocomplete
- Remember me checkbox
- Registration and password recovery links
- CSRF token support
- Responsive padding adjustments

### 5. JEM (Joomla Event Manager) Components

Five comprehensive component view overrides for JEM event management.

#### com_jem
**Location**: `src/html/com_jem/`

Mobile-responsive views for JEM event listings, details, calendar, venues, and categories.

##### eventslist
Event listing with card-based layout.

**Features**:
- Event cards with date, time, and venue
- Category badges with color coding
- Responsive event grid layout
- Event description excerpts
- Read more buttons with clear calls-to-action
- Pagination support
- Empty state messaging

##### event
Single event details view with comprehensive information.

**Features**:
- Large event image display (responsive)
- Date and time with structured data
- Venue information with maps link
- Event description with full content
- Category display with badges
- Registration information (if enabled)
- Contact information display
- Back to events navigation
- Meta information with icons

##### calendar
Monthly calendar view with event indicators.

**Features**:
- Month navigation (previous/next)
- Calendar grid with weekday headers
- Event indicators on dates with events
- Responsive calendar layout
- Today highlighting
- Event list for selected month
- Event count per day display
- Touch-friendly navigation buttons

##### venue
Venue details with location and upcoming events.

**Features**:
- Venue image display
- Complete address information
- Website link (external)
- Google Maps integration
- Venue description
- Upcoming events at venue
- Location coordinates display
- Back navigation

##### categories
Event category listing with descriptions.

**Features**:
- Category cards with images
- Category descriptions
- Event count per category
- View category buttons
- Responsive grid layout
- Empty state messaging
- Pagination support

---

## CSS Architecture

All module styles are located in `src/media/css/template.css` with dedicated sections:

### CSS Sections

1. **MOD_SEARCH MOBILE RESPONSIVE STYLES** (Lines ~18400+)
   - Search box layouts
   - Button position variants
   - Input styling

2. **VIRTUEMART MODULE MOBILE RESPONSIVE STYLES** (Lines ~18500+)
   - Cart product cards
   - Product grids
   - Currency selector
   - Category navigation
   - Manufacturer displays

3. **STANDARD JOOMLA & COMMUNITY BUILDER MODULE STYLES** (Lines ~19300+)
   - Menu navigation
   - Breadcrumbs
   - Login forms
   - Article displays
   - CB module components

4. **INDUSTRY EXTENSION MODULE STYLES** (Lines ~19800+)
   - K2 content grids
   - AcyMailing forms
   - HikaShop cart
   - Kunena forum modules
   - OS Membership pricing

5. **COMMUNITY BUILDER COMPONENT STYLES** (Lines ~21000+)
   - User profile layouts
   - Users list grids
   - Registration forms
   - Login pages
   - Tab interfaces

6. **JEM COMPONENT STYLES** (Lines ~22000+)
   - Event list cards
   - Event details layout
   - Calendar grid
   - Venue information
   - Category displays

### CSS Variables Integration

All modules integrate with template CSS variables:

```css
/* Common Variables Used */
--body-color              /* Text color */
--link-color              /* Link color */
--link-hover-color        /* Link hover color */
--border-color            /* Border color */
--secondary-bg            /* Background color */
--border-radius           /* Border radius */
--input-bg                /* Input background */
--input-border-color      /* Input border */
--btn-primary-bg          /* Primary button */
--btn-primary-hover-bg    /* Button hover */
```

See [CSS_VARIABLES.md](CSS_VARIABLES.md) for complete reference.

---

## Responsive Breakpoints

All modules use Bootstrap-aligned breakpoints:

| Breakpoint | Size      | Typical Changes                    |
|------------|-----------|-----------------------------------|
| `xs`       | < 576px   | Single column, stacked layouts    |
| `sm`       | ≥ 576px   | 2 columns for grids               |
| `md`       | ≥ 768px   | 3 columns, horizontal layouts     |
| `lg`       | ≥ 992px   | 4 columns, expanded spacing       |
| `xl`       | ≥ 1200px  | Maximum width, optimal spacing    |
| `xxl`      | ≥ 1400px  | Extra spacing                     |

---

## Accessibility Features

All overrides implement comprehensive accessibility:

### ARIA Labels
- Descriptive labels for all interactive elements
- `aria-label` for icon-only buttons
- `aria-describedby` for form fields
- `aria-live` for dynamic content

### Keyboard Navigation
- Proper tab order
- Focus states on all interactive elements
- Keyboard-accessible dropdowns
- Skip links where appropriate

### Screen Readers
- Semantic HTML5 elements
- Hidden text for icon-only elements
- Proper heading hierarchy
- Alternative text for images

### WCAG 2.1 Compliance
- Touch targets: 48px minimum on mobile
- Color contrast ratios meet AA standards
- Text resizable to 200% without loss
- No content relies on color alone

---

## Customization Guide

### Override Customization

Each module can be customized in two ways:

#### 1. CSS Customization

Edit `src/media/css/user.css` to add custom styles:

```css
/* Example: Change product grid columns */
@media (min-width: 768px) {
	.mod-vm-product__grid {
		grid-template-columns: repeat(3, 1fr);
	}
}

/* Example: Customize cart button */
.mod-vm-cart__checkout-button {
	background-color: #28a745;
}
```

#### 2. Template Override Customization

Copy the entire module directory and modify:

```bash
# Keep original override as reference
cp -r src/html/mod_virtuemart_cart src/html/mod_virtuemart_cart_original

# Modify your version
# Edit src/html/mod_virtuemart_cart/default.php
```

### CSS Variables Override

Override CSS variables in your custom color scheme:

```css
/* src/media/css/colors/light/colors_custom.css */
:root {
	--vm-price-color: #28a745;
	--vm-cart-bg: #f8f9fa;
	--vm-button-primary: #007bff;
}
```

---

## Best Practices

### When Using Overrides

1. **Test Across Devices**: Always test on actual mobile devices
2. **Maintain Accessibility**: Don't remove ARIA labels or keyboard navigation
3. **Keep BEM Naming**: Use established class naming patterns
4. **Security First**: Always escape output and validate input
5. **Document Changes**: Comment your customizations

### When Updating

1. **Backup First**: Always backup your site before updating
2. **Review Changes**: Check CHANGELOG.md for breaking changes
3. **Test Thoroughly**: Test all modules after updates
4. **Custom Overrides**: May need adjustments after template updates

---

## Troubleshooting

### Common Issues

#### Module Not Displaying Correctly
1. Clear Joomla cache (System → Clear Cache)
2. Check module is published and assigned to correct position
3. Verify template is assigned to menu items
4. Check browser console for JavaScript errors

#### Styles Not Applying
1. Clear browser cache (Ctrl+F5 / Cmd+Shift+R)
2. Verify `template.css` is loading
3. Check CSS specificity conflicts
4. Review custom CSS in `user.css`

#### Mobile View Issues
1. Test with browser dev tools responsive mode
2. Check viewport meta tag in template
3. Verify breakpoint media queries
4. Test on actual devices when possible

#### Accessibility Issues
1. Run WAVE or axe DevTools accessibility check
2. Test with keyboard navigation only
3. Verify screen reader compatibility
4. Check color contrast ratios

### Getting Help

- **Documentation**: Check module-specific README files
- **GitHub Issues**: [Report issues](https://github.com/mokoconsulting-tech/MokoCassiopeia/issues)
- **Support**: hello@mokoconsulting.tech

---

## How to Activate Alternative Layouts

All MokoCassiopeia overrides are **alternative layouts** that must be explicitly activated. They do not automatically replace default layouts.

### Quick Start: Enable Mobile Layout

1. **Go to Joomla Administrator** → Extensions → Modules
2. **Open the module** you want to enhance (e.g., VirtueMart Cart)
3. **Navigate to Advanced tab**
4. **Find "Alternative Layout" field**
5. **Select "MokoCassiopeia - mobile"** from dropdown
6. **Save & Close**

### For Menu Items (Component Views)

1. **Go to Menus** → Select your menu
2. **Open the menu item** (e.g., Events List)
3. **Navigate to Advanced Options or Page Display tab**
4. **Find "Alternative Layout" field**
5. **Select "MokoCassiopeia - mobile"** from dropdown
6. **Save & Close**

### Apply to All Modules in a Position

In your template's `index.php`, specify layout for entire module position:

```php
<jdoc:include type="modules" name="sidebar-left" style="none" layout="mobile" />
```

**📖 For complete documentation, see [OVERRIDE_PHILOSOPHY.md](OVERRIDE_PHILOSOPHY.md)**

---

## Version History

| Version  | Date       | Changes                                           |
|----------|------------|--------------------------------------------------|
| 03.08.04 | 2026-02-27 | Added alternative layout activation instructions, JEM overrides |
| 03.08.03 | 2026-02-25 | Removed mod_search override per Cassiopeia philosophy |
| 03.08.00 | 2026-02-22 | Added Community Builder component overrides       |
| 03.07.00 | 2026-02-22 | Initial release of all mobile-responsive overrides |

---

## Additional Resources

- **Override Philosophy**: [OVERRIDE_PHILOSOPHY.md](OVERRIDE_PHILOSOPHY.md) ⭐ **Start here**
- **Main README**: [README.md](../README.md)
- **Changelog**: [CHANGELOG.md](../CHANGELOG.md)
- **CSS Variables**: [CSS_VARIABLES.md](CSS_VARIABLES.md)
- **Repository**: [GitHub](https://github.com/mokoconsulting-tech/MokoCassiopeia)

---

## Metadata

* Document: docs/MODULE_OVERRIDES.md
* Repository: [https://github.com/mokoconsulting-tech/MokoCassiopeia](https://github.com/mokoconsulting-tech/MokoCassiopeia)
* Path: /docs/MODULE_OVERRIDES.md
* Owner: Moko Consulting
* Version: 03.07.00
* Status: Active
* Effective Date: 2026-02-22
* Classification: Public Open Source Documentation

## Revision History

| Date       | Change Summary                                        | Author          |
| ---------- | ----------------------------------------------------- | --------------- |
| 2026-02-22 | Initial creation with comprehensive module override documentation | GitHub Copilot |
