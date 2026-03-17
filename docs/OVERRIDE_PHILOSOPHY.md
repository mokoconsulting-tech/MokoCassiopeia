<!--
 Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 3 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with this program. If not, see <https://www.gnu.org/licenses/>.


 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Documentation
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 FILE: docs/OVERRIDE_PHILOSOPHY.md
 VERSION: 03.08.04
 BRIEF: Philosophy and implementation of non-replacing alternative layouts
 PATH: /docs/OVERRIDE_PHILOSOPHY.md
-->

# Override Philosophy — MokoCassiopeia

## Core Principle: Add-On, Not Replacement

**MokoCassiopeia overrides are designed as alternative layouts, not replacements of default Joomla layouts.**

This means:
- ✅ Default Joomla layouts continue to work unchanged
- ✅ Site administrators can choose when to use our enhanced layouts
- ✅ Updates to Joomla core layouts don't break the site
- ✅ Compatibility with other extensions is maintained
- ✅ Users have control over which layouts to use

---

## Technical Implementation

### Layout Naming Convention

All MokoCassiopeia overrides use **`mobile.php`** naming instead of **`default.php`**:

```
❌ BAD (Replaces default):
src/html/mod_virtuemart_cart/default.php

✅ GOOD (Alternative layout):
src/html/mod_virtuemart_cart/mobile.php
```

### How Joomla Handles Layouts

When a module or component looks for a layout, Joomla searches in this order:

1. **Template override with specified layout name**: `templates/mokocassiopeia/html/{extension}/{view}/{layout}.php`
2. **Extension's specified layout**: `{extension}/tmpl/{view}/{layout}.php`
3. **Template override for default layout**: `templates/mokocassiopeia/html/{extension}/{view}/default.php`
4. **Extension's default layout**: `{extension}/tmpl/{view}/default.php`

By naming our overrides `mobile.php` instead of `default.php`, they become **step 1** alternatives that must be explicitly selected, rather than **step 3** replacements that are automatically used.

---

## How to Use Alternative Layouts

### Method 1: Module/Menu Item Settings

When editing a module or menu item in Joomla administrator:

1. Open the module/menu item for editing
2. Navigate to the **Advanced** tab
3. Find the **Alternative Layout** field
4. Select **MokoCassiopeia - mobile** from the dropdown
5. Save

### Method 2: Override in Module Position

If you want all modules in a specific position to use the mobile layout:

```php
<!-- In your index.php template file -->
<?php if ($this->countModules('sidebar-left')) : ?>
    <jdoc:include type="modules" name="sidebar-left" style="none" layout="mobile" />
<?php endif; ?>
```

### Method 3: Module Chrome (Advanced)

Create a custom module chrome in `templates/mokocassiopeia/html/layouts/chromes/` that automatically applies the mobile layout.

---

## Exception: Main Menu

**The only exception** to this philosophy is `mod_menu` with the "Main Menu" module type.

The template includes files like:
- `src/html/mod_menu/mainmenu.php`
- `src/html/mod_menu/mainmenu_component.php`
- `src/html/mod_menu/mainmenu_heading.php`
- `src/html/mod_menu/mainmenu_url.php`
- `src/html/mod_menu/mainmenu_separator.php`

These use a **custom layout name** (`mainmenu`) instead of replacing `default.php`, which allows the site to:
- Use the enhanced Bootstrap 5 collapsible menu for main navigation
- Keep standard Joomla menus working in other positions
- Provide better mobile navigation without breaking existing menus

To use this layout, set the module's **Alternative Layout** to **MokoCassiopeia - mainmenu**.

---

## Override Inventory

### Module Overrides (16 total)

All use `mobile.php` naming (alternative layout):

**VirtueMart (5)**:
- `mod_virtuemart_cart/mobile.php`
- `mod_virtuemart_product/mobile.php`
- `mod_virtuemart_currencies/mobile.php`
- `mod_virtuemart_category/mobile.php`
- `mod_virtuemart_manufacturer/mobile.php`

**Community Builder (2)**:
- `mod_cblogin/mobile.php`
- `mod_comprofilerOnline/mobile.php`

**Main Menu (1)**:
- `mod_menu/mainmenu.php` (custom layout name)

**Industry Extensions (8)**:
- `mod_k2_content/mobile.php`
- `mod_acymailing/mobile.php`
- `mod_hikashop_cart/mobile.php`
- `mod_kunenalatest/mobile.php`
- `mod_kunenalogin/mobile.php`
- `mod_kunenasearch/mobile.php`
- `mod_kunenastats/mobile.php`
- `mod_osmembership/mobile.php`

### Component View Overrides (12 total)

All use `mobile.php` naming (alternative layout):

**Community Builder (4)**:
- `com_comprofiler/userprofile/mobile.php`
- `com_comprofiler/userslist/mobile.php`
- `com_comprofiler/registers/mobile.php`
- `com_comprofiler/login/mobile.php`

