# GitHub Copilot Instructions for MokoCassiopeia

## Repository Context

MokoCassiopeia is a modern, lightweight Joomla template that extends Cassiopeia (Joomla's default template). It follows a strict **non-replacement philosophy** for maximum upgrade compatibility.

**Key Characteristics:**
- Joomla 4.4.x and 5.x compatible
- PHP 8.0+ required
- Built on Cassiopeia template
- Minimal core template overrides
- Alternative layout naming convention (not default replacements)
- GPL-3.0-or-later license

## Project Structure

```
MokoCassiopeia/
├── .github/              # GitHub workflows and configuration
├── docs/                 # Comprehensive documentation
├── scripts/              # Build and deployment scripts
├── src/                  # Template source files (main working directory)
│   ├── index.php         # Main template file
│   ├── templateDetails.xml  # Joomla template manifest
│   ├── joomla.asset.json    # Web Asset Manager configuration
│   ├── language/         # Frontend language files (en-GB, en-US)
│   ├── html/             # Alternative layout overrides
│   └── media/            # CSS, JS, images, fonts, vendors
├── templates/            # Custom color scheme templates
└── tests/                # Codeception tests
```

## Critical Conventions

### 1. Override Philosophy: Alternative Layouts Only

**NEVER replace default layouts.** All overrides must use alternative layout names.

✅ **Correct:**
- `mobile.php` (alternative layout)
- `mainmenu.php` (alternative layout for mod_menu)
- `toc-left.php`, `toc-right.php` (alternative layouts with TOC)

❌ **Incorrect:**
- `default.php` (replaces core layout - FORBIDDEN)
- Any file that replaces Cassiopeia's default behavior

**Rationale:** Ensures Joomla core updates don't break the template and gives users choice.

### 2. File Headers

All source files must include standardized copyright headers:

```php
<?php
/**
 * Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 * 
 * This file is part of a Moko Consulting project.
 * 
 * SPDX-License-Identifier: GPL-3.0-or-later
 * 
 * @defgroup   Joomla.Template.Site
 * @ingroup    MokoCassiopeia.Template
 * @brief      [Brief description]
 * @version    [Version number]
 */

defined('_JEXEC') or die;
```

### 3. Language Files

**Key Rules:**
- Template metadata (name, description) goes in `.sys.ini` files ONLY
- Frontend runtime strings go in `.ini` files
- Language files location: `src/language/{locale}/`
- NO `folder` attribute in `<languages>` section of templateDetails.xml
- Paths must be relative from package root (e.g., `language/en-GB/tpl_mokocassiopeia.sys.ini`)

**Example templateDetails.xml:**
```xml
<languages folder="language">
    <language tag="en-GB">en-GB/tpl_mokocassiopeia.ini</language>
    <language tag="en-GB">en-GB/tpl_mokocassiopeia.sys.ini</language>
</languages>
```

### 4. Hardcoded XML Description

The template description in `templateDetails.xml` is **hardcoded using CDATA**, not a language constant:

```xml
<description><![CDATA[Modern, lightweight Joomla template...]]></description>
```

**Rationale:** Ensures immediate availability during installation without language file dependency.

### 5. Version Format

Follow semantic versioning: `XX.YY.ZZ`
- XX: Major version
- YY: Minor version  
- ZZ: Patch version

**Examples:** `03.06.03`, `03.08.04`

## Coding Standards

### PHP

- **PSR-12 compliant** where not conflicting with Joomla standards
- **Joomla Coding Standards** for Joomla-specific code
- Use `defined('_JEXEC') or die;` at the top of every PHP file
- Type hints for PHP 8.0+ features
- Strict types declarations where appropriate

### JavaScript

- **ES6+** syntax
- Use `'use strict';`
- Prefer `const` and `let` over `var`
- Document functions with JSDoc comments
- Integrate with Joomla's Web Asset Manager

### CSS

- **CSS Variables** for theming (see `docs/CSS_VARIABLES.md`)
- Light/dark mode support via `data-bs-theme` attribute
- Bootstrap 5 utility classes
- Mobile-first responsive design
- Namespace custom classes to avoid conflicts

### Asset Management

All assets must be registered in `joomla.asset.json`:

```json
{
  "name": "template.mokocassiopeia.custom",
  "version": "1.0.0",
  "description": "Custom asset",
  "license": "GPL-3.0-or-later",
  "dependencies": ["core"],
  "js": ["js/custom.js"],
  "css": ["css/custom.css"]
}
```

## Development Workflow

### Branching Strategy

- **Development:** Work on feature branches
- **Branch naming:** `feature/description`, `fix/issue-description`
- **Protected branches:** Cannot commit directly to `main` or version branches
- See `docs/WORKFLOW_GUIDE.md` for complete workflow

### Commit Messages

```
Brief summary (50 chars or less)

Detailed explanation if needed:
- What changed
- Why it changed
- Impact of the change
```

**Example:**
```
Fix language file installation paths in templateDetails.xml

- Remove folder attribute from <languages> section
- Update paths to be relative from package root
- Ensures proper installation to JOOMLA_ROOT/language/
```

### Quality Checks

Before committing:
1. **PHP CodeSniffer:** `phpcs --standard=Joomla src/`
2. **PHPStan:** Static analysis for PHP code
3. **Pre-commit hooks:** Automatically run validation

## Testing

### Manual Testing
- Test in Joomla 4.4.x and 5.x
- Test on PHP 8.0, 8.1, 8.2
- Test light/dark mode switching
- Test responsive layouts (mobile/tablet/desktop)
- Test alternative layouts activation

### Test Environment
- Use local Joomla installation
- See `docs/JOOMLA_DEVELOPMENT.md` for setup

## Documentation Standards

### Markdown Files

All documentation must include:

1. **Copyright header**
```markdown
<!--
 Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 
 SPDX-License-Identifier: GPL-3.0-or-later
 
 # FILE INFORMATION
 DEFGROUP: [Group]
 INGROUP: [Subgroup]
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 FILE: [filename]
 VERSION: [version]
 BRIEF: [Brief description]
-->
```

2. **Metadata section** (at end)
3. **Revision history table** (at end)

### Code Comments

- Use DocBlocks for functions and classes
- Explain "why" not just "what"
- Keep comments up-to-date with code changes

## Common Patterns

### Theme System Integration

Use CSS variables for colors:
```css
:root[data-bs-theme="light"] {
  --color-primary: #1e40af;
  --body-bg: #ffffff;
}

:root[data-bs-theme="dark"] {
  --color-primary: #60a5fa;
  --body-bg: #1f2937;
}
```

### Alternative Layout Structure

```php
<?php
/**
 * Alternative layout: mobile
 * Activated via: Advanced → Alternative Layout → "mobile"
 */
defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

// Layout implementation
?>
```

### JavaScript Asset Loading

```javascript
// Register in joomla.asset.json, then use:
Joomla.getOptions('template.mokocassiopeia.options');
```

## Build and Release

### Local Build
```bash
cd scripts
./build-release.sh
```

### Automated Release
- Tags trigger GitHub Actions workflow
- Format: `XX.YY.ZZ`
- Generates ZIP packages with checksums
- Updates `updates.xml` automatically

## Important Don'ts

❌ **Never:**
- Replace default Joomla layouts (use alternative layouts)
- Commit without running code quality checks
- Add version numbers to revision history (use VERSION metadata)
- Hardcode absolute paths (use Joomla path constants)
- Remove copyright headers
- Modify `vendor/` directory contents
- Change language constants location (.sys.ini vs .ini)
- Add `folder` attribute to `<languages>` in templateDetails.xml

## Important Do's

✅ **Always:**
- Use alternative layout names (mobile.php, mainmenu.php, etc.)
- Include copyright headers in all files
- Test in both Joomla 4.x and 5.x
- Test light/dark mode themes
- Update documentation when changing functionality
- Follow semantic versioning
- Register assets in joomla.asset.json
- Use CSS variables for theming
- Keep minimal overrides philosophy
- Document activation steps for alternative layouts

## Key Documentation References

- **Quick Start:** `docs/QUICK_START.md` - First-time setup
- **Override Philosophy:** `docs/OVERRIDE_PHILOSOPHY.md` - Critical reading
- **Development Guide:** `docs/JOOMLA_DEVELOPMENT.md` - Complete dev workflow
- **CSS Variables:** `docs/CSS_VARIABLES.md` - Theming reference
- **Workflow Guide:** `docs/WORKFLOW_GUIDE.md` - Git workflow

## Security Considerations

- Follow `SECURITY.md` for security issues
- Never commit credentials or API keys
- Validate and sanitize all user inputs
- Use Joomla's security features (CSRF tokens, etc.)
- Keep dependencies updated

## Client Forks

For client-specific customizations:
- Use `CLIENT_FORK_README.md` template
- Follow fork workflow in `docs/CLIENT_FORK_WORKFLOW.md`
- Keep custom color files in `media/.../css/colors/` (gitignored)
- Document client-specific changes separately

## License Compliance

All code contributions must be:
- GPL-3.0-or-later compatible
- Properly attributed (third-party code)
- Include SPDX license identifiers
- Maintain existing copyright notices

## Contact and Support

- **Issues:** GitHub Issues
- **Discussions:** GitHub Discussions  
- **Security:** Follow SECURITY.md procedures
- **Maintainer:** Moko Consulting Engineering

---

**Last Updated:** 2026-03-04  
**Repository:** https://github.com/mokoconsulting-tech/MokoCassiopeia  
**Version:** 03.08.04
