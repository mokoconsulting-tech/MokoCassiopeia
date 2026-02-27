# Standard Joomla & Community Builder Module Mobile Responsive Overrides

## Overview
This directory contains mobile-responsive overrides for Community Builder modules, designed specifically for the MokoCassiopeia template.

**Important**: Following Cassiopeia template best practices, standard Joomla core modules (mod_breadcrumbs, mod_login, mod_articles_latest, mod_menu) are NOT overridden. These use Joomla's default layouts to ensure proper language loading and compatibility. Apply custom styling via CSS.

## Community Builder Modules

### 1. mod_cblogin
Community Builder login module with:
- Avatar display in logged-in state
- Profile link button
- Touch-friendly form controls
- Remember me checkbox
- Password/username recovery links
- Registration link
- Pre/post text support

### 2. mod_comprofilerOnline
Community Builder online users module featuring:
- Online user count display
- Members vs. guests breakdown
- User list with avatars
- Profile links
- Online status indicators
- Responsive card layouts

## Mobile Responsive Features

### Touch Target Sizes (WCAG 2.1 Compliant)
- **Mobile (< 576px):** 48px minimum height
- **Desktop (≥ 768px):** 44px minimum height

### Font Sizes (iOS Zoom Prevention)
- **Mobile:** 16px base font for inputs (prevents auto-zoom)
- **Desktop:** 1rem (16px typically)

### Responsive Breakpoints
Using Bootstrap-aligned breakpoints:
- `< 576px` - Mobile (xs)
- `576px - 767px` - Tablet (sm-md)
- `768px+` - Desktop (md+)

### Layout Adaptations

#### Mobile (< 576px)
- Stacked form layouts
- Full-width buttons
- Larger touch targets (48px)
- 16px input font size
- Vertical link lists

#### Tablet & Desktop (≥ 768px)
- Inline button layouts where appropriate
- Horizontal action groups
- Enhanced hover effects
- Optimized spacing

## CSS Architecture

### BEM Naming Convention
All modules use Block-Element-Modifier naming:

```css
.mod-login                      /* Block */
.mod-login__input               /* Element */
.mod-login__btn--submit         /* Modifier */
```

### CSS Variables Integration
Styles integrate with template's color system:

```css
--body-color
--link-color
--link-hover-color
--color-primary
--secondary-bg
--border-color
--border-radius
--gray-600
--success
```

## Accessibility Features

All modules include:
- ✅ Semantic HTML5 elements
- ✅ ARIA labels and landmarks
- ✅ Proper form labeling
- ✅ Keyboard navigation support
- ✅ Screen reader friendly
- ✅ Focus indicators
- ✅ Touch-optimized controls
- ✅ Schema.org structured data (where applicable)

## Browser Compatibility

- ✅ Modern browsers (Chrome, Firefox, Safari, Edge)
- ✅ iOS Safari (no zoom on input focus)
- ✅ Android browsers
- ✅ Touch and mouse input
- ✅ All screen sizes (320px+)
- ✅ Portrait and landscape orientations

## File Structure

```
src/templates/html/
├── mod_breadcrumbs/
│   ├── default.php
│   └── index.html
├── mod_login/
│   ├── default.php
│   └── index.html
├── mod_articles_latest/
│   ├── default.php
│   └── index.html
├── mod_cblogin/
│   ├── default.php
│   └── index.html
└── mod_comprofilerOnline/
    ├── default.php
    └── index.html
```

## Usage

These overrides are automatically used when:
1. The MokoCassiopeia template is active
2. The respective modules are published
3. No additional configuration required beyond standard module settings

## Module Parameters

All standard Joomla and Community Builder module parameters are fully supported. Each override respects the module's configuration options.

## Customization

### Override CSS Variables
```css
:root {
  --border-radius: 0.5rem;
  --color-primary: #your-color;
}
```

### Add Custom Styles
```css
.mod-login-responsive {
  max-width: 400px;
  margin: 0 auto;
}
```

### Modify Templates
Each PHP file can be modified to adjust HTML structure while maintaining mobile responsiveness.

## Security

- ✅ index.html security files in all directories
- ✅ Proper input escaping with `htmlspecialchars()`
- ✅ XSS prevention
- ✅ Joomla security best practices (`_JEXEC` check)
- ✅ Form token validation

## Testing Checklist

### General Testing
- [ ] Test on mobile device (< 576px)
- [ ] Test on tablet (576px - 767px)
- [ ] Test on desktop (≥ 768px)
- [ ] Verify touch targets are adequate
- [ ] Test with screen reader
- [ ] Check keyboard navigation
- [ ] Verify ARIA labels

### Module-Specific Testing
- [ ] mod_breadcrumbs: Test breadcrumb trail on nested pages
- [ ] mod_breadcrumbs: Verify breadcrumb trail accuracy
- [ ] mod_login: Test login/logout flows, 2FA
- [ ] mod_articles_latest: Check various parameter combinations
- [ ] mod_cblogin: Test CB login/logout with avatar
- [ ] mod_comprofilerOnline: Verify user list display

## Documentation

Each module follows the same pattern established by:
- mod_search override
- VirtueMart module overrides
- Comprehensive documentation
- BEM naming convention
- Mobile-first responsive design

## Related Documentation

- `VIRTUEMART_MODULES_README.md` - VirtueMart module overrides
- `docs/CSS_VARIABLES.md` - Complete CSS variables reference
- `docs/ROADMAP.md` - Template development roadmap

## License

Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
Licensed under GNU General Public License version 2 or later

## Support

For issues or questions:
- Review module-specific parameters
- Check CSS variables documentation
- Consult Joomla and Community Builder documentation
- Verify module configuration in Joomla admin
