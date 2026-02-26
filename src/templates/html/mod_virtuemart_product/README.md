# mod_virtuemart_product Mobile Responsive Override

## Overview
Mobile-responsive override for VirtueMart's product display module featuring grid/list layouts, responsive product cards, and touch-friendly controls.

## Key Features
- Responsive grid layout (1-4 columns based on screen size)
- Product card with image, title, description, price
- Touch-friendly action buttons (48px mobile, 44px desktop)
- Availability badges
- Add to cart functionality

## Responsive Layouts

| Screen Size | Grid Columns |
|------------|--------------|
| Mobile (< 576px) | 1 column |
| Tablet (576px - 767px) | 2 columns |
| Desktop (768px - 991px) | 3 columns |
| Large Desktop (≥ 992px) | 4 columns |

## Module Parameters Supported
- `headerText` - Header text above products
- `display_style` - Layout style (div, list)
- `moduleclass_sfx` - Custom CSS suffix

## CSS Classes
- `.mod-vm-product-responsive` - Main container
- `.mod-vm-product__list` - Products grid
- `.mod-vm-product__item` - Product card
- `.mod-vm-product__image` - Product image
- `.mod-vm-product__title` - Product name
- `.mod-vm-product__description` - Short description
- `.mod-vm-product__price` - Price display
- `.mod-vm-product__actions` - Action buttons

## Customization Example
```css
.mod-vm-product__list {
  gap: 2rem;
}

.mod-vm-product__item {
  border-radius: 1rem;
}
```

## License
Copyright (C) 2025 Moko Consulting
GNU General Public License version 2 or later
