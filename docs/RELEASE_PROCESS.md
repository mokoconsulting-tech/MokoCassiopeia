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
 FILE: docs/RELEASE_PROCESS.md
 VERSION: 01.00.00
 BRIEF: Complete release process documentation for MokoCassiopeia
 PATH: /docs/RELEASE_PROCESS.md
-->

# Release Process — MokoCassiopeia

This document describes the complete release process for MokoCassiopeia Joomla template, including automated workflows and manual procedures.

## Table of Contents

1. [Overview](#overview)
2. [Release Types](#release-types)
3. [Automated Release Process](#automated-release-process)
4. [Manual Release Process](#manual-release-process)
5. [Update Server Configuration](#update-server-configuration)
6. [Testing Releases](#testing-releases)
7. [Rollback Procedures](#rollback-procedures)
8. [Troubleshooting](#troubleshooting)

---

## Overview

MokoCassiopeia uses an automated release system powered by GitHub Actions. The system:

- **Builds** installation packages automatically
- **Generates** checksums for security verification
- **Creates** GitHub Releases with downloadable artifacts
- **Updates** the Joomla update server (`updates.xml`) automatically
- **Validates** package integrity with SHA-256 hashes

### Key Components

1. **Release Workflow** (`.github/workflows/release.yml`): Builds and publishes releases
2. **Auto-Update SHA** (`.github/workflows/auto-update-sha.yml`): Updates `updates.xml` after release
3. **Build Script** (`scripts/build-release.sh`): Local development builds
4. **Update Server** (`updates.xml`): Joomla update server manifest

---

## Release Types

### Patch Release (Third Digit)

**Format**: `XX.XX.XX` → `XX.XX.XX+1` (e.g., `03.08.03` → `03.08.04`)

**When to use**:
- Bug fixes
- Security patches
- Documentation updates
- Minor CSS/styling tweaks
- No breaking changes

**Example**: `03.08.03` → `03.08.04`

### Minor Release (Second Digit)

**Format**: `XX.XX.00` → `XX.XX+1.00` (e.g., `03.08.03` → `03.09.00`)

**When to use**:
- New features
- New module/component overrides
- Significant styling changes
- Backward-compatible changes

**Example**: `03.08.03` → `03.09.00`

### Major Release (First Digit)

**Format**: `XX.00.00` → `XX+1.00.00` (e.g., `03.08.03` → `04.00.00`)

**When to use**:
- Breaking changes
- Major architecture changes
- Joomla version upgrades
- Complete redesigns

**Example**: `03.08.03` → `04.00.00`

---

## Automated Release Process

**Recommended for most releases**

### Prerequisites

- [ ] All changes merged to `main` branch
- [ ] Tests passing
- [ ] Documentation updated
- [ ] CHANGELOG.md updated
- [ ] Local testing completed

### Step 1: Prepare Release Branch

```bash
# Create release branch
git checkout main
git pull
git checkout -b release/03.08.04

# Update version in templateDetails.xml
# Edit: src/templateDetails.xml
# Change: <version>03.08.03</version>
# To:     <version>03.08.04</version>

# Update CHANGELOG.md
# Add new section:
## [03.08.04] - 2026-02-27

### Added
- Feature descriptions

### Fixed
- Bug fix descriptions

### Changed
- Change descriptions

# Commit changes
git add src/templateDetails.xml CHANGELOG.md
git commit -m "chore: Prepare release 03.08.04"
git push origin release/03.08.04
```

### Step 2: Create Pull Request

1. Go to GitHub repository
2. Click "Pull requests" → "New pull request"
3. Base: `main`, Compare: `release/03.08.04`
4. Title: `Release 03.08.04`
5. Description: Copy relevant CHANGELOG entries
6. Create pull request
7. Review and merge

### Step 3: Create and Push Tag

```bash
# Switch to main and pull changes
git checkout main
git pull

# Create tag
git tag 03.08.04

# Push tag (triggers release workflow)
git push origin 03.08.04
```

### Step 4: Monitor Automated Process

1. **Go to GitHub Actions tab**
2. **Watch "Create Release" workflow**:
   - Builds package
   - Generates checksums
   - Creates GitHub Release
   - Uploads artifacts

3. **Watch "Auto-Update SHA Hash" workflow**:
   - Downloads release package
   - Calculates SHA-256 hash
   - Updates `updates.xml`
   - Commits to main branch

### Step 5: Verify Release

1. **Check GitHub Release**:
   - Go to Releases tab
   - Verify release `03.08.04` exists
   - Download ZIP package
   - Verify checksums match

2. **Check updates.xml**:
   ```bash
   git pull
   cat updates.xml
   ```
   - Verify version is `03.08.04`
   - Verify download URL is correct
   - Verify SHA-256 hash is present

3. **Test Joomla Update**:
   - Install previous version in Joomla
   - Go to Extensions → Update
   - Verify update is detected
   - Perform update
   - Verify template works correctly

---

## Manual Release Process

**Use when automation fails or for local testing**

### Step 1: Prepare Repository

```bash
# Update version numbers
# Edit: src/templateDetails.xml
# Edit: CHANGELOG.md

# Commit changes
git add src/templateDetails.xml CHANGELOG.md
git commit -m "chore: Prepare release 03.08.04"
git push
```

### Step 2: Build Package Locally

```bash
# Run build script
./scripts/build-release.sh 03.08.04

# Output will be in build/ directory:
# - mokocassiopeia-src-03.08.04.zip
# - mokocassiopeia-src-03.08.04.zip.sha256
# - mokocassiopeia-src-03.08.04.zip.md5
```

### Step 3: Test Package

```bash
# Install in Joomla test environment
# Extensions → Manage → Install → Upload Package File
# Select: build/mokocassiopeia-src-03.08.04.zip

# Test all features:
# - Template displays correctly
# - Module overrides work
# - Alternative layouts selectable
# - Dark mode works
# - No JavaScript errors
```

### Step 4: Create GitHub Release

1. **Go to GitHub Releases**
2. **Click "Create a new release"**
3. **Tag**: `03.08.04` (create new tag)
4. **Release title**: `Release 03.08.04`
5. **Description**: Copy from CHANGELOG.md
6. **Upload files**:
   - `mokocassiopeia-src-03.08.04.zip`
   - `mokocassiopeia-src-03.08.04.zip.sha256`
   - `mokocassiopeia-src-03.08.04.zip.md5`
7. **Publish release**

### Step 5: Update updates.xml Manually

```bash
# Extract SHA-256 hash
cat build/mokocassiopeia-src-03.08.04.zip.sha256
# Example output: a1b2c3d4e5f6...

# Edit updates.xml
# Update <version>03.08.04</version>
# Update <creationDate>2026-02-27</creationDate>
# Update <downloadurl>https://github.com/mokoconsulting-tech/MokoCassiopeia/releases/download/03.08.04/mokocassiopeia-src-03.08.04.zip</downloadurl>
# Update <sha256>sha256:a1b2c3d4e5f6...</sha256>

# Commit and push
git add updates.xml
git commit -m "chore: Update updates.xml for release 03.08.04"
git push
```

---

## Update Server Configuration

### updates.xml Structure

```xml
<updates>
  <update>
    <name>MokoCassiopeia</name>
    <description>Moko Consulting's site template based on Cassiopeia.</description>
    <element>mokocassiopeia</element>
    <type>template</type>
    <client>site</client>

    <version>03.08.04</version>
    <creationDate>2026-02-27</creationDate>
    <author>Jonathan Miller || Moko Consulting</author>
    <authorEmail>hello@mokoconsulting.tech</authorEmail>
    <copyright>(C)GNU General Public License Version 3 - 2026 Moko Consulting</copyright>

    <infourl title='MokoCassiopeia'>https://github.com/mokoconsulting-tech/MokoCassiopeia</infourl>

    <downloads>
      <downloadurl type='full' format='zip'>https://github.com/mokoconsulting-tech/MokoCassiopeia/releases/download/03.08.04/mokocassiopeia-src-03.08.04.zip</downloadurl>
      <sha256>sha256:a1b2c3d4e5f6...</sha256>
    </downloads>

    <tags>
      <tag>stable</tag>
    </tags>

    <maintainer>Moko Consulting</maintainer>
    <maintainerurl>https://www.mokoconsulting.tech</maintainerurl>

    <targetplatform name='joomla' version='5.*'/>
  </update>
</updates>
```

### Hosting Update Server

The `updates.xml` file is hosted directly on GitHub:

**URL**: `https://raw.githubusercontent.com/mokoconsulting-tech/MokoCassiopeia/main/updates.xml`

This URL is configured in `src/templateDetails.xml`:

```xml
<updateservers>
  <server type="extension" name="MokoCassiopeia Updates" priority="1">
    https://raw.githubusercontent.com/mokoconsulting-tech/MokoCassiopeia/main/updates.xml
  </server>
</updateservers>
```

---

## Testing Releases

### Pre-Release Testing

```bash
# 1. Build package locally
./scripts/build-release.sh

# 2. Set up Joomla test environment
# - Clean Joomla 5.x installation
# - Previous MokoCassiopeia version installed

# 3. Test current version features
# - All module overrides
# - Alternative layouts
# - Dark mode toggle
# - Responsive behavior

# 4. Install new package
# Extensions → Manage → Install → Upload Package

# 5. Verify upgrade process
# - No errors during installation
# - Settings preserved
# - Custom modifications retained

# 6. Test new features
# - New functionality works
# - Bug fixes applied
# - No regressions
```

### Update Server Testing

```bash
# 1. Install previous version in Joomla
# 2. Go to: Extensions → Update
# 3. Click "Find Updates"
# 4. Verify update shows: "MokoCassiopeia 03.08.04"
# 5. Click "Update"
# 6. Verify successful update
# 7. Test template functionality
```

### Checklist

- [ ] Package installs without errors
- [ ] Template activates correctly
- [ ] All module overrides work
- [ ] Alternative layouts selectable
- [ ] Dark mode functions
- [ ] Responsive on mobile/tablet/desktop
- [ ] No JavaScript console errors
- [ ] No PHP errors in Joomla logs
- [ ] Update server detects new version
- [ ] Update process completes successfully

---

## Rollback Procedures

### Rollback Release

If a release has critical issues:

1. **Delete GitHub Release**:
   - Go to Releases
   - Click release to delete
   - Click "Delete"
   - Confirm deletion

2. **Delete Git Tag**:
   ```bash
   # Delete local tag
   git tag -d 03.08.04
   
   # Delete remote tag
   git push --delete origin 03.08.04
   ```

3. **Revert updates.xml**:
   ```bash
   # Revert to previous version
   git revert <commit-hash-of-auto-update>
   git push
   ```

4. **Notify Users**:
   - Create GitHub issue explaining the problem
   - Pin the issue
   - Provide rollback instructions for users

### User Rollback Instructions

For users who installed the problematic version:

1. **Download previous version** from GitHub Releases
2. **Uninstall current version**:
   - Extensions → Manage → Manage
   - Find MokoCassiopeia
   - Click "Uninstall"
3. **Install previous version**:
   - Extensions → Manage → Install
   - Upload previous version ZIP
4. **Verify functionality**

---

## Troubleshooting

### Release Workflow Fails

**Problem**: Build fails with "rsync: command not found"

**Solution**: The GitHub Actions runner always has rsync installed. If this occurs, check the workflow file syntax.

**Problem**: ZIP creation fails

**Solution**: Check that `src/` and `src/media/` directories exist and contain files.

**Problem**: Version update fails

**Solution**: Verify `sed` commands in workflow match actual XML structure.

### Auto-Update SHA Fails

**Problem**: Cannot download release package

**Solution**: 
- Verify release was published (not draft)
- Check package naming: `mokocassiopeia-src-{version}.zip`
- Verify release tag format

**Problem**: SHA-256 hash mismatch

**Solution**:
- Package may have been modified after calculation
- Re-run the workflow manually
- Verify package integrity

**Problem**: Commit fails

**Solution**:
- Check workflow has write permissions
- Verify no branch protection rules blocking bot commits

### Manual Build Issues

**Problem**: `./scripts/build-release.sh: Permission denied`

**Solution**:
```bash
chmod +x scripts/build-release.sh
./scripts/build-release.sh
```

**Problem**: Build directory exists

**Solution**:
```bash
rm -rf build/
./scripts/build-release.sh
```

### Update Server Issues

**Problem**: Joomla doesn't detect update

**Solution**:
1. Check `updates.xml` is accessible:
   ```bash
   curl https://raw.githubusercontent.com/mokoconsulting-tech/MokoCassiopeia/main/updates.xml
   ```
2. Verify version number is higher than installed version
3. Clear Joomla cache: System → Clear Cache
4. Check update URL in templateDetails.xml

**Problem**: Update fails with "Invalid package"

**Solution**:
- Verify SHA-256 hash matches
- Re-download package and check integrity
- Verify package structure is correct

---

## Best Practices

### Version Numbering

- **Always increment** version numbers sequentially
- **Never reuse** version numbers
- **Use consistent** format: `XX.XX.XX`

### Changelog

- **Update before** release
- **Include all changes** since last version
- **Categorize** changes: Added, Changed, Fixed, Removed
- **Write clear descriptions** for users

### Testing

- **Test locally** before pushing tag
- **Test update process** from previous version
- **Test on clean** Joomla installation
- **Test different** configurations

### Communication

- **Announce releases** on GitHub Discussions
- **Document breaking changes** clearly
- **Provide migration guides** for major changes
- **Respond promptly** to issue reports

---

## Quick Reference

### Automated Release Commands

```bash
# 1. Create release branch
git checkout -b release/03.08.04

# 2. Update version and CHANGELOG
# (edit files)

# 3. Commit and push
git add .
git commit -m "chore: Prepare release 03.08.04"
git push origin release/03.08.04

# 4. Create and merge PR (via GitHub UI)

# 5. Create and push tag
git checkout main
git pull
git tag 03.08.04
git push origin 03.08.04

# 6. Wait for automation to complete
```

### Manual Release Commands

```bash
# Build locally
./scripts/build-release.sh 03.08.04

# Test installation
# (manual Joomla testing)

# Create release on GitHub
# (via GitHub UI)

# Update updates.xml
# (edit file with SHA-256)
git add updates.xml
git commit -m "chore: Update updates.xml for 03.08.04"
git push
```

---

## Related Documentation

- **Build Scripts**: [scripts/README.md](../scripts/README.md)
- **Workflow Guide**: [WORKFLOW_GUIDE.md](WORKFLOW_GUIDE.md)
- **Contributing**: [CONTRIBUTING.md](../CONTRIBUTING.md)
- **Changelog**: [CHANGELOG.md](../CHANGELOG.md)

---

## Support

- **Issues**: [GitHub Issues](https://github.com/mokoconsulting-tech/MokoCassiopeia/issues)
- **Discussions**: [GitHub Discussions](https://github.com/mokoconsulting-tech/MokoCassiopeia/discussions)
- **Email**: hello@mokoconsulting.tech

---

## License

Copyright (C) 2026 Moko Consulting

This documentation is licensed under GPL-3.0-or-later.
