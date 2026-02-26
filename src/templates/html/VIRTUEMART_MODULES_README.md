# VirtueMart Module Mobile Responsive Overrides

## Overview
This directory contains mobile-responsive overrides for VirtueMart e-commerce modules, designed specifically for the MokoCassiopeia template.

## Modules Included

### 1. mod_virtuemart_cart
Shopping cart display module with:
- Responsive product list with images
- Touch-friendly remove buttons
- Mobile-optimized cart summary
- Flexible action buttons layout

### 2. mod_virtuemart_product
Product display module featuring:
- Grid/list layout options
- Responsive product cards
- Mobile-optimized images
- Touch-friendly action buttons

### 3. mod_virtuemart_currencies
Currency selector module with:
- Custom styled select dropdown
- Mobile-friendly touch targets
- Accessible form controls
- Icon indicators

### 4. mod_virtuemart_category
Category navigation module offering:
- Hierarchical category display
- Optional product counts
- Image support for categories
- Active state highlighting

### 5. mod_virtuemart_manufacturer
Manufacturer display module with:
- Grid and list display modes
- Logo/image display
- Responsive card layouts
- Hover effects

## Mobile Responsive Features

### Touch Targets
- **Mobile (< 576px):** 48px minimum height
- **Desktop (≥ 768px):** 44px minimum height
- WCAG 2.1 AA compliant

### Font Sizes
- **Mobile:** 16px base (prevents iOS auto-zoom)
- **Desktop:** 1rem (16px typically)

### Responsive Breakpoints
Using Bootstrap-aligned breakpoints:
- `< 576px` - Mobile (xs)
- `576px` - Small (sm)
- `768px` - Medium (md)
- `992px` - Large (lg)
- `1200px` - Extra Large (xl)
- `1400px` - Extra Extra Large (xxl)

### Layout Adaptations

#### Mobile (< 576px)
- Single column layouts
- Stacked action buttons
- Full-width elements
- Larger touch targets (48px)

#### Tablet (576px - 767px)
- 2-column grids for products/manufacturers
- Inline action buttons where appropriate
- 44px touch targets

#### Desktop (≥ 768px)
- 3-4 column grids
- Horizontal button layouts
- Optimized spacing
- Enhanced hover effects

## CSS Architecture

### CSS Variables Integration
All styles integrate with template's VirtueMart CSS variables:

```css
/* Surfaces & Colors */
--vm-surface
--vm-surface-2
--vm-text
--vm-text-strong
--vm-text-muted
--vm-border
--vm-price-color

/* Layout */
--vm-block-radius
--vm-block-shadow
--vm-section-gap

/* Buttons */
--vm-btn-primary-bg
--vm-btn-primary-text
--vm-btn-secondary-bg
--vm-btn-secondary-text
```

### BEM Naming Convention
All modules use Block-Element-Modifier naming:

```css
.mod-vm-cart                    /* Block */
.mod-vm-cart__header            /* Element */
.mod-vm-cart__item--active      /* Modifier */
```

## Accessibility Features

All modules include:
- ✅ ARIA labels on interactive elements
- ✅ Semantic HTML5 structure
- ✅ Proper heading hierarchy
- ✅ Keyboard navigation support
- ✅ Screen reader friendly
- ✅ Focus indicators
- ✅ Touch-optimized controls

## Browser Compatibility

- ✅ Modern browsers with flexbox/grid support
- ✅ iOS Safari (no auto-zoom issues)
- ✅ Android browsers
- ✅ Chrome, Firefox, Safari, Edge
- ✅ Responsive on all device sizes
- ✅ Touch and mouse input

## File Structure

```
src/templates/html/
├── mod_virtuemart_cart/
│   ├── default.php
│   ├── index.html
│   └── README.md
├── mod_virtuemart_product/
│   ├── default.php
│   ├── index.html
│   └── README.md
├── mod_virtuemart_currencies/
│   ├── default.php
│   ├── index.html
│   └── README.md
├── mod_virtuemart_category/
│   ├── default.php
│   ├── index.html
│   └── README.md
└── mod_virtuemart_manufacturer/
    ├── default.php
    ├── index.html
    └── README.md
```

## Usage

These overrides are automatically used when:
1. The MokoCassiopeia template is active
2. VirtueMart is installed and configured
3. The respective modules are published

No additional configuration is required beyond standard VirtueMart module settings.

## Customization

To customize the appearance, you can:

1. **Override CSS variables** in `user.css`:
```css
:root {
  --vm-btn-primary-bg: #your-color;
  --vm-block-radius: 0.5rem;
}
```

2. **Add custom styles** targeting module classes:
```css
.mod-vm-cart-responsive {
  max-width: 400px;
}
```

3. **Modify PHP templates** in the respective module directories

## Testing

All overrides have been designed to work across:
- Mobile devices (320px+)
- Tablets (768px+)
- Desktop screens (1200px+)
- Touch and click interactions
- Portrait and landscape orientations

## Security

- ✅ index.html security files included
- ✅ Proper input escaping in PHP
- ✅ XSS prevention
- ✅ Follows Joomla security best practices

## Documentation

Each module directory contains a detailed README.md with:
- Module-specific features
- Configuration options
- Customization examples
- Usage guidelines

## License

Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
Licensed under GNU General Public License version 2 or later

## Support

For issues or questions:
- Check individual module README files
- Review CSS_VARIABLES.md for available CSS variables
- Consult VirtueMart and Joomla documentation
