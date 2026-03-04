<!-- Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 SPDX-License-Identifier: GPL-3.0-or-later

 BRIEF: Documentation for client fork creation workflow (colors only)
 -->

# Client Fork Creation Workflow (Colors Only)

This document explains how to use the automated client fork creation tools to set up a new client-specific fork of MokoCassiopeia for custom color branding.

---

## Overview

The client fork creation workflow automates the process of preparing a repository for a client-specific color fork. It performs the following actions:

1. ✅ Copies `templates/colors_custom.css` to `src/media/css/colors/light/colors_custom.css`
2. ✅ Copies `templates/colors_custom.css` to `src/media/css/colors/dark/colors_custom.css`
3. ✅ Applies client fork `.gitignore` template that tracks custom color files
4. ✅ Keeps `templates/colors_custom.css` as a reference template

**Scope**: Client forks are limited to custom color branding only. All other customizations should be made through Joomla's template settings.

---

## Method 1: GitHub Actions Workflow (Recommended)

### Prerequisites

- Repository admin or maintainer access
- GitHub Actions enabled for the repository

### Steps

1. **Navigate to Actions**
   - Go to your repository on GitHub
   - Click on the "Actions" tab

2. **Run the Workflow**
   - Select "Create Client Fork (Colors Only)" from the workflow list
   - Click "Run workflow"
   - Fill in the required inputs:
     - **Client Name**: Full client name (e.g., "Acme Corporation")
     - **Confirm**: Type "CONFIRM" to proceed
   - Click "Run workflow" button

3. **Monitor Progress**
   - The workflow will create a new branch named `client-fork/{client-slug}`
   - You can monitor the progress in the Actions tab
   - Once complete, you'll see a summary of changes

4. **Review the Branch**
   - Navigate to the new branch: `client-fork/{client-slug}`
   - Review the changes made
   - Custom color files will be in place and tracked
   - Upstream README and documentation remain unchanged

5. **Create Client Repository**
   - Create a new repository for the client
   - Push the branch to the new repository:
     ```bash
     git remote add client-repo <CLIENT_REPO_URL>
     git push client-repo client-fork/{client-slug}:main
     ```

### Workflow Features

- ✅ **Safe Confirmation**: Requires typing "CONFIRM" to prevent accidental runs
- ✅ **Automated Branch Creation**: Creates a properly named branch automatically
- ✅ **Color File Setup**: Copies color templates to both light and dark directories
- ✅ **Git Tracking**: Custom colors tracked via client fork .gitignore
- ✅ **Summary Report**: Provides a complete summary of actions taken

---

## Method 2: Local Bash Script

### Prerequisites

- Git installed on your local machine
- Bash shell (Linux, macOS, or Git Bash on Windows)
- Local clone of the MokoCassiopeia repository

### Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/mokoconsulting-tech/MokoCassiopeia.git
   cd MokoCassiopeia
   ```

2. **Make Script Executable**
   ```bash
   chmod +x scripts/create-client-fork.sh
   ```

3. **Run the Script**
   ```bash
   ./scripts/create-client-fork.sh "Client Name"
   ```
   
   Example:
   ```bash
   ./scripts/create-client-fork.sh "Acme Corporation"
   ```

4. **Confirm Actions**
   - The script will show you what it will do
   - Type "yes" to proceed
   - Review the changes shown
   - Type "yes" to commit

5. **Push to New Repository**
   ```bash
   # Add the client's repository as a remote
   git remote add client-repo <CLIENT_REPO_URL>
   
   # Push the branch
   git push client-repo client-fork/{client-slug}:main
   ```

### Script Features

- 🎨 **Colored Output**: Easy-to-read colored terminal output
- ✅ **Interactive Confirmation**: Asks for confirmation before making changes
- ✅ **Safety Checks**: Verifies you're in the correct directory
- ✅ **Progress Indicators**: Shows each step as it completes
- ✅ **Git Status**: Shows what files changed before committing
- ✅ **Summary**: Provides a complete summary at the end

---

## What Gets Changed

### Files Created

```
src/media/css/colors/light/colors_custom.css   [NEW - TRACKED]
src/media/css/colors/dark/colors_custom.css    [NEW - TRACKED]
```

### Files Modified

```
.gitignore                                       [REPLACED with client fork template]
```

### Files Kept Unchanged

```
README.md                                        [UNCHANGED - upstream docs]
templates/colors_custom.css                      [UNCHANGED - reference template]
All other repository files                       [UNCHANGED]
```

---

## Post-Setup Steps

After running the workflow or script, you should:

1. **Customize Brand Colors**
   - Edit `src/media/css/colors/light/colors_custom.css`
   - Edit `src/media/css/colors/dark/colors_custom.css`
   - Update CSS variables to match client branding

2. **Test Locally**
   - Install the template in a local Joomla instance
   - Test light and dark modes
   - Verify custom colors appear correctly

3. **Enable Custom Palette in Joomla**
   - Log into Joomla admin
   - Navigate to System → Site Templates → MokoCassiopeia
   - Under Theme tab, set palette to "Custom"
   - Save and test

4. **Create Client Repository**
   - Create a new repository for the client
   - Push the prepared branch to the new repo
   - Set up appropriate access controls

5. **Document Customizations**
   - Add a note to the repository about custom colors
   - Document the client's brand color palette
   - Keep reference for future updates

---

## Troubleshooting

### Workflow Fails with "CONFIRM" Error

**Problem**: Workflow stops immediately with confirmation error.

**Solution**: Make sure you type "CONFIRM" (in all caps) in the confirmation field.

### Script Says "colors_custom.css not found"

**Problem**: Script can't find required files.

**Solution**: Make sure you're running the script from the repository root directory:
```bash
cd /path/to/MokoCassiopeia
./scripts/create-client-fork.sh "Client Name"
```

### Colors Don't Appear After Setup

**Problem**: Custom colors don't show in Joomla.

**Solution**: 
1. Enable custom palette in template settings
2. Clear Joomla cache (System → Clear Cache)
3. Clear browser cache (Ctrl+Shift+R / Cmd+Shift+R)

### Branch Already Exists

**Problem**: Branch name conflicts with existing branch.

**Solution**: Either delete the old branch or choose a different client name:
```bash
# Delete old branch
git branch -D client-fork/{client-slug}

