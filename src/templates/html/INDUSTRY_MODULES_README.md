# Industry Extension Module Mobile Responsive Overrides

## Overview
This directory contains mobile-responsive overrides for popular industry Joomla extensions, designed specifically for the MokoCassiopeia template.

## Industry Extension Modules

### 1. mod_k2_content (K2)
K2 content display module featuring:
- Responsive article/content cards
- Optional images with hover effects
- Metadata display (author, date, category, hits)
- Introtext support
- Read more links
- Custom link support
- Touch-friendly interactions

### 2. mod_acymailing (AcyMailing)
AcyMailing newsletter subscription module with:
- Mobile-responsive form inputs
- Touch-friendly form controls (48px on mobile)
- 16px input font (prevents iOS zoom)
- Intro and outro text support
- Custom form styling that overrides inline styles
- Accessible form structure

### 3. mod_hikashop_cart (HikaShop)
HikaShop shopping cart module offering:
- Product list with images
- Cart summary with item count and total
- Touch-friendly remove buttons
- Mobile-optimized cart display
- Flexible action buttons layout
- Empty cart state

### 4. mod_kunenalatest (Kunena Forum)
Kunena latest posts module with:
- User avatars
- Post metadata (author, date, category, hits, replies)
- Post excerpts
- Forum navigation links
- Responsive card layouts
- Touch-friendly post links

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
- Stacked content layouts
- Full-width images
- Vertical metadata lists
- Larger touch targets (48px)
- Stacked action buttons

#### Desktop (≥ 768px)
- Horizontal layouts where appropriate
- Side-by-side image and content
- Inline metadata
- Enhanced hover effects
- Horizontal button groups

## CSS Architecture

### BEM Naming Convention
All modules use Block-Element-Modifier naming:

```css
.mod-k2-content                     /* Block */
.mod-k2-content__title              /* Element */
.mod-k2-content__item--featured     /* Modifier */
```

### CSS Variables Integration
Styles integrate with template's color system:

```css
--body-color
--link-color
--color-primary
--secondary-bg
--border-color
--border-radius
--gray-600
--success
--danger
```

## Accessibility Features

All modules include:
- ✅ Semantic HTML5 elements
- ✅ ARIA labels and landmarks
- ✅ Proper heading hierarchy
- ✅ Keyboard navigation support
- ✅ Screen reader friendly
- ✅ Focus indicators
- ✅ Touch-optimized controls
- ✅ Alternative text for images

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
├── mod_k2_content/
│   ├── default.php
│   └── index.html
├── mod_acymailing/
│   ├── default.php
│   └── index.html
├── mod_hikashop_cart/
│   ├── default.php
│   └── index.html
└── mod_kunenalatest/
    ├── default.php
    └── index.html
```

## Usage

These overrides are automatically used when:
1. The MokoCassiopeia template is active
2. The respective extensions are installed
3. The modules are published

No additional configuration required beyond standard module settings.

## Extension Parameters

All standard extension module parameters are fully supported. Each override respects the module's configuration options.

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
.mod-k2-content-responsive {
  max-width: 800px;
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
- ✅ No SQL injection vectors

## Extension Compatibility

### K2
- Compatible with K2 2.x and 3.x
- Supports all K2 module parameters
- Image handling for various sizes
- BBCode/HTML content support

### AcyMailing
- Compatible with AcyMailing 6.x+
- Form styling overrides inline styles
- Supports custom form layouts
- Newsletter list integration

### HikaShop
- Compatible with HikaShop 4.x and 5.x
- Product image display
- Price formatting support
- Tax calculations
- Cart operations via AJAX

### Kunena
- Compatible with Kunena 5.x and 6.x
- Avatar integration
- BBCode parsing
- Forum routing support
- User profile links

## Testing Checklist

### General Testing
- [ ] Test on mobile device (< 576px)
- [ ] Test on tablet (576px - 767px)
- [ ] Test on desktop (≥ 768px)
- [ ] Verify touch targets are adequate
- [ ] Test with screen reader
- [ ] Check keyboard navigation
- [ ] Verify ARIA labels

### Extension-Specific Testing
- [ ] K2: Test with/without images, various metadata options
- [ ] AcyMailing: Test form submission, validation
- [ ] HikaShop: Test add/remove items, cart update
- [ ] Kunena: Test avatar display, post links, forum navigation

## Documentation

Each module follows the same pattern established by:
- mod_search override
- VirtueMart module overrides
- Standard Joomla module overrides
- Mobile-first responsive design
- BEM naming convention

## Related Documentation

- `STANDARD_MODULES_README.md` - Standard Joomla module overrides
- `VIRTUEMART_MODULES_README.md` - VirtueMart module overrides
- `docs/CSS_VARIABLES.md` - Complete CSS variables reference
- `docs/ROADMAP.md` - Template development roadmap

## License

Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
Licensed under GNU General Public License version 2 or later

## Support

For issues or questions:
- Review extension-specific documentation
- Check CSS variables documentation
- Consult extension and Joomla documentation
- Verify module configuration in Joomla admin
- Check extension compatibility versions
