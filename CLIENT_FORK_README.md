<!-- Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later

 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Documentation
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 FILE: ./CLIENT_FORK_README.md
 VERSION: 03.06.03
 BRIEF: Template README for client custom code forks
 -->

# [CLIENT NAME] - MokoCassiopeia Custom Fork

**Custom Joomla Template Fork for [CLIENT NAME]**

This is a customized fork of the [MokoCassiopeia](https://github.com/mokoconsulting-tech/MokoCassiopeia) Joomla template, tailored specifically for [CLIENT NAME]'s website.

---

## 📋 About This Fork

This repository contains client-specific customizations built on top of the MokoCassiopeia template. The template provides a modern, lightweight enhancement layer for Joomla with advanced theming, Font Awesome 7, Bootstrap 5, and dark mode support.

### Customization Strategy

This fork maintains the following customizations:
- **Custom Color Schemes**: Brand-specific colors for light and dark modes
- **Custom Code**: Client-specific HTML, CSS, and JavaScript customizations
- **Configuration**: Pre-configured template settings for the client environment

All customizations are designed to be preserved when syncing with upstream MokoCassiopeia updates.

---

## 🚀 Quick Start

### Prerequisites

- **Joomla**: 4.4.x or 5.x
- **PHP**: 8.0 or higher
- **Git**: For version control and syncing with upstream
- **Local Development**: MAMP/XAMPP/Docker for local testing

### Installation for Development

1. **Clone this repository**:
   ```bash
   git clone [YOUR-FORK-URL]
   cd [YOUR-FORK-NAME]
   ```

2. **Set up upstream remote** (for syncing updates):
   ```bash
   git remote add upstream https://github.com/mokoconsulting-tech/MokoCassiopeia.git
   git fetch upstream
   ```

3. **Install into Joomla**:
   - Copy the `src/` directory contents to your Joomla installation:
     - `src/templates/` → `[joomla]/templates/`
     - `src/media/` → `[joomla]/media/templates/site/mokocassiopeia/`
     - `src/language/` → `[joomla]/language/`
     - `src/administrator/language/` → `[joomla]/administrator/language/`

4. **Enable the template**:
   - Log into Joomla admin
   - Navigate to **System → Site Templates**
   - Set **MokoCassiopeia** as the default template

---

## 🎨 Custom Branding & Colors

### Custom Color Schemes

This fork includes custom color schemes specific to [CLIENT NAME]'s brand:

**Location**:
- Light mode: `src/media/css/colors/light/colors_custom.css`
- Dark mode: `src/media/css/colors/dark/colors_custom.css`

**Note**: These files are gitignored in the upstream repository to prevent conflicts, but are tracked in this fork.

### Modifying Brand Colors

1. **Edit the custom color files**:
   ```bash
   # Light mode colors
   edit src/media/css/colors/light/colors_custom.css
   
   # Dark mode colors
   edit src/media/css/colors/dark/colors_custom.css
   ```

2. **Key variables to customize**:
   ```css
   :root[data-bs-theme="light"] {
     --color-primary: #YOUR-BRAND-COLOR;
     --accent-color-primary: #YOUR-ACCENT-COLOR;
     --color-link: #YOUR-LINK-COLOR;
     --nav-bg-color: #YOUR-NAV-BG;
   }
   ```

3. **Test your changes**:
   - Clear Joomla cache: System → Clear Cache
   - Clear browser cache (Ctrl+Shift+R / Cmd+Shift+R)
   - View your site in light and dark modes

### Available CSS Variables

For a complete reference of all customizable CSS variables, see the [CSS Variables Documentation](./docs/CSS_VARIABLES.md) in the upstream repository.

---

## 🔧 Custom Code Injection

### Using custom.php

The `src/templates/custom.php` file allows for custom PHP functions and HTML snippets:

**Location**: `src/templates/custom.php`

**Example Use Cases**:
- Custom helper functions
- Client-specific HTML snippets
- Custom console logging
- Integration code

**Example**:
```php
<?php
// Custom helper function
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>
<!--
    Custom HTML code can be added here
-->
```

### Custom Code via Joomla Template Settings

You can also inject custom code via the Joomla admin interface:

1. Navigate to **System → Site Templates → MokoCassiopeia**
2. Go to the **Custom Code** tab
3. Add custom HTML/CSS/JS in:
   - **Custom Head Start**: Injected at the beginning of `<head>`
   - **Custom Head End**: Injected at the end of `<head>`

This approach is ideal for:
- Analytics tracking codes
- Custom meta tags
- External script includes
- Custom CSS snippets

---

## 🔄 Syncing with Upstream Updates

To keep your fork up-to-date with new features and bug fixes from the upstream MokoCassiopeia repository:

### 1. Fetch Upstream Changes

```bash
# Ensure upstream remote is configured
git remote -v
# If upstream is not listed, add it:
# git remote add upstream https://github.com/mokoconsulting-tech/MokoCassiopeia.git

# Fetch latest changes
git fetch upstream
```

### 2. Review Changes

```bash
# See what changed in upstream
git log HEAD..upstream/main --oneline

# Review the diff
git diff HEAD..upstream/main
```

### 3. Merge Upstream Changes

```bash
# Switch to your main branch
git checkout main

# Merge upstream changes
git merge upstream/main

# Or rebase (preserves cleaner history):
# git rebase upstream/main
```

### 4. Resolve Conflicts

If conflicts occur (typically in custom files):

1. **Check conflict status**:
   ```bash
   git status
   ```

2. **Resolve conflicts manually** in your editor:
   - Look for conflict markers: `<<<<<<<`, `=======`, `>>>>>>>`
   - Keep your custom changes
   - Remove conflict markers

3. **Complete the merge**:
   ```bash
   git add .
   git commit -m "Merge upstream updates and resolve conflicts"
   ```

### 5. Test After Merging

- Clear Joomla cache
- Test critical functionality:
  - Homepage loads correctly
  - Custom colors are preserved
  - Dark mode toggle works
  - Navigation functions properly
  - Custom code still executes

### Protected Files

The following files contain your customizations and should be carefully reviewed during merges:

- `src/media/css/colors/light/colors_custom.css` (custom light mode colors)
- `src/media/css/colors/dark/colors_custom.css` (custom dark mode colors)
- `src/templates/custom.php` (custom PHP code)
- Template configuration (stored in Joomla database, not in files)

---

## 📦 Building & Deployment

### Creating a Template Package

To create an installable ZIP package of your customized template:

1. **Prepare the package**:
   ```bash
   cd src
   zip -r ../mokocassiopeia-[CLIENT-NAME]-[VERSION].zip . -x "*.git*" "*.DS_Store"
   ```

2. **Install via Joomla**:
   - Upload the ZIP file via **System → Install → Extensions**
   - Or manually copy files to the Joomla installation

### Deployment to Production

**Recommended Deployment Methods**:

1. **Via Joomla Extension Manager** (Easiest):
   - Create a ZIP package as described above
   - Upload via Joomla admin interface
   - The template will automatically overwrite the existing installation

2. **Via FTP/SFTP**:
   - Upload changed files directly to the server
   - Clear Joomla cache after deployment

3. **Via Git** (Advanced):
   - Push changes to a deployment branch
   - Use Git hooks or CI/CD to deploy to production
   - Ensure proper file permissions

**Post-Deployment Checklist**:
- [ ] Clear Joomla cache (System → Clear Cache)
- [ ] Test homepage
- [ ] Test navigation and menus
- [ ] Verify custom colors appear correctly
- [ ] Test dark mode toggle
- [ ] Check mobile responsiveness
- [ ] Verify analytics tracking (if enabled)

---

## 🛠 Local Development Setup

### Setting Up a Local Joomla Environment

1. **Install a local server stack**:
   - **MAMP** (Mac/Windows): https://www.mamp.info/
   - **XAMPP** (Cross-platform): https://www.apachefriends.org/
   - **Docker**: https://github.com/joomla-docker/docker-joomla

2. **Install Joomla**:
   - Download Joomla from https://downloads.joomla.org/
   - Extract to your local server's web directory
   - Follow the Joomla installation wizard

3. **Install this template**:
   - Copy files from this repository to your Joomla installation
   - Or upload the ZIP package via Joomla's Extension Manager

4. **Enable development mode**:
   - Edit `configuration.php`:
     ```php
     public $debug = '1';
     public $error_reporting = 'maximum';
     ```

### Development Workflow

1. **Make changes** to template files in your local Joomla installation
2. **Test changes** in your browser
3. **Copy changes back** to this repository:
   ```bash
   # From Joomla installation
   cp [joomla]/templates/mokocassiopeia/* [repo]/src/templates/
   cp [joomla]/media/templates/site/mokocassiopeia/css/* [repo]/src/media/css/
   ```
4. **Commit and push** to your fork
5. **Deploy** to staging/production when ready

### Quick Testing Commands

```bash
# Clear Joomla cache from command line
rm -rf [joomla]/cache/*
rm -rf [joomla]/administrator/cache/*

# Watch for CSS changes (if using a build tool)
# npm run watch
```

---

## 📝 Customization Checklist

Use this checklist when setting up or modifying your custom fork:

### Initial Setup
- [ ] Fork the MokoCassiopeia repository
- [ ] Update this README with client name and details
- [ ] Configure custom brand colors
- [ ] Test light and dark modes
- [ ] Add custom code if needed
- [ ] Configure template settings in Joomla
- [ ] Set up analytics tracking (if required)
- [ ] Test on multiple devices and browsers

### Ongoing Maintenance
- [ ] Sync with upstream periodically (monthly recommended)
- [ ] Review upstream changelog for breaking changes
- [ ] Test thoroughly after merging upstream updates
- [ ] Keep this README updated with customization notes
- [ ] Document any client-specific configurations
- [ ] Maintain backup before major updates

---

## 📚 Documentation Resources

### MokoCassiopeia Documentation

- **[Main README](https://github.com/mokoconsulting-tech/MokoCassiopeia/blob/main/README.md)** - Features and overview
- **[CSS Variables Reference](./docs/CSS_VARIABLES.md)** - Complete CSS customization guide
- **[Development Guide](./docs/JOOMLA_DEVELOPMENT.md)** - Development and testing
- **[Quick Start](./docs/QUICK_START.md)** - Quick setup guide
- **[Changelog](./CHANGELOG.md)** - Version history

### Joomla Resources

- **[Joomla Documentation](https://docs.joomla.org/)** - Official Joomla docs
- **[Joomla Templates](https://docs.joomla.org/J4.x:How_to_Create_a_Joomla_Template)** - Template development guide
- **[Cassiopeia Documentation](https://docs.joomla.org/J4.x:Cassiopeia)** - Parent template docs

---

## 🔒 Security & Best Practices

### Security Considerations

1. **Keep Joomla Updated**: Always run the latest stable Joomla version
2. **Update Dependencies**: Regularly sync with upstream MokoCassiopeia for security patches
3. **Secure Custom Code**: Review all custom code for security vulnerabilities
4. **Use HTTPS**: Always serve production sites over HTTPS
5. **Regular Backups**: Maintain regular backups of both files and database

### Best Practices

1. **Version Control**: Commit changes frequently with clear messages
2. **Testing**: Always test changes locally before deploying to production
3. **Documentation**: Document all customizations in this README
4. **Code Review**: Have changes reviewed before deploying to production
5. **Staging Environment**: Use a staging site to test updates before production

---

## 📞 Support & Contact

### Client-Specific Support

**Client Contact**: [CLIENT CONTACT INFO]  
**Developer Contact**: [DEVELOPER CONTACT INFO]  
**Hosting Provider**: [HOSTING INFO]

### Upstream MokoCassiopeia Support

- **Repository**: https://github.com/mokoconsulting-tech/MokoCassiopeia
- **Issues**: https://github.com/mokoconsulting-tech/MokoCassiopeia/issues
- **Documentation**: https://github.com/mokoconsulting-tech/MokoCassiopeia/blob/main/README.md
- **Moko Consulting**: https://mokoconsulting.tech

---

## 📄 License

This fork maintains the original GPL-3.0-or-later license from MokoCassiopeia.

- **MokoCassiopeia**: GPL-3.0-or-later
- **Client Customizations**: GPL-3.0-or-later (or as specified by client agreement)
- **Third-Party Libraries**: See [Included Libraries](https://github.com/mokoconsulting-tech/MokoCassiopeia#-included-libraries)

---

## 📊 Fork Information

- **Upstream Repository**: https://github.com/mokoconsulting-tech/MokoCassiopeia
- **Fork Repository**: [YOUR-FORK-URL]
- **Client**: [CLIENT NAME]
- **Created**: [DATE]
- **Last Synced with Upstream**: [DATE]
- **Current Version**: 03.06.03

---

## 🔄 Revision History

| Date | Version | Change Summary | Author |
|------|---------|----------------|--------|
| [DATE] | 03.06.03 | Initial fork setup with custom colors and branding | [YOUR NAME] |

---

**Maintained by [CLIENT NAME] / [DEVELOPER NAME]**
