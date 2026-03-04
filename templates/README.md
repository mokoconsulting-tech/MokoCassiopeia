<!-- Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 SPDX-License-Identifier: GPL-3.0-or-later

 BRIEF: Template files directory README
 -->

# MokoCassiopeia Template Files

This directory contains template files for client color customizations.

---

## 📁 Available Templates

### Custom Color Scheme Template

**File**: `colors_custom.css`

A comprehensive template for creating custom color schemes. This template includes all CSS variables used by MokoCassiopeia for both light and dark modes.

**Usage**:
1. Copy this file to either:
   - `src/media/css/colors/light/colors_custom.css` (for light mode)
   - `src/media/css/colors/dark/colors_custom.css` (for dark mode)
2. Customize the CSS variables to match your brand colors
3. Enable in Joomla: System → Site Templates → MokoCassiopeia → Theme tab
4. Set the appropriate palette to "Custom"

**Reference**: See [CSS Variables Documentation](../docs/CSS_VARIABLES.md) for complete variable reference.

---

### Client Fork .gitignore Template

**File**: `gitignore-template`

A .gitignore template for client forks that ensures custom color files are tracked in the fork repository while maintaining proper ignore rules for other files.

**Usage**:
- Automatically applied when using the client fork creation workflow
- Can be manually copied to `.gitignore` in client fork repositories

---

## 🎯 When to Use These Templates

### Creating a Client Fork

If you're creating a custom fork of MokoCassiopeia for a specific client:

1. **Use the automated workflow**: See [CLIENT_FORK_WORKFLOW.md](../docs/CLIENT_FORK_WORKFLOW.md)
2. **Set up custom colors**: Use `colors_custom.css` as your starting point
3. **Test thoroughly**: Verify colors in both light and dark modes

### Custom Colors Only

If you just need custom colors without forking:

1. Use the `colors_custom.css` template
2. Follow the instructions in the [main README](../README.md#custom-color-palettes)
3. Enable custom palette in Joomla template settings

---

## 📚 Additional Resources

- **[Main README](../README.md)** - MokoCassiopeia features and installation
- **[Client Fork Workflow](../docs/CLIENT_FORK_WORKFLOW.md)** - Automated fork setup guide
- **[CSS Variables Reference](../docs/CSS_VARIABLES.md)** - All available CSS variables
- **[Development Guide](../docs/JOOMLA_DEVELOPMENT.md)** - Development workflows

---

**Template Directory**: `/templates/`  
**Version**: 03.08.04  
**Scope**: Colors only  
**Maintained by**: Moko Consulting
