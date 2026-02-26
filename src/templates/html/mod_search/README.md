# mod_search Mobile Responsive Override

## Overview
This directory contains a mobile-responsive override for Joomla's `mod_search` module, designed specifically for the MokoCassiopeia template.

## Features

### Mobile Responsiveness
- **Flexible Layout**: Adapts to different screen sizes automatically
- **Touch-Friendly**: Minimum 44px touch targets (48px on mobile)
- **Readable Text**: 16px font size on mobile to prevent auto-zoom on iOS
- **Proper Spacing**: Adequate padding and gaps for easy interaction

### Responsive Breakpoints
- **Mobile (< 576px)**: Stacked layout, full-width buttons, larger touch targets
- **Tablet (576px - 767px)**: Inline search field and button
- **Desktop (≥ 768px)**: Optimized horizontal layout

### Button Position Support
The override supports all standard mod_search button positions:
- **Left**: Search button appears to the left of input field
- **Right**: Search button appears to the right of input field (default)
- **Top**: Search button appears above input field
- **Bottom**: Search button appears below input field

### Icon Button Support
Supports both text and icon-only search buttons:
- Text buttons display customizable button text
- Icon buttons show search icon (icon-search)

## Files

### default.php
The main template override file that renders the search module with responsive HTML structure.

**Key Classes:**
- `.mod-search-responsive`: Main wrapper class
- `.mod-search__form`: Form container with flex layout
- `.mod-search__input-wrapper`: Input field wrapper
- `.mod-search__input`: Search input field
- `.mod-search__button`: Search button
- `.mod-search__button--icon`: Icon-only button variant

## CSS Styling

The mobile-responsive styles are defined in `/src/media/css/template.css` under the section:
```
/* ===== MOD_SEARCH MOBILE RESPONSIVE STYLES ===== */
```

### Key CSS Features:
1. **Flexbox Layout**: Uses modern flexbox for flexible, responsive layouts
2. **CSS Variables**: Integrates with template's color scheme system
3. **Mobile-First**: Base styles target mobile, with progressive enhancement
4. **Accessible**: Proper focus states and ARIA labels
5. **Touch-Optimized**: Appropriate sizing for touch interaction

## Usage

This override is automatically used when:
1. The MokoCassiopeia template is active
2. A mod_search module is published on the site

No additional configuration is required beyond standard mod_search module settings.

## Module Parameters

All standard mod_search parameters are supported:
- **Width**: Input field width (in characters) - note: overridden by responsive CSS
- **Button Text**: Custom text for the search button
- **Button Position**: left, right, top, or bottom
- **Image Button**: Use icon instead of text button
- **Max Length**: Maximum search query length
- **Menu Item**: Target search results page

## Accessibility Features

- Hidden label for screen readers
- ARIA labels on input and button
- Proper focus indicators
- Semantic HTML structure
- Keyboard navigation support

## Browser Support

- Modern browsers with flexbox support
- Responsive on all device sizes
- Works with iOS Safari (no auto-zoom on input focus)
- Compatible with touch and mouse input

## Customization

To customize the appearance, you can:
1. Override CSS variables in `user.css`
2. Modify classes in `default.php` 
3. Add custom styles targeting `.mod-search-responsive`

Example custom CSS:
```css
.mod-search-responsive {
  max-width: 600px;
  margin: 0 auto;
}

.mod-search__input {
  border-radius: 25px;
}

.mod-search__button {
  border-radius: 25px;
}
```

## Testing

The override has been designed to work across:
- Mobile devices (320px+)
- Tablets (768px+)
- Desktop screens (1200px+)
- Touch and click interactions
- Portrait and landscape orientations

## License

Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
Licensed under GNU General Public License version 2 or later
