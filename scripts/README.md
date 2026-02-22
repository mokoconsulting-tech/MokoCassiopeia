# MokoCassiopeia Scripts Directory

This directory contains utility scripts for maintaining and managing the MokoCassiopeia template repository.

## Available Scripts

### cleanup-naming.sh

**Purpose**: Standardizes naming convention by renaming all instances of "Moko-Cassiopeia" (hyphenated) to "MokoCassiopeia" (camelCase).

**Usage**:
```bash
# Preview changes (dry-run mode - default)
./scripts/cleanup-naming.sh --dry-run

# Execute changes with backup files
./scripts/cleanup-naming.sh --execute --backup

# Execute changes without backup
./scripts/cleanup-naming.sh --execute

# Show help
./scripts/cleanup-naming.sh --help
```

**Features**:
- 🔍 **Dry-run mode**: Preview all changes before executing
- 💾 **Backup option**: Create `.bak` files before modification
- 📊 **Statistics**: Track files scanned, modified, and replacements made
- 🎨 **Colored output**: Easy-to-read console output
- ⚠️ **Safety checks**: Validates git repository and warns about uncommitted changes
- 📝 **Comprehensive logging**: Shows exactly what will be changed

**What it changes**:
- `Moko-Cassiopeia` → `MokoCassiopeia` (display name)
- `moko-cassiopeia` → `mokocassiopeia` (identifiers, paths)

**Files affected**:
- Documentation files (`.md`)
- PHP files (`.php`)
- XML files (`.xml`)
- Language files (`.ini`)
- JavaScript files (`.js`)
- CSS files (`.css`)
- Configuration files (`.json`, `.yml`, `.yaml`)
- Text files (`.txt`)
- Shell scripts (`.sh`)

**Safety**:
- Skips `.git` directory and `node_modules`
- Skips the cleanup script itself
- Requires explicit confirmation in execute mode
- Warns about uncommitted changes

**Example Output**:
```
╔════════════════════════════════════════════════════════════════╗
║     MokoCassiopeia Naming Cleanup Script v1.0.0               ║
║     Moko-Cassiopeia → MokoCassiopeia                          ║
╚════════════════════════════════════════════════════════════════╝

[INFO] Scanning repository: /path/to/repo

[INFO] Would modify: CHANGELOG.md (6 occurrences)
[INFO] Would modify: docs/README.md (2 occurrences)

╔════════════════════════════════════════════════════════════════╗
║                        Summary                                 ║
╠════════════════════════════════════════════════════════════════╣
║  Files Scanned:       106                                      ║
║  Files Modified:      11                                       ║
║  Replacements:        21                                       ║
╚════════════════════════════════════════════════════════════════╝
```

---

### create-client-fork.sh

**Purpose**: Automates the creation of client-specific forks of the MokoCassiopeia template.

**Usage**:
See [CLIENT_FORK_WORKFLOW.md](../docs/CLIENT_FORK_WORKFLOW.md) for detailed documentation.

```bash
./scripts/create-client-fork.sh
```

**Features**:
- Sets up custom color schemes
- Prepares client-specific documentation
- Removes template files
- Configures fork for client use

---

## Script Development Guidelines

When creating new scripts for this repository:

1. **Shebang**: Start with `#!/bin/bash`
2. **Documentation**: Include comprehensive header comments
3. **Options**: Support `--help` flag
4. **Safety**: Include dry-run mode for destructive operations
5. **Feedback**: Provide clear, colored output
6. **Error Handling**: Use `set -e` and proper error messages
7. **Git Awareness**: Check for git repository and uncommitted changes
8. **Portability**: Test on both Linux and macOS

## Testing Scripts

Before committing a new script:

1. Test in dry-run mode
2. Test with actual execution
3. Verify error handling
4. Check help output
5. Test on sample files
6. Document in this README

## Contributing

If you create a new script:

1. Add it to this directory
2. Make it executable: `chmod +x scripts/your-script.sh`
3. Document it in this README
4. Update CHANGELOG.md
5. Create a PR with thorough testing notes

---

**Last Updated**: 2026-02-22  
**Repository**: https://github.com/mokoconsulting-tech/MokoCassiopeia
