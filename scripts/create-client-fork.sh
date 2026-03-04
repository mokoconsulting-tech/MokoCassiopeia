#!/bin/bash
# Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
#
# SPDX-License-Identifier: GPL-3.0-or-later
#
# Script: Create Client Fork Setup (Colors Only)
# This script prepares the repository for a client-specific fork by:
# - Copying custom color templates to the appropriate locations
# - Setting up .gitignore to track colors_custom.css files in the fork

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_success() { echo -e "${GREEN}✓${NC} $1"; }
print_error() { echo -e "${RED}✗${NC} $1"; }
print_info() { echo -e "${BLUE}ℹ${NC} $1"; }
print_warning() { echo -e "${YELLOW}⚠${NC} $1"; }

# Check if client name is provided
if [ -z "$1" ]; then
    print_error "Usage: $0 <CLIENT_NAME>"
    echo "Example: $0 \"Acme Corporation\""
    exit 1
fi

CLIENT_NAME="$1"
CLIENT_SLUG=$(echo "${CLIENT_NAME}" | tr '[:upper:]' '[:lower:]' | tr ' ' '-')
BRANCH_NAME="client-fork/${CLIENT_SLUG}"

echo ""
echo "╔════════════════════════════════════════════════════════════════╗"
echo "║     MokoCassiopeia - Client Fork Setup (Colors Only)         ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""
print_info "Client Name: ${CLIENT_NAME}"
print_info "Branch Name: ${BRANCH_NAME}"
print_info "Scope: Custom colors only"
echo ""

# Confirm before proceeding
read -p "Do you want to proceed? (yes/no): " -r
echo
if [[ ! $REPLY =~ ^[Yy]es$ ]]; then
    print_warning "Operation cancelled by user"
    exit 0
fi

# Check if we're in the right directory
if [ ! -f "templates/colors_custom.css" ]; then
    print_error "templates/colors_custom.css not found. Are you in the repository root?"
    exit 1
fi

if [ ! -f "templates/gitignore-template" ]; then
    print_error "templates/gitignore-template not found. Are you in the repository root?"
    exit 1
fi

# Create new branch
print_info "Creating branch: ${BRANCH_NAME}"
git checkout -b "${BRANCH_NAME}"
print_success "Branch created"

# Copy custom color templates
print_info "Copying colors_custom.css to light and dark mode directories..."
mkdir -p src/media/css/colors/light
mkdir -p src/media/css/colors/dark
cp templates/colors_custom.css src/media/css/colors/light/colors_custom.css
cp templates/colors_custom.css src/media/css/colors/dark/colors_custom.css

if [ -f "src/media/css/colors/light/colors_custom.css" ] && [ -f "src/media/css/colors/dark/colors_custom.css" ]; then
    print_success "Created src/media/css/colors/light/colors_custom.css"
    print_success "Created src/media/css/colors/dark/colors_custom.css"
else
    print_error "Failed to create colors_custom.css files"
    exit 1
fi

# Copy template .gitignore to root
print_info "Setting up .gitignore to track custom color files..."
cp templates/gitignore-template .gitignore
print_success "Copied templates/gitignore-template to .gitignore"
print_info "Custom color files will be tracked in this fork"

# Show git status
echo ""
print_info "Git status:"
git status --short

# Commit changes
echo ""
read -p "Commit these changes? (yes/no): " -r
echo
if [[ $REPLY =~ ^[Yy]es$ ]]; then
    git add .
    git commit -m "Setup client fork for ${CLIENT_NAME} (colors only)

- Copied colors_custom.css to src/media/css/colors/light/ and dark/
- Applied client fork .gitignore template to track custom color files
- Kept templates/colors_custom.css as reference template

This commit prepares the repository for ${CLIENT_NAME}'s custom colors."
    
    print_success "Changes committed successfully"
    
    echo ""
    print_info "To push this branch, run:"
    echo "    git push origin ${BRANCH_NAME}"
fi

# Summary
echo ""
echo "╔════════════════════════════════════════════════════════════════╗"
echo "║                  Setup Complete! 🎉                           ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""
echo "Changes Applied:"
print_success "Copied colors_custom.css to src/media/css/colors/light/"
print_success "Copied colors_custom.css to src/media/css/colors/dark/"
print_success "Applied client fork .gitignore template"
print_success "Custom color files will be tracked in this fork"
echo ""
echo "Next Steps:"
echo "1. Review the changes in branch: ${BRANCH_NAME}"
echo "2. Customize colors in src/media/css/colors/light/colors_custom.css"
echo "3. Customize colors in src/media/css/colors/dark/colors_custom.css"
echo "4. Test the colors in both light and dark modes"
echo "5. Create a new repository for ${CLIENT_NAME}"
echo "6. Push this branch to the new repository"
echo "7. In Joomla: System → Site Templates → MokoCassiopeia → Theme tab"
echo "8. Set palette to 'Custom' and save"
echo ""
