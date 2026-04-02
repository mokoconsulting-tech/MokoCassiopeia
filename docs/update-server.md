<!--
Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

This file is part of a Moko Consulting project.

SPDX-License-Identifier: GPL-3.0-or-later

# FILE INFORMATION
DEFGROUP: MokoCassiopeia.Documentation
INGROUP: MokoStandards.Templates
REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
PATH: /docs/update-server.md
VERSION: 04.04.00
BRIEF: How this extension's Joomla update server file (update.xml) is managed
-->

# Joomla Update Server

[![MokoStandards](https://img.shields.io/badge/MokoStandards-04.04.00-blue)](https://github.com/mokoconsulting-tech/MokoStandards)

This document explains how `update.xml` is automatically managed for this Joomla extension following the [Joomla Update Server specification](https://docs.joomla.org/Deploying_an_Update_Server).

## How It Works

Joomla checks for extension updates by fetching an XML file from the URL defined in the `<updateservers>` tag in the extension's XML manifest. MokoStandards generates this file automatically.

### Automatic Generation

| Event | Workflow | `<tag>` | `<version>` |
|-------|----------|---------|-------------|
| Merge to `main` | `auto-release.yml` | `stable` | `XX.YY.ZZ` |
| Push to `dev/**` | `deploy-dev.yml` | `development` | `development` |
| Push to `rc/**` | `deploy-dev.yml` | `rc` | `XX.YY.ZZ-rc` |

### Generated XML Structure

```xml
<?xml version="1.0" encoding="utf-8"?>
<updates>
    <update>
        <name>Extension Name</name>
        <description>Extension Name update</description>
        <element>com_extensionname</element>
        <type>component</type>
        <version>01.02.03</version>
        <client>site</client>
        <folder>system</folder>          <!-- plugins only -->
        <tags>
            <tag>stable</tag>
        </tags>
        <infourl title="Extension Name">https://github.com/.../releases/tag/v01.02.03</infourl>
        <downloads>
            <downloadurl type="full" format="zip">https://github.com/.../releases/download/v01.02.03/com_ext-01.02.03.zip</downloadurl>
        </downloads>
        <targetplatform name="joomla" version="((5\.[0-9])|(6\.[0-9]))" />
        <php_minimum>8.2</php_minimum>   <!-- if present in manifest -->
        <maintainer>Moko Consulting</maintainer>
        <maintainerurl>https://mokoconsulting.tech</maintainerurl>
    </update>
</updates>
```

### Metadata Source

All metadata is extracted from the extension's XML manifest (`src/*.xml`) at build time:

| XML Element | Source | Notes |
|-------------|--------|-------|
| `<name>` | `<name>` in manifest | Extension display name |
| `<element>` | `<element>` in manifest | Must match installed extension identifier |
| `<type>` | `type` attribute on `<extension>` | `component`, `module`, `plugin`, `library`, `package`, `template` |
| `<client>` | `client` attribute on `<extension>` | `site` or `administrator` — **required for plugins and modules** |
| `<folder>` | `group` attribute on `<extension>` | Plugin group (e.g., `system`, `content`) — **required for plugins** |
| `<targetplatform>` | `<targetplatform>` in manifest | Falls back to Joomla 5.x / 6.x if not specified |
| `<php_minimum>` | `<php_minimum>` in manifest | Included only if present |

### Extension Manifest Setup

Your XML manifest must include an `<updateservers>` tag pointing to the `update.xml` on the `main` branch:

```xml
<extension type="component" client="site" method="upgrade">
    <name>My Extension</name>
    <element>com_myextension</element>
    <!-- ... -->
    <updateservers>
        <server type="extension" name="My Extension Updates">
            https://raw.githubusercontent.com/mokoconsulting-tech/MokoCassiopeia/main/update.xml
        </server>
    </updateservers>
</extension>
```

### Branch Lifecycle

```
dev/XX.YY.ZZ  →  rc/XX.YY.ZZ  →  main  →  version/XX.YY
(development)     (rc)              (stable)    (frozen snapshot)
```

1. **Development** (`dev/**`): `update.xml` with `<tag>development</tag>`, download points to branch archive
2. **Release Candidate** (`rc/**`): `update.xml` with `<tag>rc</tag>`, version set to `XX.YY.ZZ-rc`
3. **Stable Release** (merge to `main`): `update.xml` with `<tag>stable</tag>`, download points to GitHub Release asset
4. **Frozen Snapshot** (`version/XX.YY`): immutable, never force-pushed

### Health Checks

The `repo_health.yml` workflow verifies on every commit:

- `update.xml` exists in the repository root
- XML manifest exists with `<extension>` tag
- `<version>`, `<name>`, `<author>`, `<namespace>` tags present
- Extension `type` attribute is valid
- Language `.ini` files exist
- `index.html` directory listing protection in `src/`, `src/admin/`, `src/site/`

---

*Managed by [MokoStandards](https://github.com/mokoconsulting-tech/MokoStandards). See [docs/workflows/update-server.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/workflows/update-server.md) for the full specification.*
