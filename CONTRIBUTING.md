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
 VERSION: 04.02.29
 PATH: ./CONTRIBUTING.md
 BRIEF: How to contribute; commit, PR, testing and security policies
 -->

# Contributing

Thank you for your interest in contributing to this project!

This repository is governed by **[MokoStandards](https://github.com/mokoconsulting-tech/MokoStandards)** — the authoritative source of coding standards, workflows, and policies for all Moko Consulting repositories.

## Quick Start

1. **Fork** the repository
2. **Branch** from `main` using `dev/XX.YY.ZZ/description` format
3. **Follow** [MokoStandards coding conventions](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/coding-style-guide.md)
4. **Commit** using [conventional commits](https://www.conventionalcommits.org/): `feat:`, `fix:`, `docs:`, `chore:`, etc.
5. **Open a PR** targeting `main` — squash merge only

## Standards

All contributions must follow MokoStandards:

| Standard | Reference |
|----------|-----------|
| Coding Style | [coding-style-guide.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/coding-style-guide.md) |
| File Headers | [file-header-standards.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/file-header-standards.md) |
| Branching | [branching-strategy.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/branching-strategy.md) |
| Merge Strategy | [merge-strategy.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/merge-strategy.md) |
| Scripting | [scripting-standards.md](https://github.com/mokoconsulting-tech/MokoStandards/blob/main/docs/policy/scripting-standards.md) |

## Version Bumping

Every PR must bump the patch version in `README.md`. The `sync-version-on-merge` workflow propagates it to all file headers automatically on merge to `main`.

## License

By contributing, you agree that your contributions will be licensed under the [GPL-3.0-or-later](LICENSE) license.
