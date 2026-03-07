<!-- Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 SPDX-License-Identifier: GPL-3.0-or-later

 BRIEF: Template files directory README
 -->

# MokoCassiopeia Templates Directory

This directory contains template files for custom color schemes that can be copied to your template installation.

## Custom Color Palette Templates

Template files are provided for both light and dark themes with complete Bootstrap button definitions:

### Available Templates

| File | Theme | Description |
|------|-------|-------------|
| `colors_custom_light.css` | Light | Custom light theme with all Bootstrap button variants |
| `colors_custom_dark.css` | Dark | Custom dark theme with all Bootstrap button variants |

### Using Custom Color Templates

1. **Copy** the template file to your template's CSS directory:
   ```bash
   # For light theme
   cp templates/colors_custom_light.css src/media/css/colors/light/colors_custom.css
   
   # For dark theme
   cp templates/colors_custom_dark.css src/media/css/colors/dark/colors_custom.css
   ```

2. **Customize** the CSS variables in your copied file:
   - Modify `--color-primary`, `--accent-color-primary`, etc. to match your brand
   - Adjust Bootstrap state colors (`--success`, `--info`, `--warning`, `--danger`)
   - Update button variants if needed

3. **Register** in `src/joomla.asset.json`:
   - Ensure `template.light.colors_custom` and `template.dark.colors_custom` assets are defined
   - Already configured by default in the asset manifest

4. **Activate** via Joomla admin:
   - Go to System → Site Templates → MokoCassiopeia
   - Select "Custom" in the Color Palette dropdown
   - Save and check your site

### Bootstrap Button Variants Included

All template files include complete definitions for:

**Solid Buttons:**
- `.btn-primary`, `.btn-secondary`, `.btn-success`, `.btn-info`, `.btn-warning`, `.btn-danger`, `.btn-light`, `.btn-dark`

**Outline Buttons:**
- `.btn-outline-primary`, `.btn-outline-secondary`, `.btn-outline-success`, `.btn-outline-info`, `.btn-outline-warning`, `.btn-outline-danger`, `.btn-outline-light`, `.btn-outline-dark`

Each button variant includes hover, active, focus, and disabled states using CSS variables.

## Color System Features

### CSS Variable Structure

Colors are defined as CSS variables allowing easy customization:

```css
:root[data-bs-theme="light"] {
  --color-primary: #0066cc;
  --accent-color-primary: #3399ff;
  --success: #28a745;
  --danger: #dc3545;
  /* ...and many more */
}
```

### Opacity Utilities

Template includes opacity utility variables for creating translucent colors:

```css
--opacity-5: 0.05;
--opacity-10: 0.1;
--opacity-15: 0.15;
--opacity-25: 0.25;
--opacity-50: 0.5;
--opacity-75: 0.75;
--opacity-100: 1;
```

Use with rgba():
```css
background-color: rgba(var(--black-rgb), var(--opacity-10));
```

### Shadow Color Utilities

Pre-defined shadow color variables:

```css
--shadow-color-light: rgba(var(--black-rgb), var(--opacity-15));
--shadow-color-medium: rgba(var(--black-rgb), var(--opacity-25));
--shadow-color-dark: rgba(var(--black-rgb), var(--opacity-30));
```

---

## 📚 Additional Resources

- **[Main README](../README.md)** - MokoCassiopeia features and installation
- **[CSS Variables Reference](../docs/CSS_VARIABLES.md)** - All available CSS variables
- **[Development Guide](../docs/JOOMLA_DEVELOPMENT.md)** - Development workflows

---

**Template Directory**: `/templates/`  
**Version**: 03.08.04  
**Maintained by**: Moko Consulting
