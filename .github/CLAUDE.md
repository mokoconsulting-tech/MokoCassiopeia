> [!IMPORTANT]
> **🔧 AI Self-Update Required on First Use**
>
> This file may contain unfilled `{{TOKEN}}` placeholders. The MokoStandards bulk-sync system
> replaces them automatically at sync time; if you can still see them, sync has not yet run for
> this repository — or this is a brand-new repo.
>
> **On your very first interaction in this repository, before answering any other question:**
>
> 1. Check whether any `{{TOKEN}}` placeholders remain in this file.
> 2. If they do, locate the values as described in the table below and replace every occurrence
>    in **both** `.github/copilot-instructions.md` and `.github/CLAUDE.md`.
> 3. After replacing all tokens, **delete this entire notice block** (from `> [!IMPORTANT]`
>    through the closing `> ---` line) in both files.
> 4. Tell the developer: *"I've self-updated the AI context files with this repository's
>    values — all set."*
>
> | Placeholder | Where to find the value |
> |---|---|
> | `MokoCassiopeia` | The GitHub repository name (visible in the URL, `README.md` heading, or `git remote -v`) |
> | `https://github.com/mokoconsulting-tech/MokoCassiopeia` | Full GitHub URL, e.g. `https://github.com/mokoconsulting-tech/<repo-name>` |
> | `A modern enhancement layer for Joomla’s Cassiopeia template. Moko-Cassiopeia adds Font Awesome 7, Bootstrap 5 helpers, an automatic Table of Contents (TOC) utility, and optional expansions including Google Tag Manager and Google Analytics (GA4) hooks.` | First paragraph of `README.md` body, or the GitHub repo description |
> | `{{EXTENSION_NAME}}` | The `<name>` element in `manifest.xml` at the repository root |
> | `{{EXTENSION_TYPE}}` | The `type` attribute of the `<extension>` tag in `manifest.xml` (`component`, `module`, `plugin`, or `template`) |
> | `{{EXTENSION_ELEMENT}}` | The `<element>` tag in `manifest.xml`, or the filename prefix (e.g. `com_myextension`, `mod_mymodule`) |
>
> ---

# What This Repo Is

**MokoCassiopeia** is a Moko Consulting **MokoWaaS** (Joomla) extension repository.

A modern enhancement layer for Joomla’s Cassiopeia template. Moko-Cassiopeia adds Font Awesome 7, Bootstrap 5 helpers, an automatic Table of Contents (TOC) utility, and optional expansions including Google Tag Manager and Google Analytics (GA4) hooks.

Extension name: **{{EXTENSION_NAME}}**
Extension type: **{{EXTENSION_TYPE}}** (`{{EXTENSION_ELEMENT}}`)
Repository URL: https://github.com/mokoconsulting-tech/MokoCassiopeia

