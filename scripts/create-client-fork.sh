#!/bin/bash
# Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
#
# SPDX-License-Identifier: GPL-3.0-or-later
#
# Script: Create Client Fork Setup
# This script prepares the repository for a client-specific fork by:
# - Copying custom color templates to the appropriate locations
# - Replacing the main README with the client fork README
# - Cleaning up template documentation files

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
echo "║         MokoCassiopeia - Client Fork Setup Script            ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""
print_info "Client Name: ${CLIENT_NAME}"
print_info "Branch Name: ${BRANCH_NAME}"
echo ""

# Confirm before proceeding
read -p "Do you want to proceed? (yes/no): " -r
echo
if [[ ! $REPLY =~ ^[Yy]es$ ]]; then
    print_warning "Operation cancelled by user"
    exit 0
fi

# Check if we're in the right directory
if [ ! -f "CLIENT_FORK_README.md" ]; then
    print_error "CLIENT_FORK_README.md not found. Are you in the repository root?"
    exit 1
fi

# Create new branch
print_info "Creating branch: ${BRANCH_NAME}"
git checkout -b "${BRANCH_NAME}"
print_success "Branch created"

# Copy custom color templates
print_info "Copying colors_custom.css to light and dark mode directories..."
cp templates/colors_custom.css src/media/css/colors/light/colors_custom.css
cp templates/colors_custom.css src/media/css/colors/dark/colors_custom.css

if [ -f "src/media/css/colors/light/colors_custom.css" ] && [ -f "src/media/css/colors/dark/colors_custom.css" ]; then
    print_success "Created src/media/css/colors/light/colors_custom.css"
    print_success "Created src/media/css/colors/dark/colors_custom.css"
else
    print_error "Failed to create colors_custom.css files"
    exit 1
fi

# Replace README with client fork README
print_info "Replacing README.md with CLIENT_FORK_README.md..."
sed "s/\[CLIENT NAME\]/${CLIENT_NAME}/g" CLIENT_FORK_README.md > README.md.new
mv README.md.new README.md

# Update fork information section
CURRENT_DATE=$(date +"%Y-%m-%d")
sed -i.bak "s/\[DATE\]/${CURRENT_DATE}/g" README.md
sed -i.bak "s/\[YOUR-FORK-URL\]/[UPDATE-WITH-YOUR-FORK-URL]/g" README.md
rm -f README.md.bak

print_success "README.md replaced with customized client fork README"

# Clean up template files
print_info "Removing template documentation files..."

if [ -f "CLIENT_FORK_README.md" ]; then
    rm CLIENT_FORK_README.md
    print_success "Removed CLIENT_FORK_README.md"
fi

if [ -f "templates/CLIENT_FORK_README_TEMPLATE.md" ]; then
    rm templates/CLIENT_FORK_README_TEMPLATE.md
    print_success "Removed templates/CLIENT_FORK_README_TEMPLATE.md"
fi

# Update templates/README.md
if [ -f "templates/README.md" ]; then
    # Create a backup
    cp templates/README.md templates/README.md.bak
    
    # Remove references to CLIENT_FORK_README_TEMPLATE.md
    sed '/CLIENT_FORK_README_TEMPLATE.md/d' templates/README.md > templates/README.md.tmp
    mv templates/README.md.tmp templates/README.md
    rm -f templates/README.md.bak
    
    print_success "Updated templates/README.md"
fi

print_success "Keeping templates/colors_custom.css as template"

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
    git commit -m "Setup client fork for ${CLIENT_NAME}

- Copied colors_custom.css to src/media/css/colors/light/ and dark/
- Replaced README.md with customized CLIENT_FORK_README.md
- Removed CLIENT_FORK_README.md and templates/CLIENT_FORK_README_TEMPLATE.md
- Kept templates/colors_custom.css as template

This commit prepares the repository for ${CLIENT_NAME}'s custom fork."
    
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
print_success "Replaced README.md with customized client fork README"
print_success "Removed CLIENT_FORK_README.md"
print_success "Removed templates/CLIENT_FORK_README_TEMPLATE.md"
print_success "Kept templates/colors_custom.css as template"
echo ""
echo "Next Steps:"
echo "1. Review the changes in branch: ${BRANCH_NAME}"
echo "2. Customize colors in src/media/css/colors/light/colors_custom.css"
echo "3. Customize colors in src/media/css/colors/dark/colors_custom.css"
echo "4. Update README.md with client-specific details"
echo "5. Create a new repository for ${CLIENT_NAME}"
echo "6. Push this branch to the new repository"
echo ""
