# Scripts — MokoCassiopeia

This directory contains utility scripts for building, releasing, and managing the MokoCassiopeia Joomla template.

## Available Scripts

### build-release.sh

**Purpose**: Build a release package for MokoCassiopeia template.

**Usage**:
```bash
# Build with auto-detected version from templateDetails.xml
./scripts/build-release.sh

# Build with specific version
./scripts/build-release.sh 03.08.03
```

**What it does**:
1. Creates a `build/` directory
2. Copies template files from `src/templates/`
3. Copies media files from `src/media/` to `media/`
4. Creates a ZIP package: `mokocassiopeia-src-{version}.zip`
5. Generates SHA-256 and MD5 checksums
6. Outputs package location and checksums

**Output**:
- `build/mokocassiopeia-src-{version}.zip` - Installation package
- `build/mokocassiopeia-src-{version}.zip.sha256` - SHA-256 checksum
- `build/mokocassiopeia-src-{version}.zip.md5` - MD5 checksum

**Requirements**:
- `rsync` for file copying
- `zip` for package creation
- `sha256sum` and `md5sum` for checksums

---

### create-client-fork.sh

**Purpose**: Create a customized client fork of MokoCassiopeia.

**Usage**:
```bash
./scripts/create-client-fork.sh
```

See the script documentation for details on creating client-specific forks.

---

## Automated Workflows

The repository includes GitHub Actions workflows that automate the build and release process:

### `.github/workflows/release.yml`

**Purpose**: Automated release creation when tags are pushed.

**Triggers**:
- Push of version tag (e.g., `03.08.03`)
- Manual workflow dispatch with version input

**Process**:
1. Checks out repository
2. Sets up PHP environment
3. Installs dependencies (if composer.json exists)
4. Updates version numbers in manifest files
5. Creates package structure
6. Builds ZIP package
7. Generates checksums
8. Creates GitHub Release with artifacts

**Usage**:
```bash
# Create and push a tag
git tag 03.08.04
git push origin 03.08.04

# Or use GitHub UI to run manually
```

---

### `.github/workflows/auto-update-sha.yml`

**Purpose**: Automatically update SHA-256 hash in `updates.xml` after a release is published.

**Triggers**:
- GitHub Release published
- Manual workflow dispatch with tag input

**Process**:
1. Downloads the release package
2. Calculates SHA-256 hash
3. Updates `updates.xml` with:
   - New version number
   - Current date
   - Download URL
   - SHA-256 hash
4. Commits and pushes changes to main branch

**Benefits**:
- Ensures `updates.xml` always has correct SHA-256 hash
- Enables Joomla update server functionality
- Reduces manual update errors
- Automates security verification

---

## Release Process

### Manual Release (Local Build)

1. **Update version numbers**:
   ```bash
   # Update these files manually:
   # - src/templates/templateDetails.xml
   # - updates.xml
   # - CHANGELOG.md
   ```

2. **Build package**:
   ```bash
   ./scripts/build-release.sh 03.08.04
   ```

3. **Test package**:
   - Install ZIP in Joomla test environment
   - Verify all features work correctly

4. **Create GitHub Release**:
   - Go to GitHub Releases
   - Click "Create a new release"
   - Upload the ZIP, SHA256, and MD5 files
   - Add release notes from CHANGELOG.md

5. **Update updates.xml**:
   - Copy SHA-256 hash from `.sha256` file
   - Update `updates.xml` with new hash
   - Commit and push changes

---

### Automated Release (GitHub Actions)

1. **Update version numbers**:
   ```bash
   # Update these files in a branch:
   # - src/templates/templateDetails.xml
   # - CHANGELOG.md
   
   git checkout -b release/03.08.04
   # Make changes
   git commit -m "chore: Prepare release 03.08.04"
   git push origin release/03.08.04
   ```

2. **Create and merge PR**:
   - Create PR from release branch
   - Review changes
   - Merge to main

3. **Create and push tag**:
   ```bash
   git checkout main
   git pull
   git tag 03.08.04
   git push origin 03.08.04
   ```

4. **Automated process**:
   - GitHub Actions builds package automatically
   - Creates GitHub Release with artifacts
   - `auto-update-sha` workflow updates `updates.xml`

5. **Verify**:
   - Check GitHub Release is created
   - Verify `updates.xml` has correct SHA-256
   - Test Joomla update server

---

## Development Workflow

### Testing Local Builds

```bash
# Build current version
./scripts/build-release.sh

# Install in Joomla
# Navigate to Extensions > Manage > Install > Upload Package File
# Select: build/mokocassiopeia-src-{version}.zip
```

### Pre-Release Checklist

- [ ] All code changes merged to main
- [ ] Version numbers updated:
  - [ ] `src/templates/templateDetails.xml`
  - [ ] `CHANGELOG.md`
- [ ] CHANGELOG.md updated with release notes
- [ ] Tests passing
- [ ] Documentation updated
- [ ] Local build tested in Joomla

---

## Troubleshooting

### Build Fails

**Problem**: `rsync: command not found`
```bash
# Ubuntu/Debian
sudo apt-get install rsync

# macOS
brew install rsync
```

**Problem**: `zip: command not found`
```bash
# Ubuntu/Debian
sudo apt-get install zip

# macOS (usually pre-installed)
brew install zip
```

### GitHub Actions Fails

**Problem**: Release workflow fails on tag push

Check:
1. Tag format matches pattern: `[0-9][0-9].[0-9][0-9].[0-9][0-9]`
2. Repository has write permissions for GITHUB_TOKEN
3. `src/templates/` and `src/media/` directories exist

**Problem**: auto-update-sha fails

Check:
1. Release package was published successfully
2. Workflow has write permissions
3. Package naming matches expected format

---

## File Structure

```
scripts/
├── README.md              # This file
├── build-release.sh       # Local build script
└── create-client-fork.sh  # Client fork creation script

.github/workflows/
├── release.yml            # Automated release workflow
└── auto-update-sha.yml    # SHA hash update workflow
```

---

## Contributing

When adding new scripts:

1. Add GPL-3.0-or-later license header
2. Include FILE INFORMATION block
3. Add usage documentation in this README
4. Make scripts executable: `chmod +x scripts/your-script.sh`
5. Test thoroughly before committing

---

## Support

- **Issues**: [GitHub Issues](https://github.com/mokoconsulting-tech/MokoCassiopeia/issues)
- **Email**: hello@mokoconsulting.tech
- **Documentation**: [docs/](../docs/)

---

## License

All scripts are licensed under GPL-3.0-or-later.

Copyright (C) 2026 Moko Consulting
