# mod_virtuemart_category Mobile Responsive Override

## Overview
Mobile-responsive category navigation with hierarchical structure, optional images, product counts, and active state highlighting.

## Key Features
- Hierarchical category/subcategory display
- Optional category images (40x40px)
- Product count badges
- Active page highlighting
- Touch-friendly links (48px mobile, 44px desktop)
- Collapsible subcategory lists

## Responsive Features
- Full-width category links on mobile
- Indented subcategory lists
- Active state styling
- Hover effects

## Module Parameters Supported
- `show_images` - Display category images
- `show_description` - Show category descriptions
- `show_product_count` - Display product counts
- `moduleclass_sfx` - Custom CSS suffix

## CSS Classes
- `.mod-vm-category-responsive` - Main container
- `.mod-vm-category__nav` - Navigation element
- `.mod-vm-category__list` - Main category list
- `.mod-vm-category__item` - Category item
- `.mod-vm-category__link` - Category link
- `.mod-vm-category__link--active` - Active category
- `.mod-vm-category__sublist` - Subcategory list
- `.mod-vm-category__sublink` - Subcategory link

## Customization Example
```css
.mod-vm-category__link {
  border-radius: 10px;
  padding: 1rem;
}

.mod-vm-category__image {
  width: 50px;
  height: 50px;
}
```

## Accessibility
- Semantic navigation element
- `aria-current="page"` on active items
- ARIA labels for navigation
- Keyboard navigation support

## License
Copyright (C) 2025 Moko Consulting
GNU General Public License version 2 or later
