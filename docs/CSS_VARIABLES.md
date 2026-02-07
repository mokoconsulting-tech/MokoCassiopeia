<!--
 Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later

 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Documentation
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 FILE: docs/CSS_VARIABLES.md
 VERSION: 03.06.03
 BRIEF: Complete CSS variable reference for MokoCassiopeia template
-->

# CSS Variables Reference - MokoCassiopeia

This document provides a complete reference of all CSS variables available in the MokoCassiopeia template for customization.

## Table of Contents

- [Using Custom Color Palettes](#using-custom-color-palettes)
- [Primary Brand Colors](#primary-brand-colors)
- [Link Colors](#link-colors)
- [Navigation Colors](#navigation-colors)
- [Navbar Variables](#navbar-variables)
- [Offcanvas Variables](#offcanvas-variables)
- [Header Background](#header-background)
- [Container Backgrounds](#container-backgrounds)
- [Bootstrap Color Palette](#bootstrap-color-palette)
- [Body & Typography](#body--typography)
- [Additional Theme Colors](#additional-theme-colors)
- [Borders & Shadows](#borders--shadows)
- [Button Utilities](#button-utilities)
- [Card Variables](#card-variables)
- [Form Colors](#form-colors)
- [Responsive Tokens & Breakpoints](#responsive-tokens--breakpoints)
- [VirtueMart Variables](#virtuemart-variables)
- [Gable Variables](#gable-variables)

---

## Using Custom Color Palettes

To create custom color schemes:

1. **Copy template files** from `./templates/` directory:
   - `colors_custom_light.css` → `media/templates/site/mokocassiopeia/css/colors/light/colors_custom.css`
   - `colors_custom_dark.css` → `media/templates/site/mokocassiopeia/css/colors/dark/colors_custom.css`

2. **Edit the variables** in the copied files to match your brand

3. **Enable in Joomla**:
   - Navigate to: System → Site Templates → MokoCassiopeia
   - Under "Theme" tab, set palette to "Custom"
   - Save changes

4. **Note**: Custom files are gitignored and won't be committed to the repository

---

## Primary Brand Colors

### `--color-primary`
- **Description**: Main brand color used throughout the template
- **Light Mode Default**: `#112855`
- **Dark Mode Default**: `#112855`
- **Usage**: Headers, primary buttons, brand elements

### `--accent-color-primary`
- **Description**: Primary accent color for interactive elements
- **Light Mode Default**: `#3f8ff0`
- **Dark Mode Default**: `#3f8ff0`
- **Usage**: Hover states, focus indicators, call-to-action elements

### `--accent-color-secondary`
- **Description**: Secondary accent color
- **Light Mode Default**: `#3f8ff0`
- **Dark Mode Default**: `#6fb3ff`
- **Usage**: Secondary highlights, alternative styling

---

## Link Colors

### `--color-link`
- **Description**: Default color for hyperlinks
- **Light Mode Default**: `#224FAA`
- **Dark Mode Default**: `white`
- **Usage**: All text links in content

### `--color-hover`
- **Description**: Color when hovering over links and interactive elements
- **Light Mode Default**: `var(--accent-color-primary)`
- **Dark Mode Default**: `gray`
- **Usage**: Hover states for links and buttons

### `--color-active`
- **Description**: Color for active/selected links
- **Light Mode Default**: (not set)
- **Dark Mode Default**: `var(--mainmenu-nav-link-color)`
- **Usage**: Active navigation items, selected states

### `--link-color`
- **Description**: Bootstrap-compatible link color variable
- **Light Mode Default**: `#224faa`
- **Dark Mode Default**: `#8ab4f8`
- **Usage**: Alternative link color variable for Bootstrap compatibility

### `--link-hover-color`
- **Description**: Bootstrap-compatible hover color
- **Light Mode Default**: `#424077`
- **Dark Mode Default**: `#c3d6ff`
- **Usage**: Link hover state for Bootstrap components

---

## Navigation Colors

### `--mainmenu-nav-link-color`
- **Description**: Text color for main navigation menu
- **Light Mode Default**: `white`
- **Dark Mode Default**: `#fff`
- **Usage**: Navigation menu text

### `--nav-text-color`
- **Description**: General navigation text color
- **Light Mode Default**: `white`
- **Dark Mode Default**: `gray`
- **Usage**: Navigation elements

### `--nav-bg-color`
- **Description**: Background color for navigation bars
- **Light Mode Default**: `var(--color-link)`
- **Dark Mode Default**: `var(--color-primary)`
- **Usage**: Navigation background

---

## Navbar Variables

### `--navbar-padding-x`
- **Description**: Horizontal padding for navbar
- **Default**: `1rem`
- **Usage**: Navbar horizontal spacing

### `--navbar-padding-y`
- **Description**: Vertical padding for navbar
- **Default**: `0.5rem`
- **Usage**: Navbar vertical spacing

### `--navbar-color`
- **Description**: Default text color for navbar items
- **Light Mode Default**: `rgba(0, 0, 0, 0.55)`
- **Dark Mode Default**: `rgba(255, 255, 255, 0.55)`
- **Usage**: Navbar text color

### `--navbar-active-color`
- **Description**: Text color for active navbar items
- **Light Mode Default**: `rgba(0, 0, 0, 0.9)`
- **Dark Mode Default**: `rgba(255, 255, 255, 0.9)`
- **Usage**: Active navbar item color

### `--navbar-disabled-color`
- **Description**: Text color for disabled navbar items
- **Light Mode Default**: `rgba(0, 0, 0, 0.3)`
- **Dark Mode Default**: `rgba(255, 255, 255, 0.3)`
- **Usage**: Disabled navbar item color

### `--navbar-brand-padding-y`
- **Description**: Vertical padding for navbar brand
- **Default**: `0.3125rem`
- **Usage**: Navbar brand vertical spacing

### `--navbar-brand-margin-end`
- **Description**: Right margin for navbar brand
- **Default**: `1rem`
- **Usage**: Space after navbar brand

### `--navbar-brand-font-size`
- **Description**: Font size for navbar brand
- **Default**: `1.25rem`
- **Usage**: Navbar brand text size

### `--navbar-brand-color`
- **Description**: Color for navbar brand
- **Default**: Inherits from `--navbar-color`
- **Usage**: Navbar brand text color

### `--navbar-brand-active-color`
- **Description**: Color for navbar brand when active
- **Default**: Inherits from `--navbar-active-color`
- **Usage**: Active navbar brand color

### `--navbar-toggler-padding-x`
- **Description**: Horizontal padding for navbar toggler button
- **Default**: `0.75rem`
- **Usage**: Toggler button horizontal spacing

### `--navbar-toggler-padding-y`
- **Description**: Vertical padding for navbar toggler button
- **Default**: `0.25rem`
- **Usage**: Toggler button vertical spacing

### `--navbar-toggler-font-size`
- **Description**: Font size for navbar toggler icon
- **Default**: `1.25rem`
- **Usage**: Toggler icon size

### `--navbar-toggler-border-color`
- **Description**: Border color for navbar toggler
- **Light Mode Default**: `rgba(0, 0, 0, 0.1)`
- **Dark Mode Default**: `rgba(255, 255, 255, 0.1)`
- **Usage**: Toggler button border

### `--navbar-toggler-border-radius`
- **Description**: Border radius for navbar toggler
- **Default**: `0.25rem`
- **Usage**: Toggler button corner rounding

### `--navbar-toggler-focus-width`
- **Description**: Width of focus outline on toggler
- **Default**: `0.25rem`
- **Usage**: Focus indicator width

### `--navbar-toggler-transition`
- **Description**: CSS transition for toggler state changes
- **Default**: `box-shadow 0.15s ease-in-out`
- **Usage**: Toggler animation

### `--nav-link-padding-x`
- **Description**: Horizontal padding for nav links
- **Default**: `0.5rem`
- **Usage**: Nav link horizontal spacing

### `--nav-link-padding-y`
- **Description**: Vertical padding for nav links
- **Default**: `0.5rem`
- **Usage**: Nav link vertical spacing

### `--nav-link-font-weight`
- **Description**: Font weight for nav links
- **Default**: `400`
- **Usage**: Nav link text weight

### `--nav-link-color`
- **Description**: Color for nav links
- **Default**: Inherits from `--navbar-color`
- **Usage**: Nav link text color

### `--nav-link-active-color`
- **Description**: Color for active nav links
- **Default**: Inherits from `--navbar-active-color`
- **Usage**: Active nav link color

### `--nav-link-disabled-color`
- **Description**: Color for disabled nav links
- **Default**: Inherits from `--navbar-disabled-color`
- **Usage**: Disabled nav link color

---

## Offcanvas Variables

### `--offcanvas-color`
- **Description**: Text color for offcanvas content
- **Light Mode Default**: `var(--body-color)`
- **Dark Mode Default**: `var(--body-color)`
- **Usage**: Offcanvas text color

### `--offcanvas-padding-x`
- **Description**: Horizontal padding for offcanvas content
- **Default**: `1.5rem`
- **Usage**: Offcanvas horizontal spacing

### `--offcanvas-padding-y`
- **Description**: Vertical padding for offcanvas content
- **Default**: `1.5rem`
- **Usage**: Offcanvas vertical spacing

---

## Header Background

### `--header-background-image`
- **Description**: Background image URL for header
- **Default**: `url('../../../../../../media/templates/site/mokocassiopeia/images/bg.svg')`
- **Usage**: Header section background

### `--header-background-attachment`
- **Description**: CSS background-attachment property
- **Default**: `fixed`
- **Options**: `scroll`, `fixed`, `local`

### `--header-background-repeat`
- **Description**: CSS background-repeat property
- **Default**: `repeat`
- **Options**: `repeat`, `repeat-x`, `repeat-y`, `no-repeat`

### `--header-background-size`
- **Description**: CSS background-size property
- **Default**: `auto`
- **Options**: `auto`, `cover`, `contain`, specific sizes

---

## Container Backgrounds

Each container section has the following customizable properties:

### Container Sections
- `below-topbar` - Below top navigation bar
- `top-a` - Top section A
- `top-b` - Top section B
- `toc` - Table of Contents sidebar
- `sidebar` - Sidebar area
- `bottom-a` - Bottom section A
- `bottom-b` - Bottom section B

### Available Properties per Container
Replace `{section}` with the container name:

- `--container-{section}-bg-image` - Background image URL
- `--container-{section}-bg-color` - Background color
- `--container-{section}-bg-position` - Background position
- `--container-{section}-bg-attachment` - Attachment (scroll/fixed)
- `--container-{section}-bg-repeat` - Repeat pattern
- `--container-{section}-bg-size` - Background size
- `--container-{section}-border` - Border styling
- `--container-{section}-border-radius` - Border radius

### Special TOC Variables

#### `--container-toc-bg`
- **Description**: Background color for TOC container
- **Light Mode Default**: `var(--mainmenu-nav-link-color)`
- **Dark Mode Default**: (empty, transparent)

#### `--container-toc-color`
- **Description**: Text color for TOC
- **Light Mode Default**: `var(--color-primary)`
- **Dark Mode Default**: `#dbe3ff`

---

## Bootstrap Color Palette

### Contextual Colors

#### `--primary`
- **Light Mode**: `#010156`
- **Dark Mode**: `#010156`
- **Usage**: Primary theme color

#### `--secondary`
- **Light Mode**: `#6d757e`
- **Dark Mode**: `#48525d`
- **Usage**: Secondary elements

#### `--success`
- **Light Mode**: `#448344`
- **Dark Mode**: `#4aa664`
- **Usage**: Success messages, positive actions

#### `--info`
- **Light Mode**: `#30638d`
- **Dark Mode**: `#4f7aa0`
- **Usage**: Informational messages

#### `--warning`
- **Light Mode**: `#ad6200`
- **Dark Mode**: `#c77a00`
- **Usage**: Warning messages

#### `--danger`
- **Light Mode**: `#a51f18`
- **Dark Mode**: `#c23a31`
- **Usage**: Error messages, destructive actions

#### `--light`
- **Light Mode**: `#f9fafb`
- **Dark Mode**: `#1b2027`
- **Usage**: Light backgrounds

#### `--dark`
- **Light Mode**: `#353b41`
- **Dark Mode**: `#0f1318`
- **Usage**: Dark backgrounds

### Standard Colors

Available in both themes:
- `--blue`, `--indigo`, `--purple`, `--pink`
- `--red`, `--orange`, `--yellow`, `--green`
- `--teal`, `--cyan`
- `--black`, `--white`

### Gray Scale

Available in 9 shades: `--gray-100` through `--gray-900`

Light mode ranges from very light (`#f9fafb`) to very dark (`#22262a`).
Dark mode ranges are inverted for better contrast on dark backgrounds.

---

## Body & Typography

### `--body-font-family`
- **Description**: Default font stack for body text
- **Default**: `-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif`
- **Usage**: All body text

### `--body-font-size`
- **Description**: Base font size
- **Default**: `1rem` (typically 16px)
- **Usage**: Base typography size

### `--body-font-weight`
- **Description**: Default font weight
- **Default**: `400`
- **Usage**: Body text weight

### `--body-line-height`
- **Description**: Line height for body text
- **Default**: `1.5`
- **Usage**: Text line spacing

### `--body-color`
- **Description**: Main text color
- **Light Mode Default**: `#22262a`
- **Dark Mode Default**: `#e6ebf1`
- **Usage**: Body text color

### `--body-bg`
- **Description**: Main background color
- **Light Mode Default**: `#fff`
- **Dark Mode Default**: `#0e1318`
- **Usage**: Page background

### `--heading-color`
- **Description**: Color for headings (h1-h6)
- **Light Mode Default**: `inherit`
- **Dark Mode Default**: `#f1f5f9`
- **Usage**: Heading text

---

## Additional Theme Colors

### `--muted-color`
- **Default**: `#6d757e`
- **Usage**: Muted/secondary text

### `--code-color`
- **Light Mode**: `#e93f8e`
- **Dark Mode**: `#ff7abd`
- **Usage**: Inline code elements

### `--highlight-bg`
- **Light Mode**: `#fbeea8`
- **Dark Mode**: `#ffe28a1a`
- **Usage**: Text highlighting, mark elements

### `--emphasis-color`
- **Light Mode**: `#000`
- **Dark Mode**: `#fff`
- **Usage**: Emphasized text

### `--secondary-bg`
- **Light Mode**: `#eaedf0`
- **Dark Mode**: `#151b22`
- **Usage**: Secondary backgrounds, alternate rows

### `--tertiary-bg`
- **Light Mode**: `#f9fafb`
- **Dark Mode**: `#10151b`
- **Usage**: Tertiary backgrounds, subtle contrast

---

## Borders & Shadows

### Border Variables

#### `--border`
- **Default**: `5px`
- **Usage**: Border width shorthand

#### `--border-width`
- **Default**: `1px`
- **Usage**: Standard border width

#### `--border-style`
- **Default**: `solid`
- **Usage**: Border style

#### `--border-color`
- **Light Mode**: `#dfe3e7`
- **Dark Mode**: `#2b323b`
- **Usage**: Standard border color

#### `--border-color-translucent`
- **Light Mode**: `#0000002d`
- **Dark Mode**: `#ffffff26`
- **Usage**: Semi-transparent borders

### Border Radius

- `--border-radius`: `.25rem` (default)
- `--border-radius-sm`: `.2rem` (small)
- `--border-radius-lg`: `.3rem` (large)
- `--border-radius-xl`: `.3rem` (extra large)
- `--border-radius-xxl`: `2rem` (2x extra large)
- `--border-radius-pill`: `50rem` (pill-shaped)

### Box Shadows

#### `--box-shadow`
- **Default**: `0 .5rem 1rem rgba(0,0,0,.15)`
- **Usage**: Standard drop shadow

#### `--box-shadow-sm`
- **Default**: `0 .125rem .25rem rgba(0,0,0,.075)`
- **Usage**: Small/subtle shadow

#### `--box-shadow-lg`
- **Default**: `0 1rem 3rem rgba(0,0,0,.175)`
- **Usage**: Large/prominent shadow

#### `--box-shadow-inset`
- **Default**: `inset 0 1px 2px rgba(0,0,0,.075)`
- **Usage**: Inset/inner shadow

---

## Button Utilities

### `--btn-border-radius`
- **Description**: Border radius for buttons
- **Default**: `0.25rem`
- **Usage**: Button corner rounding

### `--btn-box-shadow`
- **Description**: Box shadow for buttons
- **Default**: `inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075)`
- **Usage**: Button shadow styling

---

## Card Variables

### `--card-spacer-x`
- **Description**: Horizontal spacing for card padding
- **Default**: `1rem`
- **Usage**: Card horizontal padding

### `--card-spacer-y`
- **Description**: Vertical spacing for card padding
- **Default**: `1rem`
- **Usage**: Card vertical padding

### `--card-title-spacer-y`
- **Description**: Spacing below card title
- **Default**: `0.5rem`
- **Usage**: Card title bottom margin

### `--card-border-width`
- **Description**: Width of card border
- **Default**: `1px`
- **Usage**: Card border thickness

### `--card-border-color`
- **Description**: Color of card border
- **Light Mode Default**: `rgba(0, 0, 0, 0.125)`
- **Dark Mode Default**: `rgba(255, 255, 255, 0.125)`
- **Usage**: Card border color

### `--card-border-radius`
- **Description**: Border radius for cards
- **Default**: `0.25rem`
- **Usage**: Card corner rounding

### `--card-box-shadow`
- **Description**: Box shadow for cards
- **Default**: `none`
- **Usage**: Card shadow effect

### `--card-inner-border-radius`
- **Description**: Inner border radius for nested card elements
- **Default**: `calc(0.25rem - 1px)`
- **Usage**: Inner card element corners

### `--card-cap-padding-x`
- **Description**: Horizontal padding for card header/footer
- **Default**: `1rem`
- **Usage**: Card cap horizontal spacing

### `--card-cap-padding-y`
- **Description**: Vertical padding for card header/footer
- **Default**: `0.5rem`
- **Usage**: Card cap vertical spacing

### `--card-cap-bg`
- **Description**: Background color for card header/footer
- **Light Mode Default**: `rgba(0, 0, 0, 0.03)`
- **Dark Mode Default**: `rgba(255, 255, 255, 0.03)`
- **Usage**: Card cap background

### `--card-cap-color`
- **Description**: Text color for card header/footer
- **Default**: Inherits from body color
- **Usage**: Card cap text color

### `--card-height`
- **Description**: Height constraint for cards
- **Default**: `auto`
- **Usage**: Card height control

### `--card-color`
- **Description**: Text color for card content
- **Default**: Inherits from body color
- **Usage**: Card text color

### `--card-bg`
- **Description**: Background color for cards
- **Light Mode Default**: `#fff`
- **Dark Mode Default**: `#212529`
- **Usage**: Card background

### `--card-img-overlay-padding`
- **Description**: Padding for card image overlays
- **Default**: `1rem`
- **Usage**: Card image overlay spacing

### `--card-group-margin`
- **Description**: Margin between cards in card groups
- **Default**: `0.75rem`
- **Usage**: Card group spacing

---

## Form Colors

### Focus Ring

#### `--focus-ring-width`
- **Default**: `.25rem`
- **Usage**: Width of focus indicators

#### `--focus-ring-opacity`
- **Light Mode**: `.25`
- **Dark Mode**: `.6`
- **Usage**: Opacity of focus ring

#### `--focus-ring-color`
- **Light Mode**: `rgba(1,1,86,.25)`
- **Dark Mode**: `rgba(84,114,255,.4)`
- **Usage**: Color of focus indicators

### Validation Colors

#### Valid State
- `--form-valid-color`: Success green
  - Light: `#448344`
  - Dark: `#78d694`
- `--form-valid-border-color`: Matching border color

#### Invalid State
- `--form-invalid-color`: Error red
  - Light: `#a51f18`
  - Dark: `#ff8e86`
- `--form-invalid-border-color`: Matching border color

---

## Responsive Tokens & Breakpoints

### Breakpoint Variables

#### `--bp-xs`
- **Description**: Extra small breakpoint
- **Default**: `0px`
- **Usage**: Mobile devices

#### `--bp-sm`
- **Description**: Small breakpoint
- **Default**: `576px`
- **Usage**: Small tablets, large phones

#### `--bp-md`
- **Description**: Medium breakpoint
- **Default**: `768px`
- **Usage**: Tablets

#### `--bp-lg`
- **Description**: Large breakpoint
- **Default**: `992px`
- **Usage**: Desktops

#### `--bp-xl`
- **Description**: Extra large breakpoint
- **Default**: `1200px`
- **Usage**: Large desktops

### Responsive Utilities

#### `--nav-toggle-size`
- **Description**: Size of navigation toggle button
- **Default**: `40px`
- **Usage**: Mobile menu toggle button dimensions

#### `--bg-opacity`
- **Description**: Background opacity for overlay elements
- **Default**: `0.5`
- **Usage**: Overlay transparency

#### `--padding-x`
- **Description**: General horizontal padding utility
- **Default**: `1rem`
- **Usage**: Horizontal spacing utility

#### `--padding-y`
- **Description**: General vertical padding utility
- **Default**: `1rem`
- **Usage**: Vertical spacing utility

---

## VirtueMart Variables

### VM Surfaces

#### `--vm-surface`
- **Description**: Primary VirtueMart surface background
- **Light Mode Default**: `#ffffff`
- **Dark Mode Default**: `#1e1e1e`
- **Usage**: Main VM component backgrounds

#### `--vm-surface-2`
- **Description**: Secondary VirtueMart surface background
- **Light Mode Default**: `#f8f9fa`
- **Dark Mode Default**: `#2d2d2d`
- **Usage**: Alternate VM backgrounds

#### `--vm-text`
- **Description**: Default VirtueMart text color
- **Light Mode Default**: `#212529`
- **Dark Mode Default**: `#e9ecef`
- **Usage**: VM body text

#### `--vm-text-strong`
- **Description**: Strong/emphasized VirtueMart text
- **Light Mode Default**: `#000000`
- **Dark Mode Default**: `#ffffff`
- **Usage**: VM headings, emphasized text

#### `--vm-text-muted`
- **Description**: Muted VirtueMart text
- **Light Mode Default**: `#6c757d`
- **Dark Mode Default**: `#adb5bd`
- **Usage**: VM secondary text, captions

#### `--vm-border`
- **Description**: Border color for VirtueMart components
- **Light Mode Default**: `#dee2e6`
- **Dark Mode Default**: `#495057`
- **Usage**: VM borders, dividers

#### `--vm-price-color`
- **Description**: Color for product prices
- **Light Mode Default**: `#198754`
- **Dark Mode Default**: `#20c997`
- **Usage**: Product price display

### VM Layout

#### `--vm-container-max-width`
- **Description**: Maximum width for VM containers
- **Default**: `1200px`
- **Usage**: VM content width constraint

#### `--vm-section-gap`
- **Description**: Gap between VM sections
- **Default**: `2rem`
- **Usage**: VM section spacing

#### `--vm-block-radius`
- **Description**: Border radius for VM blocks
- **Default**: `0.375rem`
- **Usage**: VM component corner rounding

#### `--vm-block-shadow`
- **Description**: Shadow for VM blocks
- **Default**: `0 2px 4px rgba(0, 0, 0, 0.1)`
- **Usage**: VM component shadows

### VM Typography

#### `--vm-title-1-size`
- **Description**: Size for h1 titles in VM
- **Default**: `2.5rem`
- **Usage**: VM main headings

#### `--vm-title-1-weight`
- **Description**: Font weight for h1 titles
- **Default**: `700`
- **Usage**: VM main heading weight

#### `--vm-title-2-size`
- **Description**: Size for h2 titles in VM
- **Default**: `2rem`
- **Usage**: VM section headings

#### `--vm-title-2-weight`
- **Description**: Font weight for h2 titles
- **Default**: `600`
- **Usage**: VM section heading weight

#### `--vm-title-3-size`
- **Description**: Size for h3 titles in VM
- **Default**: `1.75rem`
- **Usage**: VM subsection headings

#### `--vm-title-3-weight`
- **Description**: Font weight for h3 titles
- **Default**: `600`
- **Usage**: VM subsection heading weight

#### `--vm-title-4-size`
- **Description**: Size for h4 titles in VM
- **Default**: `1.5rem`
- **Usage**: VM component headings

#### `--vm-title-4-weight`
- **Description**: Font weight for h4 titles
- **Default**: `500`
- **Usage**: VM component heading weight

#### `--vm-title-5-size`
- **Description**: Size for h5 titles in VM
- **Default**: `1.25rem`
- **Usage**: VM small headings

#### `--vm-title-5-weight`
- **Description**: Font weight for h5 titles
- **Default**: `500`
- **Usage**: VM small heading weight

### VM Controls

#### `--vm-input-border`
- **Description**: Border style for VM inputs
- **Light Mode Default**: `1px solid #ced4da`
- **Dark Mode Default**: `1px solid #495057`
- **Usage**: VM form input borders

#### `--vm-input-bg`
- **Description**: Background color for VM inputs
- **Light Mode Default**: `#ffffff`
- **Dark Mode Default**: `#212529`
- **Usage**: VM form input backgrounds

#### `--vm-input-text`
- **Description**: Text color for VM inputs
- **Light Mode Default**: `#212529`
- **Dark Mode Default**: `#e9ecef`
- **Usage**: VM form input text

#### `--vm-qty-width`
- **Description**: Width for quantity input fields
- **Default**: `80px`
- **Usage**: Product quantity selectors

#### `--vm-cart-dropdown-min-width`
- **Description**: Minimum width for cart dropdown
- **Default**: `300px`
- **Usage**: Shopping cart dropdown sizing

### VM Alerts

#### `--vm-alert-success-bg`
- **Description**: Background for success alerts
- **Light Mode Default**: `#d1e7dd`
- **Dark Mode Default**: `#0f5132`
- **Usage**: VM success messages

#### `--vm-alert-error-bg`
- **Description**: Background for error alerts
- **Light Mode Default**: `#f8d7da`
- **Dark Mode Default**: `#842029`
- **Usage**: VM error messages

#### `--vm-availability-in-stock`
- **Description**: Color for in-stock indicator
- **Light Mode Default**: `#198754`
- **Dark Mode Default**: `#20c997`
- **Usage**: Product availability display

#### `--vm-availability-out-of-stock`
- **Description**: Color for out-of-stock indicator
- **Light Mode Default**: `#dc3545`
- **Dark Mode Default**: `#ea868f`
- **Usage**: Product unavailability display

### VM Buttons

#### `--vm-btn-padding-x`
- **Description**: Horizontal padding for VM buttons
- **Default**: `1rem`
- **Usage**: VM button horizontal spacing

#### `--vm-btn-padding-y`
- **Description**: Vertical padding for VM buttons
- **Default**: `0.5rem`
- **Usage**: VM button vertical spacing

#### `--vm-btn-radius`
- **Description**: Border radius for VM buttons
- **Default**: `0.25rem`
- **Usage**: VM button corner rounding

#### `--vm-btn-shadow`
- **Description**: Shadow for VM buttons
- **Default**: `0 2px 4px rgba(0, 0, 0, 0.1)`
- **Usage**: VM button shadows

#### `--vm-btn-primary-bg`
- **Description**: Background for primary VM buttons
- **Light Mode Default**: `#0d6efd`
- **Dark Mode Default**: `#0a58ca`
- **Usage**: Primary VM action buttons

#### `--vm-btn-primary-text`
- **Description**: Text color for primary VM buttons
- **Default**: `#ffffff`
- **Usage**: Primary VM button text

#### `--vm-btn-secondary-bg`
- **Description**: Background for secondary VM buttons
- **Light Mode Default**: `#6c757d`
- **Dark Mode Default**: `#565e64`
- **Usage**: Secondary VM action buttons

#### `--vm-btn-secondary-text`
- **Description**: Text color for secondary VM buttons
- **Default**: `#ffffff`
- **Usage**: Secondary VM button text

#### `--vm-btn-add-to-cart-bg`
- **Description**: Background for add-to-cart button
- **Light Mode Default**: `#198754`
- **Dark Mode Default**: `#146c43`
- **Usage**: Add to cart button styling

### VM Image Overlays

#### `--vm-overlay-gap`
- **Description**: Gap in image overlay elements
- **Default**: `0.5rem`
- **Usage**: Spacing in product image overlays

#### `--vm-overlay-top`
- **Description**: Top position for overlay elements
- **Default**: `1rem`
- **Usage**: Overlay vertical positioning

#### `--vm-overlay-right`
- **Description**: Right position for overlay elements
- **Default**: `1rem`
- **Usage**: Overlay horizontal positioning

#### `--vm-overlay-btn-size`
- **Description**: Size for overlay buttons
- **Default**: `40px`
- **Usage**: Quick view, wishlist button dimensions

#### `--vm-overlay-btn-bg`
- **Description**: Background for overlay buttons
- **Light Mode Default**: `rgba(255, 255, 255, 0.9)`
- **Dark Mode Default**: `rgba(0, 0, 0, 0.9)`
- **Usage**: Overlay button background

#### `--vm-overlay-btn-text`
- **Description**: Text color for overlay buttons
- **Light Mode Default**: `#212529`
- **Dark Mode Default**: `#e9ecef`
- **Usage**: Overlay button text

#### `--vm-overlay-btn-hover-bg`
- **Description**: Background for overlay buttons on hover
- **Light Mode Default**: `#ffffff`
- **Dark Mode Default**: `#000000`
- **Usage**: Overlay button hover state

#### `--vm-overlay-btn-radius`
- **Description**: Border radius for overlay buttons
- **Default**: `50%`
- **Usage**: Circular overlay buttons

#### `--vm-overlay-btn-shadow`
- **Description**: Shadow for overlay buttons
- **Default**: `0 2px 8px rgba(0, 0, 0, 0.15)`
- **Usage**: Overlay button shadows

### VM Vendor Menu

#### `--vm-vendor-menu-bg`
- **Description**: Background for vendor menu
- **Light Mode Default**: `#ffffff`
- **Dark Mode Default**: `#212529`
- **Usage**: Vendor menu background

#### `--vm-vendor-menu-text`
- **Description**: Text color for vendor menu
- **Light Mode Default**: `#212529`
- **Dark Mode Default**: `#e9ecef`
- **Usage**: Vendor menu text

#### `--vm-vendor-menu-border`
- **Description**: Border for vendor menu
- **Light Mode Default**: `1px solid #dee2e6`
- **Dark Mode Default**: `1px solid #495057`
- **Usage**: Vendor menu borders

#### `--vm-vendor-menu-hover-bg`
- **Description**: Background on hover for vendor menu items
- **Light Mode Default**: `#f8f9fa`
- **Dark Mode Default**: `#2d2d2d`
- **Usage**: Vendor menu hover state

#### `--vm-vendor-menu-active-bg`
- **Description**: Background for active vendor menu items
- **Light Mode Default**: `#e9ecef`
- **Dark Mode Default**: `#343a40`
- **Usage**: Active vendor menu item

#### `--vm-vendor-menu-active-text`
- **Description**: Text color for active vendor menu items
- **Light Mode Default**: `#0d6efd`
- **Dark Mode Default**: `#6ea8fe`
- **Usage**: Active vendor menu text

#### `--vm-vendor-menu-padding-x`
- **Description**: Horizontal padding for vendor menu items
- **Default**: `1rem`
- **Usage**: Vendor menu item horizontal spacing

#### `--vm-vendor-menu-padding-y`
- **Description**: Vertical padding for vendor menu items
- **Default**: `0.75rem`
- **Usage**: Vendor menu item vertical spacing

#### `--vm-vendor-menu-font-size`
- **Description**: Font size for vendor menu
- **Default**: `0.875rem`
- **Usage**: Vendor menu text size

#### `--vm-vendor-menu-font-weight`
- **Description**: Font weight for vendor menu
- **Default**: `400`
- **Usage**: Vendor menu text weight

#### `--vm-vendor-menu-radius`
- **Description**: Border radius for vendor menu
- **Default**: `0.25rem`
- **Usage**: Vendor menu corner rounding

#### `--vm-vendor-menu-shadow`
- **Description**: Shadow for vendor menu
- **Default**: `0 2px 4px rgba(0, 0, 0, 0.1)`
- **Usage**: Vendor menu drop shadow

#### `--vm-vendor-menu-width`
- **Description**: Width for vendor menu
- **Default**: `250px`
- **Usage**: Vendor menu sizing

#### `--vm-vendor-menu-item-gap`
- **Description**: Gap between vendor menu items
- **Default**: `0.25rem`
- **Usage**: Vendor menu item spacing

#### `--vm-vendor-menu-icon-size`
- **Description**: Size for vendor menu icons
- **Default**: `1.25rem`
- **Usage**: Vendor menu icon dimensions

---

## Gable Variables

### `--gab-blue`
- **Description**: Gable primary blue color
- **Default**: `#1e88e5`
- **Usage**: Gable brand blue accent

### `--gab-green`
- **Description**: Gable green color
- **Default**: `#43a047`
- **Usage**: Gable success/positive indicators

### `--gab-red`
- **Description**: Gable red color
- **Default**: `#e53935`
- **Usage**: Gable error/alert indicators

### `--gab-orange`
- **Description**: Gable orange color
- **Default**: `#fb8c00`
- **Usage**: Gable warning indicators

### `--gab-gray1`
- **Description**: Gable light gray
- **Light Mode Default**: `#f5f5f5`
- **Dark Mode Default**: `#424242`
- **Usage**: Gable light backgrounds

### `--gab-gray2`
- **Description**: Gable medium gray
- **Light Mode Default**: `#e0e0e0`
- **Dark Mode Default**: `#616161`
- **Usage**: Gable medium backgrounds, borders

### `--gab-gray3`
- **Description**: Gable dark gray
- **Light Mode Default**: `#9e9e9e`
- **Dark Mode Default**: `#9e9e9e`
- **Usage**: Gable text, icons

---

## Usage Examples

### Example 1: Custom Brand Colors

```css
:root[data-bs-theme="light"] {
  --color-primary: #1e40af;
  --accent-color-primary: #3b82f6;
  --color-link: #2563eb;
  --color-hover: #1d4ed8;
}
```

### Example 2: Custom Container Background

```css
:root[data-bs-theme="light"] {
  --container-top-a-bg-color: #f3f4f6;
  --container-top-a-bg-image: url('/images/pattern.svg');
  --container-top-a-bg-repeat: repeat;
  --container-top-a-border-radius: 8px;
}
```

### Example 3: Custom Typography

```css
:root[data-bs-theme="light"] {
  --body-font-family: 'Inter', sans-serif;
  --body-font-size: 1.125rem;
  --heading-color: #1f2937;
}
```

### Example 4: Custom Card Styling

```css
:root[data-bs-theme="light"] {
  --card-border-radius: 0.5rem;
  --card-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  --card-spacer-x: 1.5rem;
  --card-spacer-y: 1.5rem;
}
```

### Example 5: VirtueMart Custom Colors

```css
:root[data-bs-theme="light"] {
  --vm-btn-primary-bg: #0d6efd;
  --vm-btn-add-to-cart-bg: #198754;
  --vm-price-color: #dc3545;
  --vm-surface: #ffffff;
}
```

### Example 6: Responsive Navbar

```css
:root[data-bs-theme="light"] {
  --navbar-padding-x: 1.5rem;
  --navbar-padding-y: 0.75rem;
  --nav-toggle-size: 48px;
  --navbar-toggler-border-radius: 0.5rem;
}
```

---

## Tips for Customization

1. **Start with templates**: Use the provided template files as a starting point
2. **Test both themes**: Ensure your colors work well in both light and dark modes
3. **Use CSS variables**: Reference other variables with `var()` for consistency
4. **Check contrast**: Ensure text remains readable against backgrounds
5. **Use fallbacks**: Provide fallback values in `var()` functions
6. **Test responsively**: Verify colors work on all screen sizes
7. **Document changes**: Keep notes on custom color choices

---

## See Also

- [README](../README.md) - Main documentation
- [Quick Start Guide](./QUICK_START.md) - Getting started
- [Development Guide](./JOOMLA_DEVELOPMENT.md) - Developer resources
- Template files in `/templates/` directory

---

## Metadata

* Document: docs/CSS_VARIABLES.md
* Repository: [https://github.com/mokoconsulting-tech/MokoCassiopeia](https://github.com/mokoconsulting-tech/MokoCassiopeia)
* Path: /docs/CSS_VARIABLES.md
* Owner: Moko Consulting
* Version: 03.06.03
* Status: Active
* Effective Date: 2026-01-30
* Classification: Public Open Source Documentation

## Revision History

| Date       | Change Summary                                        | Author          |
| ---------- | ----------------------------------------------------- | --------------- |
| 2026-02-07 | Added missing CSS variable documentation              | GitHub Copilot  |
| 2026-01-30 | Initial CSS variables reference documentation created | GitHub Copilot  |
