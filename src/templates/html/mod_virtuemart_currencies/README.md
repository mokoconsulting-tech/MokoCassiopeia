# mod_virtuemart_currencies Mobile Responsive Override

## Overview
Mobile-responsive currency selector with custom-styled dropdown, touch-friendly controls, and automatic form submission on change.

## Key Features
- Custom styled select dropdown with icon
- 16px font size on mobile (prevents iOS zoom)
- Auto-submit on currency change (JavaScript)
- Fallback submit button for no-JS users
- Full keyboard accessibility

## Responsive Features

| Screen Size | Input Height | Font Size |
|------------|--------------|-----------|
| Mobile (< 576px) | 48px | 16px |
| Desktop (≥ 768px) | 44px | 1rem |

## Module Parameters Supported
- `text_before` - Text displayed before selector
- `text_after` - Text displayed after selector
- `moduleclass_sfx` - Custom CSS suffix

## CSS Classes
- `.mod-vm-currencies-responsive` - Main container
- `.mod-vm-currencies__form` - Form element
- `.mod-vm-currencies__label` - Label text
- `.mod-vm-currencies__select-wrapper` - Select container
- `.mod-vm-currencies__select` - Dropdown element
- `.mod-vm-currencies__icon` - Chevron icon
- `.mod-vm-currencies__submit` - Submit button (no-JS)

## Customization Example
```css
.mod-vm-currencies__select {
  border-radius: 25px;
  padding: 0.75rem 3rem 0.75rem 1.5rem;
}
```

## Accessibility
- Proper label association
- ARIA labels for screen readers
- Keyboard navigation support
- Focus indicators

## License
Copyright (C) 2025 Moko Consulting
GNU General Public License version 2 or later
