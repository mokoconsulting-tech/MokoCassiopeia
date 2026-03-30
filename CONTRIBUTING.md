<!--
 Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later

 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the IMPLIED WARRANTY of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

 You should have received a copy of the GNU General Public License (./LICENSE).

 # FILE INFORMATION
 DEFGROUP: {{DEFGROUP}}
 INGROUP: Project.Documentation
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 VERSION: 04.03.00
 PATH: ./CONTRIBUTING.md
 BRIEF: How to contribute; branch strategy, commit conventions, PR workflow, and release pipeline
 -->

# Contributing

Thank you for your interest in contributing to **MokoCassiopeia**!

This repository is governed by **[MokoStandards](https://github.com/mokoconsulting-tech/MokoStandards)** — the authoritative source of coding standards, workflows, and policies for all Moko Consulting repositories.

## Branch Strategy

| Branch | Purpose | Deploys To |
|--------|---------|------------|
| `main` | Bleeding edge — all development merges here | CI only |
| `dev/XX.YY.ZZ` | Feature development | Dev server (version: "development") |
| `version/XX.YY.ZZ` | Stable frozen snapshot | Demo + RS servers |

### Development Workflow

```
1. Create branch:   git checkout -b dev/XX.YY.ZZ/my-feature
2. Develop + test    (dev server auto-deploys on push)
3. Open PR → main    (squash merge only)
4. Auto-release      (version branch + tag + GitHub Release created automatically)
```

### Branch Naming

| Prefix | Use |
|--------|-----|
| `dev/XX.YY.ZZ` | Feature development (e.g., `dev/02.00.00/add-extrafields`) |
| `version/XX.YY.ZZ` | Stable release (auto-created, never manually pushed) |
| `chore/` | Automated sync branches (managed by MokoStandards) |

> **Never use** `feature/`, `hotfix/`, or `release/` prefixes — they are not part of the MokoStandards branch strategy.

## Commit Conventions

Use [conventional commits](https://www.conventionalcommits.org/):

```
feat(scope): add new extrafield for invoice tracking
fix(sql): correct column type in llx_mytable
docs(readme): update installation instructions
chore(deps): bump enterprise library to 04.02.30
```

**Valid types:** `feat` | `fix` | `docs` | `chore` | `ci` | `refactor` | `style` | `test` | `perf` | `revert` | `build`

## Pull Request Workflow

1. **Branch** from `main` using `dev/XX.YY.ZZ/description` format
2. **Bump** the patch version in `README.md` before opening the PR
3. **Title** must be a valid conventional commit subject line
4. **Target** `main` — squash merge only (merge commits are disabled)
5. **CI checks** must pass before merge

### What Happens on Merge

When your PR is merged to `main`, these workflows run automatically:

1. **sync-version-on-merge** — auto-bumps patch version, propagates to all file headers
2. **auto-release** — creates `version/XX.YY.ZZ` branch, git tag, and GitHub Release
3. **deploy-demo / deploy-rs** — deploys to demo and RS servers (if `src/**` changed)

## Coding Standards

All contributions must follow [MokoStandards](https://github.com/mokoconsulting-tech/MokoStandards):

| Standard | Reference |
|----------|-----------|
| Coding Style | [coding-style-guide.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/coding-style-guide.md) |
| File Headers | [file-header-standards.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/file-header-standards.md) |
| Branching | [branch-release-strategy.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/branch-release-strategy.md) |
| Merge Strategy | [merge-strategy.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/merge-strategy.md) |
| Scripting | [scripting-standards.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/scripting-standards.md) |
| Build & Release | [build-release.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/workflows/build-release.md) |

## PR Checklist

- [ ] Branch named `dev/XX.YY.ZZ/description`
- [ ] Patch version bumped in `README.md`
- [ ] Conventional commit format for PR title
- [ ] All new files have FILE INFORMATION headers
- [ ] `declare(strict_types=1)` in all PHP files
- [ ] PHPDoc on all public methods
- [ ] Tests pass
- [ ] CHANGELOG.md updated
- [ ] No secrets, tokens, or credentials committed

## Custom Workflows

Place repo-specific workflows in `.github/workflows/custom/` — they are **never overwritten or deleted** by MokoStandards sync:

```
.github/workflows/
├── deploy-dev.yml              ← Synced from MokoStandards
├── auto-release.yml            ← Synced from MokoStandards
└── custom/                     ← Your custom workflows (safe)
    └── my-custom-ci.yml
```

## License

By contributing, you agree that your contributions will be licensed under the [GPL-3.0-or-later](LICENSE) license.

---

*This file is synced from [MokoStandards](https://github.com/mokoconsulting-tech/MokoStandards). Do not edit directly — changes will be overwritten on the next sync.*
