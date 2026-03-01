# Manual Deployment Guide - MokoCassiopeia

This guide explains how to manually deploy the MokoCassiopeia template from the `src` directory to a Joomla installation without using the build/packaging process.

## Table of Contents

- [Overview](#overview)
- [Understanding the Structure](#understanding-the-structure)
- [Manual Deployment Methods](#manual-deployment-methods)
- [Troubleshooting](#troubleshooting)
- [When to Use Manual Deployment](#when-to-use-manual-deployment)

## Overview

**Important**: The `src` directory in this repository is the development source, not a ready-to-install package. For production use, we recommend using the packaged ZIP file from [Releases](https://github.com/mokoconsulting-tech/MokoCassiopeia/releases).

However, for development or testing purposes, you can manually deploy files from the `src` directory to your Joomla installation.

## Understanding the Structure

### Repository Structure

The `src/` directory contains:

```
src/
├── component.php           # Template file
├── error.php               # Template file
├── index.php               # Main template file
├── offline.php             # Template file
├── templateDetails.xml     # Template manifest
├── joomla.asset.json       # Asset registration
├── html/                   # Module & component overrides
├── language/               # Frontend language files
├── administrator/          # Backend language files
│   └── language/
└── media/                  # Assets (CSS, JS, images, fonts)
    ├── css/
    ├── js/
    ├── images/
    └── fonts/
```

### Joomla Installation Structure

Joomla expects template files in these locations:

```
YOUR_JOOMLA_ROOT/
├── templates/
│   └── mokocassiopeia/              # Template files go here
│       ├── component.php
│       ├── error.php
│       ├── index.php
│       ├── offline.php
│       ├── templateDetails.xml
│       ├── joomla.asset.json
│       ├── html/
│       ├── language/
│       └── administrator/
└── media/
    └── templates/
        └── site/
            └── mokocassiopeia/      # Media files go here
                ├── css/
                ├── js/
                ├── images/
                └── fonts/
```

**Key Point**: Template files and media files go to **different locations** in Joomla!

## Manual Deployment Methods

### Method 1: Recommended - Upload as ZIP (Still Manual)

This method mimics what Joomla's installer does automatically.

1. **Prepare the template directory**:
   ```bash
   # From the repository root
   cd src
   
   # Copy all files EXCEPT media to a temp directory
   mkdir -p /tmp/mokocassiopeia
   cp component.php /tmp/mokocassiopeia/
   cp error.php /tmp/mokocassiopeia/
   cp index.php /tmp/mokocassiopeia/
   cp offline.php /tmp/mokocassiopeia/
   cp templateDetails.xml /tmp/mokocassiopeia/
   cp joomla.asset.json /tmp/mokocassiopeia/
   cp -r html /tmp/mokocassiopeia/
   cp -r language /tmp/mokocassiopeia/
   cp -r administrator /tmp/mokocassiopeia/
   
   # Copy media to a separate temp directory
   mkdir -p /tmp/mokocassiopeia_media
   cp -r media/* /tmp/mokocassiopeia_media/
   ```

2. **Upload to Joomla via FTP/SFTP**:
   ```bash
   # Upload template files
   # Replace with your actual Joomla path
   scp -r /tmp/mokocassiopeia/* user@yourserver:/path/to/joomla/templates/mokocassiopeia/
   
   # Upload media files
   scp -r /tmp/mokocassiopeia_media/* user@yourserver:/path/to/joomla/media/templates/site/mokocassiopeia/
   ```

3. **Set proper permissions**:
   ```bash
   # On your server
   cd /path/to/joomla
   chmod 755 templates/mokocassiopeia
   chmod 644 templates/mokocassiopeia/*
   chmod 755 templates/mokocassiopeia/html
   chmod 755 media/templates/site/mokocassiopeia
   ```

### Method 2: Direct Copy to Existing Installation

If you have direct filesystem access (e.g., local development):

1. **Copy template files** (excluding media):
   ```bash
   # From repository root
   cd src
   
   # Copy to Joomla templates directory
   cp component.php /path/to/joomla/templates/mokocassiopeia/
   cp error.php /path/to/joomla/templates/mokocassiopeia/
   cp index.php /path/to/joomla/templates/mokocassiopeia/
   cp offline.php /path/to/joomla/templates/mokocassiopeia/
   cp templateDetails.xml /path/to/joomla/templates/mokocassiopeia/
   cp joomla.asset.json /path/to/joomla/templates/mokocassiopeia/
   
   # Copy directories
   cp -r html /path/to/joomla/templates/mokocassiopeia/
   cp -r language /path/to/joomla/templates/mokocassiopeia/
   cp -r administrator /path/to/joomla/templates/mokocassiopeia/
   ```

2. **Copy media files separately**:
   ```bash
   # Copy media to the media directory
   cp -r media/* /path/to/joomla/media/templates/site/mokocassiopeia/
   ```

3. **Clear Joomla cache**:
   - In Joomla admin: **System → Clear Cache**
   - Or delete: `/path/to/joomla/cache/*` and `/path/to/joomla/administrator/cache/*`

### Method 3: Symlink for Development (Linux/Mac only)

For active development where you want changes to immediately reflect:

1. **Create symlinks**:
   ```bash
   # Remove existing directory if present
   rm -rf /path/to/joomla/templates/mokocassiopeia
   rm -rf /path/to/joomla/media/templates/site/mokocassiopeia
   
   # Create parent directories if needed
   mkdir -p /path/to/joomla/templates
   mkdir -p /path/to/joomla/media/templates/site
   
   # Symlink template files
   ln -s /path/to/MokoCassiopeia/src /path/to/joomla/templates/mokocassiopeia
   
   # Symlink media files
   ln -s /path/to/MokoCassiopeia/src/media /path/to/joomla/media/templates/site/mokocassiopeia
   ```

2. **Note**: This won't work as-is because the src directory includes the media folder. You'll need to:
   ```bash
   # Better approach for symlinks:
   # Link everything except media at template root
   cd /path/to/joomla/templates
   mkdir -p mokocassiopeia
   cd mokocassiopeia
   
   ln -s /path/to/MokoCassiopeia/src/component.php
   ln -s /path/to/MokoCassiopeia/src/error.php
   ln -s /path/to/MokoCassiopeia/src/index.php
   ln -s /path/to/MokoCassiopeia/src/offline.php
   ln -s /path/to/MokoCassiopeia/src/templateDetails.xml
   ln -s /path/to/MokoCassiopeia/src/joomla.asset.json
   ln -s /path/to/MokoCassiopeia/src/html
   ln -s /path/to/MokoCassiopeia/src/language
   ln -s /path/to/MokoCassiopeia/src/administrator
   
   # Link media separately
   ln -s /path/to/MokoCassiopeia/src/media /path/to/joomla/media/templates/site/mokocassiopeia
   ```

## Troubleshooting

### Language Files Not Loading

**Problem**: Language strings appear as language keys (e.g., `TPL_MOKOCASSIOPEIA_LABEL`)

**Solution**: Ensure the `language` and `administrator` folders are present in your template directory:

```bash
# Check if folders exist
ls -la /path/to/joomla/templates/mokocassiopeia/language
ls -la /path/to/joomla/templates/mokocassiopeia/administrator
```

The `templateDetails.xml` should contain (lines 54-55):
```xml
<files>
    <!-- ... other files ... -->
    <folder>language</folder>
    <folder>administrator</folder>
</files>
```

### CSS/JS Not Loading

**Problem**: Styles or scripts don't apply

**Solution**: Verify media files are in the correct location:

```bash
# Check media directory structure
ls -la /path/to/joomla/media/templates/site/mokocassiopeia/
# Should show: css/, js/, images/, fonts/
```

Clear Joomla cache:
- Admin: **System → Clear Cache**
- Check browser developer console for 404 errors

### Template Not Appearing in Template Manager

**Problem**: MokoCassiopeia doesn't show in **System → Site Templates**

**Solution**:
1. Verify `templateDetails.xml` is present in `/path/to/joomla/templates/mokocassiopeia/`
2. Check file permissions (should be readable by web server)
3. Verify XML is well-formed:
   ```bash
   xmllint --noout /path/to/joomla/templates/mokocassiopeia/templateDetails.xml
   ```
4. Check Joomla's error logs for XML parsing errors

### File Permission Issues

**Problem**: "Permission denied" or template files not readable

**Solution**:
```bash
# Set proper ownership (replace www-data with your web server user)
chown -R www-data:www-data /path/to/joomla/templates/mokocassiopeia
chown -R www-data:www-data /path/to/joomla/media/templates/site/mokocassiopeia

# Set proper permissions
find /path/to/joomla/templates/mokocassiopeia -type d -exec chmod 755 {} \;
find /path/to/joomla/templates/mokocassiopeia -type f -exec chmod 644 {} \;
find /path/to/joomla/media/templates/site/mokocassiopeia -type d -exec chmod 755 {} \;
find /path/to/joomla/media/templates/site/mokocassiopeia -type f -exec chmod 644 {} \;
```

## When to Use Manual Deployment

### ✅ Use Manual Deployment For:

- **Active Development**: Testing changes immediately without rebuilding packages
- **Local Development**: Working on a local Joomla instance
- **Quick Fixes**: Making emergency hotfixes directly on a development server
- **Learning**: Understanding the template structure and Joomla's file organization

### ❌ Don't Use Manual Deployment For:

- **Production Sites**: Always use packaged ZIP files from releases
- **Client Sites**: Use proper Joomla extension installation
- **Version Control**: Can lead to inconsistent deployments
- **Staging Environments**: Use CI/CD or release packages

## Best Practices

1. **Always Test Locally First**: Don't deploy untested changes to production
2. **Keep Backups**: Back up both template and media directories before updating
3. **Use Version Control**: Track your customizations separately from manual deployments
4. **Document Changes**: Note any manual file modifications
5. **Clear Cache**: Always clear Joomla cache after manual file updates
6. **Verify Permissions**: Ensure web server can read all files

## Related Documentation

- **[Quick Start Guide](QUICK_START.md)** - Development environment setup
- **[Joomla Development Guide](JOOMLA_DEVELOPMENT.md)** - Complete development workflows
- **[Release Process](RELEASE_PROCESS.md)** - How to create proper release packages

## Support

If you encounter issues with manual deployment:

1. Check this troubleshooting guide first
2. Review [Joomla's template documentation](https://docs.joomla.org/J4.x:Creating_a_Simple_Template)
3. Open an issue on [GitHub](https://github.com/mokoconsulting-tech/MokoCassiopeia/issues)
4. Contact: hello@mokoconsulting.tech

---

**Document Version**: 1.0.0  
**Last Updated**: 2026-03-01  
**Status**: Active