This repository is governed by [MokoStandards](https://github.com/mokoconsulting-tech/MokoStandards) — the single source of truth for coding standards, file-header policies, GitHub Actions workflows, and Terraform configuration templates across all Moko Consulting repositories.

---

# Repo Structure

```
MokoCassiopeia/
├── manifest.xml          # Joomla installer manifest (root — required)
├── update.xml            # Update server manifest (root — required)
├── site/                 # Frontend (site) code
│   ├── controller.php
│   ├── controllers/
│   ├── models/
│   └── views/
├── admin/                # Backend (admin) code
│   ├── controller.php
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── sql/
├── language/             # Language INI files
├── media/                # CSS, JS, images
├── docs/                 # Technical documentation
├── tests/                # Test suite
├── .github/
│   ├── workflows/        # CI/CD workflows (synced from MokoStandards)
│   ├── copilot-instructions.md
│   └── CLAUDE.md         # This file
├── README.md             # Version source of truth
├── CHANGELOG.md
├── CONTRIBUTING.md
└── LICENSE               # GPL-3.0-or-later
```

---

# Primary Language

**PHP** (≥ 7.4) is the primary language for this Joomla extension. YAML uses 2-space indentation. All other text files use tabs per `.editorconfig`.

---

# Version Management

**`README.md` is the single source of truth for the repository version.**

- **Bump the patch version on every PR** — increment `XX.YY.ZZ` (e.g. `01.02.03` → `01.02.04`) in `README.md` before opening the PR; the `sync-version-on-merge` workflow propagates it to all `FILE INFORMATION` headers automatically on merge.
- Version format is zero-padded semver: `XX.YY.ZZ` (e.g. `01.02.03`).
- Never hardcode a version number in body text — use the badge or FILE INFORMATION header only.

### Joomla Version Alignment

Three files must **always have the same version**:

| File | Where the version lives |
|------|------------------------|
| `README.md` | `FILE INFORMATION` block + badge |
| `manifest.xml` | `<version>` tag |
| `update.xml` | `<version>` in the most recent `<update>` block |

The `make release` command / release workflow syncs all three automatically.

---

# update.xml — Required in Repo Root

`update.xml` is the Joomla update server manifest. It allows Joomla installations to check for new versions of this extension via:

```xml
<!-- In manifest.xml -->
<updateservers>
	<server type="extension" priority="1" name="{{EXTENSION_NAME}}">
		https://github.com/mokoconsulting-tech/MokoCassiopeia/raw/main/update.xml
	</server>
</updateservers>
```

**Rules:**
- Every release prepends a new `<update>` block at the top — older entries are preserved.
- `<version>` in `update.xml` must exactly match `<version>` in `manifest.xml` and `README.md`.
- `<downloadurl>` must be a publicly accessible GitHub Releases asset URL.
- `<targetplatform version="4\.[0-9]+">` — backslash is literal (Joomla regex syntax).

Example `update.xml` entry for a new release:
```xml
<updates>
	<update>
		<name>{{EXTENSION_NAME}}</name>
		<description>MokoCassiopeia</description>
		<element>{{EXTENSION_ELEMENT}}</element>
		<type>{{EXTENSION_TYPE}}</type>
		<version>01.02.04</version>
		<infourl title="Release Information">https://github.com/mokoconsulting-tech/MokoCassiopeia/releases/tag/01.02.04</infourl>
		<downloads>
			<downloadurl type="full" format="zip">
				https://github.com/mokoconsulting-tech/MokoCassiopeia/releases/download/01.02.04/{{EXTENSION_ELEMENT}}-01.02.04.zip
			</downloadurl>
		</downloads>
		<targetplatform name="joomla" version="4\.[0-9]+" />
		<php_minimum>7.4</php_minimum>
		<maintainer>Moko Consulting</maintainer>
		<maintainerurl>https://mokoconsulting.tech</maintainerurl>
	</update>
</updates>
```

---

# File Header Requirements

Every new file **must** have a copyright header as its first content. JSON files, binary files, generated files, and third-party files are exempt.

**PHP:**
```php
<?php
/* Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 *
 * FILE INFORMATION
 * DEFGROUP: MokoCassiopeia.{{EXTENSION_TYPE}}
 * INGROUP: MokoCassiopeia
 * REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 * PATH: /site/controllers/item.php
 * VERSION: XX.YY.ZZ
 * BRIEF: One-line description of file purpose
 */

defined('_JEXEC') or die;
```

**Markdown / YAML / Shell / XML:** Use the appropriate comment syntax with the same fields.

---

# Coding Standards

## Naming Conventions

| Context | Convention | Example |
|---------|-----------|---------|
| PHP class | `PascalCase` | `ItemModel` |
| PHP method / function | `camelCase` | `getItems()` |
| PHP variable | `$snake_case` | `$item_id` |
| PHP constant | `UPPER_SNAKE_CASE` | `MAX_ITEMS` |
| PHP class file | `PascalCase.php` | `ItemModel.php` |
| YAML workflow | `kebab-case.yml` | `ci-joomla.yml` |
| Markdown doc | `kebab-case.md` | `installation-guide.md` |

## Commit Messages

Format: `<type>(<scope>): <subject>` — imperative, lower-case subject, no trailing period.

Valid types: `feat` · `fix` · `docs` · `chore` · `ci` · `refactor` · `style` · `test` · `perf` · `revert` · `build`

## Branch Naming

Format: `<prefix>/<MAJOR.MINOR.PATCH>[/description]`

Approved prefixes: `dev/` · `rc/` · `version/` · `patch/` · `copilot/` · `dependabot/`

---

# GitHub Actions — Token Usage

Every workflow must use **`secrets.GH_TOKEN`** (the org-level Personal Access Token).

```yaml
# ✅ Correct
- uses: actions/checkout@v4
  with:
    token: ${{ secrets.GH_TOKEN }}

env:
  GH_TOKEN: ${{ secrets.GH_TOKEN }}
```

```yaml
# ❌ Wrong — never use these
token: ${{ github.token }}
token: ${{ secrets.GITHUB_TOKEN }}
```

---

# Keeping Documentation Current

| Change type | Documentation to update |
|-------------|------------------------|
| New or renamed PHP class/method | PHPDoc block; `docs/api/` entry |
| New or changed `manifest.xml` | Sync version to `update.xml` and `README.md` |
| New release | Prepend `<update>` to `update.xml`; update `CHANGELOG.md`; bump `README.md` |
| New or changed workflow | `docs/workflows/<workflow-name>.md` |
| Any modified file | Update the `VERSION` field in that file's `FILE INFORMATION` block |
| **Every PR** | **Bump the patch version** — increment `XX.YY.ZZ` in `README.md`; `sync-version-on-merge` propagates it |

---

# What NOT to Do

- **Never commit directly to `main`** — all changes go through a PR.
- **Never hardcode version numbers** in body text — update `README.md` and let automation propagate.
- **Never let `manifest.xml`, `update.xml`, and `README.md` versions diverge.**
- **Never skip the FILE INFORMATION block** on a new source file.
- **Never use bare `catch (\Throwable $e) {}`** — always log or re-throw.
- **Never mix tabs and spaces** within a file — follow `.editorconfig`.
- **Never use `github.token` or `secrets.GITHUB_TOKEN` in workflows** — always use `secrets.GH_TOKEN`.
- **Never remove `defined('_JEXEC') or die;`** from web-accessible PHP files.

---

# PR Checklist

Before opening a PR, verify:

- [ ] Patch version bumped in `README.md` (e.g. `01.02.03` → `01.02.04`)
- [ ] If this is a release: `manifest.xml` version updated; `update.xml` updated with new entry
- [ ] FILE INFORMATION headers updated in modified files
- [ ] CHANGELOG.md updated
- [ ] Tests pass

---

# Key Policy Documents (MokoStandards)

| Document | Purpose |
|----------|---------|
| [file-header-standards.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/file-header-standards.md) | Copyright-header rules for every file type |
| [coding-style-guide.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/coding-style-guide.md) | Naming and formatting conventions |
| [branching-strategy.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/branching-strategy.md) | Branch naming, hierarchy, and release workflow |
| [merge-strategy.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/merge-strategy.md) | Squash-merge policy and PR conventions |
| [changelog-standards.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/changelog-standards.md) | How and when to update CHANGELOG.md |
| [joomla-development-guide.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/guide/waas/joomla-development-guide.md) | MokoWaaS Joomla extension development guide |