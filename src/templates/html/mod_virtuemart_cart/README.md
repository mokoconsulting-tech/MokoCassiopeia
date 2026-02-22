# mod_virtuemart_cart Mobile Responsive Override

## Overview
Mobile-responsive override for VirtueMart's shopping cart module (`mod_virtuemart_cart`), designed for the MokoCassiopeia template.

## Features

### Cart Display
- **Cart Summary Header**: Shows item count and total price
- **Product List**: Displays cart items with images, names, quantities, and prices
- **Remove Buttons**: Touch-friendly delete buttons for each item
- **Action Buttons**: View cart and checkout buttons
- **Empty State**: Friendly message when cart is empty

### Mobile Responsiveness
- **Touch Targets**: 48px on mobile, 44px on desktop (WCAG compliant)
- **Flexible Layout**: Adapts to different screen sizes
- **Stacked Layout**: Products stack vertically on mobile
- **Full-Width Actions**: Buttons expand to full width on small screens

### Responsive Breakpoints

#### Mobile (< 576px)
- Vertical product layout
- Full-width product images (max 200px centered)
- Stacked action buttons
- 48px minimum touch targets
- Increased padding for comfortable touch

#### Tablet (576px - 767px)
- Side-by-side product details
- Inline action buttons begin to appear
- 44px touch targets

#### Desktop (≥ 768px)
- Horizontal action button layout
- Optimized spacing and alignment
- Enhanced hover effects

## Module Parameters

All standard mod_virtuemart_cart parameters are supported:

- **show_price**: Display product prices (default: Yes)
- **show_product_list**: Display list of products in cart (default: Yes)
- **moduleclass_sfx**: Custom CSS class suffix

## HTML Structure

```
.mod-vm-cart-responsive
  ├── .mod-vm-cart__header (if items in cart)
  │   ├── .mod-vm-cart__icon
  │   └── .mod-vm-cart__summary
  │       ├── .mod-vm-cart__count
  │       └── .mod-vm-cart__total
  ├── .mod-vm-cart__products (if show_product_list)
  │   └── .mod-vm-cart__product (foreach product)
  │       ├── .mod-vm-cart__product-image
  │       ├── .mod-vm-cart__product-details
  │       │   ├── .mod-vm-cart__product-name
  │       │   ├── .mod-vm-cart__product-quantity
  │       │   └── .mod-vm-cart__product-price
  │       └── .mod-vm-cart__product-remove
  └── .mod-vm-cart__actions
      ├── .mod-vm-cart__btn--view
      └── .mod-vm-cart__btn--checkout
```

## CSS Classes

### Main Container
- `.mod-vm-cart-responsive` - Main wrapper with responsive styles

### Header Section
- `.mod-vm-cart__header` - Cart summary container
- `.mod-vm-cart__icon` - Shopping basket icon
- `.mod-vm-cart__summary` - Summary information wrapper
- `.mod-vm-cart__count` - Number of items
- `.mod-vm-cart__total` - Total price display

### Product List
- `.mod-vm-cart__products` - Products container
- `.mod-vm-cart__product` - Individual product card
- `.mod-vm-cart__product-image` - Product image container
- `.mod-vm-cart__product-details` - Product information
- `.mod-vm-cart__product-name` - Product title
- `.mod-vm-cart__product-quantity` - Quantity display
- `.mod-vm-cart__product-price` - Price display
- `.mod-vm-cart__product-remove` - Remove button container
- `.mod-vm-cart__remove-btn` - Delete button

### Actions
- `.mod-vm-cart__actions` - Action buttons container
- `.mod-vm-cart__btn` - Base button class
- `.mod-vm-cart__btn--view` - View cart button
- `.mod-vm-cart__btn--checkout` - Checkout button

### Empty State
- `.mod-vm-cart__empty` - Empty cart container
- `.mod-vm-cart__empty-icon` - Empty state icon
- `.mod-vm-cart__empty-text` - Empty state message

## CSS Variables Used

```css
--vm-surface               /* Background colors */
--vm-surface-2             /* Alternative background */
--vm-text                  /* Main text color */
--vm-text-strong           /* Strong emphasis text */
--vm-text-muted            /* Muted/secondary text */
--vm-border                /* Border colors */
--vm-price-color           /* Price display color */
--vm-block-radius          /* Border radius */
--vm-block-shadow          /* Box shadow */
--vm-btn-primary-bg        /* Primary button background */
--vm-btn-primary-text      /* Primary button text */
--vm-btn-padding-y         /* Button vertical padding */
--vm-btn-padding-x         /* Button horizontal padding */
--vm-btn-radius            /* Button border radius */
--danger                   /* Delete button color */
```

## Accessibility Features

- ✅ ARIA label on remove buttons with product name
- ✅ Proper semantic HTML structure
- ✅ Icon elements marked with `aria-hidden="true"`
- ✅ Keyboard navigation support
- ✅ Focus indicators on interactive elements
- ✅ Touch-friendly target sizes
- ✅ Color contrast compliance

## Customization Examples

### Adjust Cart Width
```css
.mod-vm-cart-responsive {
  max-width: 400px;
  margin: 0 auto;
}
```

### Customize Product Card Spacing
```css
.mod-vm-cart__products {
  gap: 1.5rem;
}
```

### Change Button Layout
```css
@media (min-width: 768px) {
  .mod-vm-cart__actions {
    flex-direction: column;
    gap: 1rem;
  }
}
```

### Style Empty State
```css
.mod-vm-cart__empty {
  padding: 3rem 1.5rem;
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
```

## Integration with VirtueMart

This override works seamlessly with:
- VirtueMart 3.x and 4.x
- Standard VirtueMart cart functionality
- AJAX cart updates (if configured)
- Multiple currency support
- Tax calculations

## Browser Compatibility

- ✅ Modern browsers (Chrome, Firefox, Safari, Edge)
- ✅ iOS Safari (no zoom on input/button touch)
- ✅ Android Chrome
- ✅ Touch and mouse input
- ✅ All screen sizes from 320px+

## Testing Checklist

- [ ] Add products to cart
- [ ] Verify item count updates
- [ ] Test remove button functionality
- [ ] Check price calculations
- [ ] Verify cart view link works
- [ ] Test checkout button redirect
- [ ] Check empty cart state
- [ ] Test on mobile device (< 576px)
- [ ] Test on tablet (576px - 767px)
- [ ] Test on desktop (≥ 768px)
- [ ] Verify touch targets are adequate
- [ ] Test with screen reader
- [ ] Check keyboard navigation

## License

Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
Licensed under GNU General Public License version 2 or later