**JEM - Joomla Event Manager (5)**:
- `com_jem/eventslist/mobile.php`
- `com_jem/event/mobile.php`
- `com_jem/calendar/mobile.php`
- `com_jem/venue/mobile.php`
- `com_jem/categories/mobile.php`

**Kunena Forum (1)**:
- `com_kunena/category/mobile.php`

**OSMembership (2)**:
- `com_osmembership/plan/mobile.php`
- `com_osmembership/plans/mobile.php`

**Joomla Core (2)**:
- `com_content/article/toc-left.php` (custom layout name)
- `com_content/article/toc-right.php` (custom layout name)

---

## Benefits of This Approach

### 1. **Zero Breaking Changes**

Existing sites continue to work exactly as before. No layouts are forcibly changed.

### 2. **Gradual Adoption**

Site administrators can:
- Test mobile layouts on specific modules first
- Roll out changes module-by-module
- Keep some modules using default layouts if needed
- Easily revert by changing the Alternative Layout setting

### 3. **Extension Compatibility**

Third-party extensions' default layouts remain untouched, preventing conflicts with:
- Extension updates
- Other templates
- Custom development

### 4. **Joomla Core Updates**

When Joomla core updates:
- Default layouts get new features/bug fixes automatically
- Mobile layouts remain stable and tested
- No emergency fixes needed after Joomla updates

### 5. **Multi-Language Support**

Joomla's language system loads extension language files properly because:
- Extensions aren't hijacked by template overrides
- Language strings come from the correct source
- Translations work as expected

---

## Standards Not Overridden

Following Cassiopeia template best practices, MokoCassiopeia **does not override** standard Joomla core modules:

- ❌ `mod_breadcrumbs` - Use Joomla core layout
- ❌ `mod_login` - Use Joomla core layout
- ❌ `mod_articles_latest` - Use Joomla core layout
- ❌ `mod_articles_category` - Use Joomla core layout
- ❌ `mod_articles_news` - Use Joomla core layout
- ❌ `mod_search` - Use Joomla core layout (removed in v03.08.03)

**Reason**: These modules have robust core layouts with proper language loading, accessibility, and ongoing Joomla maintenance.

---

## Developer Guidelines

When adding new overrides to MokoCassiopeia:

### ✅ DO:

1. Name files `mobile.php` or use descriptive custom names (`mainmenu.php`, `toc-left.php`)
2. Document the alternative layout in MODULE_OVERRIDES.md
3. Add CSS with BEM naming: `.{extension}-{view}__element`
4. Test that default layouts still work
5. Provide clear instructions for selecting the layout

### ❌ DON'T:

1. Create `default.php` files that replace core layouts
2. Override standard Joomla core modules without strong justification
3. Break backward compatibility
4. Assume users will automatically get your layout
5. Forget to document how to enable the alternative layout

---

## Migration from Replacing Overrides

If you're migrating from a template that used `default.php` overrides:

### Step 1: Identify Replaced Layouts

```bash
find templates/oldtemplate/html -name "default.php"
```

### Step 2: Rename to Alternative Layouts

```bash
# For each default.php found:
mv default.php mobile.php
```

### Step 3: Update Module Settings

For each module using the old override:
1. Edit module in administrator
2. Advanced tab → Alternative Layout
3. Select "mobile" from dropdown
4. Save

### Step 4: Test

- Verify module displays correctly
- Check that other modules still use default layouts
- Confirm language strings load properly

---

## Troubleshooting

### My Alternative Layout Doesn't Appear in Dropdown

**Check:**
1. File is in correct location: `templates/mokocassiopeia/html/{extension}/{view}/`
2. File has `.php` extension
3. File is not named `default.php`
4. Cache is cleared (System → Clear Cache)

### Module Still Uses Default Layout

**Check:**
1. Module's Alternative Layout setting in administrator
2. Module position's `layout` parameter in `<jdoc:include>` tag
3. File permissions (must be readable)
4. Template is assigned to correct pages

### Layout Works But Looks Wrong

**Check:**
1. CSS is loaded: inspect element and check for `.{extension}-{view}__` classes
2. `template.css` is up to date
3. Browser cache is cleared
4. CSS variables are defined in template

---

## References

- [Joomla Docs: Layout Overrides](https://docs.joomla.org/Layout_Overrides_in_Joomla)
- [Joomla Docs: Alternative Layouts](https://docs.joomla.org/J3.x:How_to_use_the_alternative_layout_feature)
- [MODULE_OVERRIDES.md](MODULE_OVERRIDES.md) - Complete override inventory
- [CSS_VARIABLES.md](CSS_VARIABLES.md) - Template styling system

---

## Version History

- **03.08.04**: Created OVERRIDE_PHILOSOPHY.md document
- **03.08.03**: Removed mod_search override to align with philosophy
- **03.08.02**: Removed standard Joomla module overrides for proper language loading
- **Earlier**: Renamed all overrides from default.php to mobile.php (21 files)
