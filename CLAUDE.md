# What This Repo Is

MokoCassiopeia is a modern, lightweight Joomla template that extends Cassiopeia (Joomla's default template) with enhanced features while maintaining maximum upgrade compatibility. It is used by Joomla 4.4.x and 5.x site administrators who want Font Awesome 7, Bootstrap 5 helpers, dark mode theming, and table of contents features without breaking core Joomla upgrades. This is NOT a standalone theme framework, NOT a template builder, and NOT a general-purpose UI library—it is specifically a Joomla site template extension that must be installed via Joomla's Extension Manager. Repository: https://github.com/mokoconsulting-tech/MokoCassiopeia

# Repo Structure

```
MokoCassiopeia/
├── .github/              # GitHub workflows (CI, testing, release), Copilot instructions
├── docs/                 # Comprehensive documentation (guides, philosophy, CSS reference)
├── scripts/              # Build scripts (build-release.sh, create-client-fork.sh)
├── src/                  # MAIN WORKING DIRECTORY: template source files
│   ├── index.php         # Main template rendering file
│   ├── templateDetails.xml  # Joomla manifest (metadata, params, files)
│   ├── joomla.asset.json    # Web Asset Manager registration
│   ├── language/         # Frontend language files (en-GB, en-US .ini and .sys.ini)
│   ├── html/             # Alternative layout overrides (never replace defaults!)
│   └── media/            # CSS, JS, images, fonts, vendor libraries
├── templates/            # Color scheme templates for client customization
├── tests/                # Codeception acceptance and unit tests
├── phpcs.xml             # PHP_CodeSniffer configuration (PSR-12 + Joomla standards)
└── phpstan.neon          # PHPStan static analysis configuration
```

# File Header Requirements

## Header Format

All source files MUST include this standardized copyright header:

### PHP Files (Full Header)

```php
<?php
/* Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

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
 INGROUP: MokoCassiopeia.Template
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 PATH: ./templates/mokocassiopeia/filename.php
 VERSION: XX.YY.ZZ
 BRIEF: Brief description of file purpose
 */

defined('_JEXEC') or die;
```

### JavaScript Files

```javascript
/* Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later


 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia
 PATH: ./media/templates/site/mokocassiopeia/js/filename.js
 VERSION: XX.YY.ZZ
 BRIEF: Brief description of file purpose
 */

(function (win, doc) {
	"use strict";
	// Implementation
})(window, document);
```

### CSS Files

```css
/* Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later


 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Styles
 PATH: ./media/templates/site/mokocassiopeia/css/filename.css
 VERSION: XX.YY.ZZ
 BRIEF: Brief description of file purpose
 */
```

### Markdown Documentation

```markdown
<!--
 Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 
 SPDX-License-Identifier: GPL-3.0-or-later
 
 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Documentation
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 FILE: docs/FILENAME.md
 VERSION: XX.YY.ZZ
 BRIEF: Brief description
-->
```

## FILE INFORMATION Block Fields

- **DEFGROUP**: Top-level group (always `Joomla.Template.Site`)
- **INGROUP**: Subgroup (e.g., `MokoCassiopeia.Template`, `MokoCassiopeia.Documentation`)
- **REPO**: GitHub repository URL (required in docs, optional in code)
- **PATH** or **FILE**: Relative path from repository root
- **VERSION**: Semantic version `XX.YY.ZZ`
- **BRIEF**: One-line description of file purpose

## Exempt Files

These file types DO NOT require headers:
- `joomla.asset.json` and other JSON data files (metadata in `x-header` field instead)
- Binary files (images, fonts, compiled assets)
- Third-party vendor libraries in `src/media/vendor/`
- Generated files (minified CSS/JS with `.min.` in name)
- Empty placeholder files

## When to Use Full vs Minimal Header

- **Full header with GPL notice**: Required in all PHP files (use example above)
- **Minimal header without GPL notice**: JavaScript and CSS files (shorter version shown above)
- **Markdown format**: All documentation files in `docs/`

# Coding Standards

## Indentation

From `.editorconfig`:
- **Default**: Tabs with 2-space visual width
- **PHP**: Tabs (PSR-12 uses tabs, Joomla uses tabs)
- **JavaScript**: Tabs with 2-space visual width
- **CSS**: Tabs with 2-space visual width
- **JSON/YAML**: Tabs with 2-space visual width
- **Markdown**: Spaces (for compatibility), trim_trailing_whitespace = false
- **Makefiles**: Always tabs

## Line Length

From `phpcs.xml`:
- **General**: No strict limit (Generic.Files.LineLength excluded)
- **Practical guideline**: Keep lines under 120 characters when reasonable
- **Long lines accepted for**: URLs, array definitions, Joomla HTML helpers

## Naming Conventions

### PHP (Joomla Standards + PSR-12)

- **Classes**: `PascalCase` (e.g., `TemplateHelper`)
- **Methods**: `camelCase` (e.g., `getThemeOptions()`)
- **Variables**: `$camelCase` or `$snake_case` (Joomla prefers snake_case for local vars)
- **Constants**: `UPPER_SNAKE_CASE` (e.g., `THEME_LIGHT_MODE`)
- **Files**: Lowercase with hyphens for layouts (e.g., `mobile.php`, `toc-left.php`)
- **Private properties**: Prefix with underscore (e.g., `$_privateData`)

### JavaScript (ES6+)

- **Functions**: `camelCase` (e.g., `applyTheme()`)
- **Constants**: `UPPER_SNAKE_CASE` or `camelCase` (e.g., `storageKey`)
- **Classes**: `PascalCase` (e.g., `ThemeController`)
- **Files**: Lowercase with hyphens (e.g., `template.js`, `menu-metismenu.js`)

### CSS

- **Classes**: Kebab-case (e.g., `.theme-toggle`, `.fab-button`)
- **IDs**: Kebab-case (e.g., `#main-content`)
- **CSS Variables**: Kebab-case with double hyphen prefix (e.g., `--color-primary`, `--body-bg`)
- **Files**: Lowercase with underscores for variants (e.g., `colors_standard.css`, `colors_custom_light.css`)

### General File Naming

- **Alternative layouts**: Descriptive name + `.php` (e.g., `mobile.php`, `mainmenu.php`, `toc-left.php`)
- **NEVER use**: `default.php` (replaces core layout—FORBIDDEN)
- **Scripts**: Lowercase with hyphens (e.g., `build-release.sh`, `create-client-fork.sh`)

## Primary Language

- **PHP**: All new template logic, Joomla integration code
- **JavaScript**: All new client-side functionality (ES6+ syntax)
- **CSS**: All new styling (CSS variables for theming)
- **Bash**: Build and automation scripts (`.sh` files)

# Language-Specific Requirements

## PHP

### Type Hints

Required for all function signatures in PHP 8.0+ code:

```php
public function getThemeOption(string $key, mixed $default = null): mixed
{
    return $this->params->get($key, $default);
}
```

### Docstring Format

Use DocBlocks for all classes, methods, and functions:

```php
/**
 * Apply theme settings to document
 *
 * @param   string  $theme    Theme name (light|dark)
 * @param   object  $params   Template parameters
 * 
 * @return  void
 * 
 * @since   3.6.0
 */
public function applyTheme(string $theme, object $params): void
{
    // Implementation
}
```

Required DocBlock sections:
- Brief description (first line)
- `@param` for each parameter (type, name, description)
- `@return` for return value
- `@since` for version introduced
- `@throws` if exceptions are thrown

### Script Structure

All PHP files must follow this pattern:

```php
<?php
/* [Copyright header - see above] */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
// Other imports

/** @var Joomla\CMS\Document\HtmlDocument $this */

// Constants (if needed)
const THEME_LIGHT = 'light';

// Implementation
$app = Factory::getApplication();
```

### Error Handling

- Use `defined('_JEXEC') or die;` at the start of EVERY PHP file
- Catch exceptions with specific types: `catch (RuntimeException $e)`
- Log errors using Joomla's logging: `JLog::add($message, JLog::ERROR)`
- Never expose internal paths or sensitive data in error messages
- Use `try-catch` blocks for database operations

## JavaScript

### Type Hints

Use JSDoc type annotations:

```javascript
/**
 * Apply theme to document root
 * @param {"light"|"dark"} theme - Theme name
 * @returns {void}
 */
function applyTheme(theme) {
    root.setAttribute("data-bs-theme", theme);
}
```

### Docstring Format

```javascript
/**
 * Toggle theme between light and dark modes
 * 
 * Toggles the theme attribute on the root element and updates
 * localStorage with the new preference.
 * 
 * @param {Event} event - Click event from toggle button
 * @returns {void}
 */
function toggleTheme(event) {
    // Implementation
}
```

### Script Structure

```javascript
/* [Copyright header - see above] */

(function (win, doc) {
	"use strict";
	
	// Constants
	const STORAGE_KEY = "theme";
	const root = doc.documentElement;
	
	// Private functions
	function applyTheme(theme) {
		// Implementation
	}
	
	// Public API (if needed)
	win.TemplateAPI = {
		applyTheme: applyTheme
	};
	
})(window, document);
```

### Error Handling

- Always use `"use strict";` at the top of IIFE
- Wrap localStorage access in try-catch (may throw in private mode)
- Use `console.error()` for logging errors (not `console.log()`)
- Validate function parameters at the start
- Return early on error conditions

## CSS

No specific requirements beyond standard CSS syntax. Use CSS variables for theming (see `docs/CSS_VARIABLES.md`).

# Commit Message Format

No `.gitmessage` file exists. Follow this format:

```
Brief summary (50 chars or less)

Detailed explanation if needed:
- What changed
- Why it changed  
- Impact of the change

Refs: #issue-number (if applicable)
```

**Good examples:**

```
Fix language file installation paths in templateDetails.xml

- Remove folder attribute from <languages> section
- Update paths to be relative from package root
- Ensures proper installation to JOOMLA_ROOT/language/

Refs: #42
```

```
Add dark mode color variables for custom themes

- Add --color-primary-dark, --color-secondary-dark
- Update theme toggle to respect custom colors
- Document new variables in CSS_VARIABLES.md
```

**Bad examples:**

```
Update files
```

```
WIP
```

```
Fixed bug
```

## Commit Rules

- Keep subject line under 50 characters
- Use imperative mood ("Add feature" not "Added feature")
- Capitalize first letter
- No period at end of subject
- Blank line between subject and body
- Wrap body at 72 characters
- Explain WHAT and WHY, not HOW (code shows HOW)

# Running Validation

Before committing, run these commands from repository root:

```bash
# 1. PHP CodeSniffer (code style)
phpcs --standard=phpcs.xml src/

# 2. PHPStan (static analysis)
phpstan analyse --configuration=phpstan.neon

# 3. XML validation (template manifest)
xmllint --noout src/templateDetails.xml

# 4. Check file headers (if script exists)
# ./scripts/validate-headers.sh

# 5. Run tests (if Codeception installed)
codecept run
```

If you don't have tools installed:

```bash
# Install PHP quality tools globally
composer global require "squizlabs/php_codesniffer:^3.0" --with-all-dependencies
composer global require "phpstan/phpstan:^1.0" --with-all-dependencies

# Install Codeception
composer global require "codeception/codeception" --with-all-dependencies
```

**Note:** CI runs these automatically on push, but running locally saves time.

# Contribution Workflow

1. **Fork** the repository on GitHub
2. **Clone** your fork locally: `git clone https://github.com/YOUR-USERNAME/MokoCassiopeia.git`
3. **Create branch** from current development branch: `git checkout -b feature/your-feature-name`
   - Branch naming: `feature/description`, `fix/issue-description`, `docs/topic`
4. **Make changes** in the `src/` directory (this is the working copy)
5. **Run validation** (see commands above)
6. **Commit changes** with descriptive messages
7. **Push to your fork**: `git push origin feature/your-feature-name`
8. **Open Pull Request** on GitHub targeting the appropriate base branch

## Branch Strategy

- **main**: Stable releases only (protected)
- **version/XX.YY**: Version-specific branches (protected)
- **dev/XX.YY.ZZ**: Active development branches
- **rc/XX.YY.ZZ**: Release candidate branches
- **feature/**, **fix/**, **docs/**: Working branches

## Merge Strategy

- Pull requests use **squash merge** to main/version branches
- Commits go to development branches first, then promoted through rc → version → main
- NEVER commit directly to protected branches (main, version/*)

# PR Checklist

Before opening a pull request:

- [ ] Code follows Joomla coding standards (PSR-12 + Joomla)
- [ ] All files have proper copyright headers
- [ ] PHP files have `defined('_JEXEC') or die;` at top
- [ ] No `default.php` layout files (use alternative layout names)
- [ ] Language files: metadata in `.sys.ini`, runtime strings in `.ini`
- [ ] Assets registered in `joomla.asset.json` (not inline in template)
- [ ] CSS uses CSS variables for colors (supports light/dark themes)
- [ ] PHP CodeSniffer passes: `phpcs --standard=phpcs.xml src/`
- [ ] PHPStan passes: `phpstan analyse --configuration=phpstan.neon`
- [ ] Tested in Joomla 4.4.x AND 5.x
- [ ] Tested in light mode AND dark mode
- [ ] Documentation updated if adding features
- [ ] No hardcoded absolute paths (use Joomla path constants)
- [ ] No credentials, API keys, or secrets in code
- [ ] Version numbers NOT added to revision history tables
- [ ] Alternative layouts documented with activation instructions

# What NOT to Do

## Absolutely Forbidden

- ❌ **NEVER create `default.php` layout files** - This replaces core layouts and breaks upgrades. Use alternative layout names like `mobile.php`, `mainmenu.php`
- ❌ **NEVER commit without copyright headers** - All source files must have proper headers
- ❌ **NEVER add `folder` attribute to `<languages>` section in templateDetails.xml** - Language file paths must be relative from package root
- ❌ **NEVER put template metadata in `.ini` files** - Template name and description belong ONLY in `.sys.ini` files
- ❌ **NEVER hardcode absolute paths** - Use Joomla path constants (`JPATH_ROOT`, `JPATH_SITE`, etc.)
- ❌ **NEVER commit credentials or API keys** - Use Joomla's configuration management
- ❌ **NEVER modify vendor libraries** - Third-party code in `src/media/vendor/` is immutable
- ❌ **NEVER remove `defined('_JEXEC') or die;`** - This is a critical security check

## Strong Discouragements

- ⚠️ Avoid committing without running `phpcs` and `phpstan`
- ⚠️ Avoid adding version numbers to revision history tables (use VERSION metadata instead)
- ⚠️ Avoid inline styles or scripts (register assets in `joomla.asset.json`)
- ⚠️ Avoid hardcoded color values (use CSS variables: `--color-primary`, etc.)
- ⚠️ Avoid direct commits to `main` or `version/*` branches (use PRs)
- ⚠️ Avoid changing more than one concern per commit
- ⚠️ Avoid long lines when reasonable (aim for 120 chars)

## Common Mistakes

- Using spaces instead of tabs (check `.editorconfig`)
- Forgetting `SPDX-License-Identifier: GPL-3.0-or-later` in headers
- Mixing frontend strings (.ini) and metadata strings (.sys.ini)
- Creating layout overrides that replace defaults instead of providing alternatives
- Not testing in both Joomla 4.x and 5.x
- Not testing light/dark mode theme switching

# Key Policy Documents

Must-read before contributing:

1. **[OVERRIDE_PHILOSOPHY.md](./docs/OVERRIDE_PHILOSOPHY.md)** - CRITICAL: Explains why we NEVER replace default layouts and how alternative layouts work
2. **[QUICK_START.md](./docs/QUICK_START.md)** - 5-minute setup guide for first-time contributors
3. **[JOOMLA_DEVELOPMENT.md](./docs/JOOMLA_DEVELOPMENT.md)** - Complete development guide: testing, quality checks, deployment
4. **[WORKFLOW_GUIDE.md](./docs/WORKFLOW_GUIDE.md)** - Git workflow, branching strategy, CI/CD pipelines
5. **[CSS_VARIABLES.md](./docs/CSS_VARIABLES.md)** - Complete reference for theme customization
6. **[CONTRIBUTING.md](./CONTRIBUTING.md)** - Formal contribution guidelines and governance
7. **[SECURITY.md](./SECURITY.md)** - Security reporting procedures (never report publicly)
8. **[MODULE_OVERRIDES.md](./docs/MODULE_OVERRIDES.md)** - Documentation of all alternative layouts and activation instructions

## Related Documentation

- **README.md** - Overview, features, installation, configuration
- **CHANGELOG.md** - Version history and release notes
- **GOVERNANCE.md** - Project governance model and decision-making
- **CODE_OF_CONDUCT.md** - Community standards and expectations
- **CLIENT_FORK_README.md** - Guide for client-specific customization forks
