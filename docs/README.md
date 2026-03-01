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
 FILE: docs/README.md
 VERSION: 03.08.00
 BRIEF: Documentation index for MokoCassiopeia template
 PATH: /docs/README.md
-->

# MokoCassiopeia Documentation

This directory contains comprehensive documentation for the MokoCassiopeia Joomla template.

## Documentation Overview

### Developer Documentation

* **[Quick Start Guide](QUICK_START.md)** - Get up and running in 5 minutes
  * Development environment setup
  * Essential commands and workflows
  * First-time contributor guide

* **[Workflow Guide](WORKFLOW_GUIDE.md)** - Complete workflow reference
  * Git branching strategy
  * Development workflow
  * Pull request guidelines

* **[Release Process](RELEASE_PROCESS.md)** ⭐ - Complete release documentation
  * Automated release workflow with GitHub Actions
  * Manual release procedures
  * Update server configuration
  * Testing and rollback procedures
  * Build scripts and tools

* **[Joomla Development Guide](JOOMLA_DEVELOPMENT.md)** - Joomla-specific development
  * Testing with Codeception
  * PHP quality checks (PHPStan, PHPCS)
  * Joomla extension packaging
  * Multi-version testing

* **[CSS Variables Reference](CSS_VARIABLES.md)** - Complete CSS customization guide
  * All available CSS variables
  * Custom color palette creation
  * Usage examples and tips
  * Light and dark mode theming

* **[Module & Component Overrides](MODULE_OVERRIDES.md)** - Mobile-responsive overrides guide
  * 16 module overrides + 12 component overrides
  * VirtueMart, Community Builder, JEM, Kunena, industry extensions
  * Mobile-first responsive design patterns
  * Accessibility features and customization

* **[Override Philosophy](OVERRIDE_PHILOSOPHY.md)** ⭐ - Alternative layouts, not replacements
  * Why overrides use `mobile.php` naming instead of `default.php`
  * How to activate alternative layouts in Joomla
  * Benefits of non-replacing overrides
  * Developer guidelines and best practices

* **[Roadmap](ROADMAP.md)** - Version-specific roadmap
  * Current features (v03.07.00)
  * Feature evolution timeline
  * Planned enhancements
  * Development priorities

### User Documentation

For end-user documentation, installation instructions, and feature guides, see the main [README.md](../README.md) in the repository root.

### Client Fork Documentation

* **[Client Fork Workflow](CLIENT_FORK_WORKFLOW.md)** - Automated client fork creation
  * GitHub Actions workflow for instant fork setup
  * Local bash script alternative
  * Complete setup automation in minutes
  * Post-setup customization guide

* **[Client Fork Guide](../CLIENT_FORK_README.md)** - Comprehensive guide for client custom code forks
  * Setting up custom branding and colors
  * Maintaining fork-specific customizations
  * Syncing with upstream MokoCassiopeia
  * Deployment and development workflows
  * Template README for client forks

## Project Structure

```
moko-cassiopeia/
├── docs/                    # Documentation (you are here)
│   ├── README.md           # This file - documentation index
│   ├── QUICK_START.md      # Quick start guide for developers
│   ├── WORKFLOW_GUIDE.md   # Development workflow guide
│   ├── JOOMLA_DEVELOPMENT.md # Joomla-specific development guide
│   ├── CSS_VARIABLES.md    # CSS variables reference
│   ├── MODULE_OVERRIDES.md # Module & component overrides guide
│   └── ROADMAP.md          # Version-specific roadmap
├── src/                     # Template source code (Joomla template root)
│   ├── component.php       # Component template
│   ├── index.php           # Main template file
│   ├── offline.php         # Offline template
│   ├── error.php           # Error page template
│   ├── templateDetails.xml # Template manifest
│   ├── html/               # Module & component overrides (16 modules, 12 components)
│   ├── media/              # Assets (CSS, JS, images, fonts)
│   │   ├── css/            # Stylesheets
│   │   │   └── colors/     # Color schemes
│   │   │       ├── light/  # Light mode color files (colors_standard.css, colors_custom.css)
│   │   │       └── dark/   # Dark mode color files (colors_standard.css, colors_custom.css)
│   │   ├── js/             # JavaScript files
│   │   ├── images/         # Image assets
│   │   └── fonts/          # Font files
│   ├── language/           # Frontend language files
│   │   ├── en-GB/         # English (UK) translations
│   │   └── en-US/         # English (US) translations
│   └── administrator/      # Backend files
│       └── language/       # Backend language files
│           ├── en-GB/     # English (UK) system translations
│           └── en-US/     # English (US) system translations
├── templates/               # Template files for customization
│   ├── colors_custom.css       # Custom color palette template (copy to src/media/css/colors/)
│   ├── CLIENT_FORK_README_TEMPLATE.md # Template for client fork docs
│   └── README.md               # Guide to using templates
├── scripts/                 # Build and utility scripts
├── tests/                   # Automated tests
├── CLIENT_FORK_README.md    # Client fork guide
└── .github/                # GitHub configuration and workflows
```

## Contributing

Before contributing, please read:

1. **[CONTRIBUTING.md](../CONTRIBUTING.md)** - Contribution guidelines and standards
2. **[CODE_OF_CONDUCT.md](../CODE_OF_CONDUCT.md)** - Community standards and expectations
3. **[SECURITY.md](../SECURITY.md)** - Security policy and reporting procedures

## Standards Compliance

This project adheres to [MokoStandards](https://github.com/mokoconsulting-tech/MokoStandards) for:

* Coding standards and formatting
* Documentation requirements
* Git workflow and branching
* CI/CD pipeline configuration
* Security scanning and dependency management

## Additional Resources

* **Repository**: [https://github.com/mokoconsulting-tech/MokoCassiopeia](https://github.com/mokoconsulting-tech/MokoCassiopeia)
* **Issue Tracker**: [GitHub Issues](https://github.com/mokoconsulting-tech/MokoCassiopeia/issues)
* **Changelog**: [CHANGELOG.md](../CHANGELOG.md)
* **License**: [GPL-3.0-or-later](../LICENSE)

## Support

* **Email**: hello@mokoconsulting.tech
* **Website**: https://mokoconsulting.tech/support/joomla-cms/moko-cassiopeia-roadmap

---

## Metadata

* Document: docs/README.md
* Repository: [https://github.com/mokoconsulting-tech/MokoCassiopeia](https://github.com/mokoconsulting-tech/MokoCassiopeia)
* Path: /docs/README.md
* Owner: Moko Consulting
* Version: 03.07.00
* Status: Active
* Effective Date: 2026-01-30
* Classification: Public Open Source Documentation

## Revision History

| Date       | Change Summary                                        | Author          |
| ---------- | ----------------------------------------------------- | --------------- |
| 2026-02-22 | Added MODULE_OVERRIDES.md reference, updated version to 03.07.00 | GitHub Copilot |
| 2026-01-30 | Added CSS Variables reference, updated version to 03.06.03 | GitHub Copilot |
| 2026-01-09 | Initial documentation index created for MokoStandards compliance. | GitHub Copilot |
| 2026-01-27 | Updated with roadmap link and version to 03.05.01.   | GitHub Copilot  |