# Or use a more specific client name
./scripts/create-client-fork.sh "Client Name - Division"
```

### How to Make Other Customizations

**Problem**: Need more than just color customization.

**Solution**: Use Joomla's built-in template customization options:
- System → Site Templates → MokoCassiopeia → Custom Code tab
- Add custom HTML/CSS/JS through the template settings
- Use Joomla's module positions and layout options
- For extensive customizations, consider a full template fork (not recommended)

---

## Examples

### Example 1: Simple Client Fork

```bash
# Using the script
./scripts/create-client-fork.sh "Acme Corporation"
```

This creates:
- Branch: `client-fork/acme-corporation`
- Custom colors tracked in the fork
- Upstream README and docs preserved

### Example 2: Client with Multiple Words

```bash
# Using the script
./scripts/create-client-fork.sh "Global Tech Solutions Inc"
```

This creates:
- Branch: `client-fork/global-tech-solutions-inc`
- Custom color files in `src/media/css/colors/`

### Example 3: Using GitHub Actions

1. Go to Actions → Create Client Fork (Colors Only)
2. Enter: "Mountain View Medical Center"
3. Enter: "CONFIRM"
4. Click "Run workflow"

Result:
- Branch: `client-fork/mountain-view-medical-center`
- Color files ready for customization

---

## Best Practices

1. **Naming Convention**: Use the official client name as it should appear in documentation

2. **Branch Management**: 
   - Keep the branch until the client repository is set up
   - Don't merge client fork branches back to main

3. **Custom Colors**:
   - Document color choices in a README note or commit message
   - Keep a backup of custom color files
   - Test in both light and dark modes before deployment

4. **Version Tracking**:
   - Note the upstream version in your fork documentation
   - Track when you last synced with upstream
   - Use semantic versioning for your fork releases

5. **Security**:
   - Don't commit client-specific credentials
   - Keep client forks private if they contain sensitive branding
   - Regularly sync with upstream for security patches

6. **Syncing with Upstream**:
   - Periodically merge upstream updates to get bug fixes
   - Test thoroughly after merging upstream changes
   - Custom colors won't conflict with upstream updates

7. **Limited Scope**:
   - Forks are for colors only
   - Use Joomla's template settings for other customizations
   - Avoid modifying core template files

---

## Related Documentation

- **[CSS Variables](../docs/CSS_VARIABLES.md)** - Complete CSS variable reference for color customization
- **[Main README](../README.md)** - MokoCassiopeia documentation
- **[Quick Start](../docs/QUICK_START.md)** - Installation and setup guide

---

## Support

For issues with the workflow or script:
- Check this documentation first
- Review error messages carefully
- Contact: hello@mokoconsulting.tech

---

**Document Version**: 2.0  
**Last Updated**: 2026-03-04  
**Scope**: Colors only  
**Maintained by**: Moko Consulting
