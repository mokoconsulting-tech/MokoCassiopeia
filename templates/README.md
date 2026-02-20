<!-- Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 SPDX-License-Identifier: GPL-3.0-or-later

 BRIEF: Template files directory README
 -->

# MokoCassiopeia Template Files

This directory contains template files for client customizations and custom code forks.

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

### Client Fork README Template

**File**: `CLIENT_FORK_README_TEMPLATE.md`

A simplified README template for client-specific forks. Use this as a starting point for documenting your customizations.

**Usage**:
1. Copy this file to the root of your fork repository as `README.md`
2. Replace `[CLIENT NAME]` with your client's name
3. Fill in brand colors and contact information
4. Add client-specific notes and configurations

**For Comprehensive Fork Setup**: See [CLIENT_FORK_README.md](../CLIENT_FORK_README.md) for the complete client fork guide.

---

## 🎯 When to Use These Templates

### Creating a Client Fork

If you're creating a custom fork of MokoCassiopeia for a specific client:

1. **Start with the full guide**: Read [CLIENT_FORK_README.md](../CLIENT_FORK_README.md)
2. **Set up custom colors**: Use `colors_custom.css` as your starting point
3. **Document your fork**: Copy `CLIENT_FORK_README_TEMPLATE.md` to your fork

### Custom Colors Only

If you just need custom colors without forking:

1. Use the `colors_custom.css` template
2. Follow the instructions in the [main README](../README.md#custom-color-palettes)
3. Enable custom palette in Joomla template settings

---

## 📚 Additional Resources

- **[Main README](../README.md)** - MokoCassiopeia features and installation
- **[Client Fork Guide](../CLIENT_FORK_README.md)** - Complete guide for client forks
- **[CSS Variables Reference](../docs/CSS_VARIABLES.md)** - All available CSS variables
- **[Development Guide](../docs/JOOMLA_DEVELOPMENT.md)** - Development workflows

---

**Template Directory**: `/templates/`  
**Version**: 03.06.03  
**Maintained by**: Moko Consulting
