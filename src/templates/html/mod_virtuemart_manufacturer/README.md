# mod_virtuemart_manufacturer Mobile Responsive Override

## Overview
Mobile-responsive manufacturer display with grid/list layouts, logo images, and responsive card designs.

## Key Features
- Grid or list display modes
- Responsive manufacturer cards
- Logo/image display with aspect ratio control
- Manufacturer descriptions
- Hover effects and transitions

## Responsive Layouts

| Screen Size | Grid Mode | List Mode |
|------------|-----------|-----------|
| Mobile (< 576px) | 1 column | 1 column |
| Tablet (576px - 767px) | 2 columns | 1 column |
| Desktop (768px - 991px) | 3 columns | 1 column |
| Large Desktop (≥ 992px) | 4 columns | 1 column |

## Module Parameters Supported
- `show_images` - Display manufacturer logos
- `display_style` - Layout mode (list/grid)
- `moduleclass_sfx` - Custom CSS suffix

## CSS Classes
- `.mod-vm-manufacturer-responsive` - Main container
- `.mod-vm-manufacturer__container` - Grid/list container
- `.mod-vm-manufacturer__container--list` - List layout
- `.mod-vm-manufacturer__container--grid` - Grid layout
- `.mod-vm-manufacturer__item` - Manufacturer card
- `.mod-vm-manufacturer__link` - Clickable link
- `.mod-vm-manufacturer__image` - Logo container
- `.mod-vm-manufacturer__name` - Manufacturer name
- `.mod-vm-manufacturer__description` - Description text

## Customization Example
```css
.mod-vm-manufacturer__image {
  aspect-ratio: 1/1;
  border-radius: 50%;
}

.mod-vm-manufacturer__container--grid {
  gap: 2rem;
}
```

## Accessibility
- Proper link structure
- Title attributes on links
- Semantic HTML
- Keyboard navigation
- Focus indicators

## License
Copyright (C) 2025 Moko Consulting
GNU General Public License version 2 or later
