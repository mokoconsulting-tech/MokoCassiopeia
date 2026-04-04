/* Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>

 This file is part of a Moko Consulting project.

 SPDX-License-Identifier: GPL-3.0-or-later
 */

(function (win, doc) {
	"use strict";

	// ========================================================================
	// THEME INITIALIZATION (Early theme application)
	// ========================================================================
	var storageKey = "theme";
	var mql = win.matchMedia("(prefers-color-scheme: dark)");
	var root = doc.documentElement;

	/**
	 * Apply theme to <html>, syncing both data-bs-theme and data-aria-theme.
	 * @param {"light"|"dark"} theme
	 */
	function applyTheme(theme) {
		root.setAttribute("data-bs-theme", theme);
		root.setAttribute("data-aria-theme", theme);
		try { localStorage.setItem(storageKey, theme); } catch (e) {}
	}

	/**
	 * Clear stored preference so system preference is followed.
	 */
	function clearStored() {
		try { localStorage.removeItem(storageKey); } catch (e) {}
	}

	/**
	 * Determine system theme.
	 */
	function systemTheme() {
		return mql.matches ? "dark" : "light";
	}

	/**
	 * Get stored theme preference.
	 */
	function getStored() {
		try { return localStorage.getItem(storageKey); } catch (e) { return null; }
	}

	// ========================================================================
	// FLOATING THEME TOGGLE (FAB)
	// ========================================================================
	function posClassFromBody() {
		var pos = (doc.body.getAttribute('data-theme-fab-pos') || 'br').toLowerCase();
		if (!/^(br|bl|tr|tl)$/.test(pos)) pos = 'br';
		return 'pos-' + pos;
	}

	function buildThemeToggle() {
		if (doc.getElementById('mokoThemeFab')) return;

		var wrap = doc.createElement('div');
		wrap.id = 'mokoThemeFab';
		wrap.className = posClassFromBody();

		// Light label
		var lblL = doc.createElement('span');
		lblL.className = 'label';
		lblL.textContent = 'Light';

		// Switch
		var switchWrap = doc.createElement('button');
		switchWrap.id = 'mokoThemeSwitch';
		switchWrap.type = 'button';
		switchWrap.setAttribute('role', 'switch');
		switchWrap.setAttribute('aria-label', 'Toggle dark mode');
		switchWrap.setAttribute('aria-checked', 'false');

		var track = doc.createElement('span');
		track.className = 'switch';
		var knob = doc.createElement('span');
		knob.className = 'knob';
		track.appendChild(knob);
		switchWrap.appendChild(track);

		// Dark label
		var lblD = doc.createElement('span');
		lblD.className = 'label';
		lblD.textContent = 'Dark';

		// Auto button
		var auto = doc.createElement('button');
		auto.id = 'mokoThemeAuto';
		auto.type = 'button';
		auto.className = 'btn btn-sm btn-link text-decoration-none px-2';
		auto.setAttribute('aria-label', 'Follow system theme');
		auto.textContent = 'Auto';

		// Behavior
		switchWrap.addEventListener('click', function () {
			var current = (root.getAttribute('data-bs-theme') || 'light').toLowerCase();
			var next = current === 'dark' ? 'light' : 'dark';
			applyTheme(next);
			switchWrap.setAttribute('aria-checked', next === 'dark' ? 'true' : 'false');
			// Update meta theme color
			var meta = doc.querySelector('meta[name="theme-color"]');
			if (meta) {
				meta.setAttribute('content', next === 'dark' ? '#0f1115' : '#ffffff');
			}
		});

		auto.addEventListener('click', function () {
			clearStored();
			var sys = systemTheme();
			applyTheme(sys);
			switchWrap.setAttribute('aria-checked', sys === 'dark' ? 'true' : 'false');
		});

		// Respond to OS changes only when not user-forced
		var onMql = function () {
			if (!getStored()) {
				var sys = systemTheme();
				applyTheme(sys);
				switchWrap.setAttribute('aria-checked', sys === 'dark' ? 'true' : 'false');
			}
		};
		if (typeof mql.addEventListener === 'function') mql.addEventListener('change', onMql);
		else if (typeof mql.addListener === 'function') mql.addListener(onMql);

		// Initial state
		var initial = getStored() || systemTheme();
		switchWrap.setAttribute('aria-checked', initial === 'dark' ? 'true' : 'false');

		// Mount
		wrap.appendChild(lblL);
		wrap.appendChild(switchWrap);
		wrap.appendChild(lblD);
		wrap.appendChild(auto);
		doc.body.appendChild(wrap);

		// Debug helper
		win.mokoThemeFabStatus = function () {
			var el = doc.getElementById('mokoThemeFab');
			if (!el) return { mounted: false };
			var r = el.getBoundingClientRect();
			return {
				mounted: true,
				rect: { top: r.top, left: r.left, width: r.width, height: r.height },
				zIndex: win.getComputedStyle(el).zIndex,
				posClass: el.className
			};
		};

		// Outline if invisible
		setTimeout(function () {
			var r = wrap.getBoundingClientRect();
			if (r.width < 10 || r.height < 10) {
				wrap.classList.add('debug-outline');
				console.warn('[moko] Theme FAB mounted but appears too small — check CSS collisions.');
			}
		}, 50);
	}

	// ========================================================================
	// ACCESSIBILITY TOOLBAR
	// ========================================================================
	var a11yStorageKey = "moko-a11y";
	var fontSizeSteps = [85, 90, 100, 110, 120, 130];
	var defaultStep = 2; // index of 100

	function getA11yPrefs() {
		try {
			var raw = localStorage.getItem(a11yStorageKey);
			if (raw) return JSON.parse(raw);
		} catch (e) {}
		return { fontStep: defaultStep, inverted: false, contrast: false, links: false, font: false, paused: false };
	}

	function saveA11yPrefs(prefs) {
		try { localStorage.setItem(a11yStorageKey, JSON.stringify(prefs)); } catch (e) {}
	}

	function applyFontSize(step) {
		root.style.fontSize = fontSizeSteps[step] + "%";
	}

	function applyInversion(on) {
		if (on) {
			root.classList.add("a11y-inverted");
		} else {
			root.classList.remove("a11y-inverted");
		}
	}

	function applyContrast(on) {
		root.classList.toggle("a11y-high-contrast", on);
	}

	function applyLinks(on) {
		root.classList.toggle("a11y-highlight-links", on);
	}

	function applyFont(on) {
		root.classList.toggle("a11y-readable-font", on);
	}

	function applyPaused(on) {
		root.classList.toggle("a11y-pause-animations", on);
	}

	/** Create a Font Awesome icon element (safe DOM, no innerHTML). */
	function faIcon(classes) {
		var span = doc.createElement("span");
		span.className = classes;
		span.setAttribute("aria-hidden", "true");
		return span;
	}

	function buildA11yToolbar() {
		if (doc.getElementById("mokoA11yToolbar")) return;

		var body = doc.body;
		var showResize     = body.getAttribute("data-a11y-resize") === "1";
		var showInvert     = body.getAttribute("data-a11y-invert") === "1";
		var showContrast   = body.getAttribute("data-a11y-contrast") === "1";
		var showLinks      = body.getAttribute("data-a11y-links") === "1";
		var showFont       = body.getAttribute("data-a11y-font") === "1";
		var showAnimations = body.getAttribute("data-a11y-animations") === "1";
		var pos = (body.getAttribute("data-a11y-pos") || "tl").toLowerCase();
		if (!/^(br|bl|tr|tl)$/.test(pos)) pos = "tl";

		var prefs = getA11yPrefs();

		// Container
		var toolbar = doc.createElement("div");
		toolbar.id = "mokoA11yToolbar";
		toolbar.className = "a11y-pos-" + pos;
		toolbar.setAttribute("role", "toolbar");
		toolbar.setAttribute("aria-label", "Accessibility options");

		// Toggle button (accessibility icon)
		var toggle = doc.createElement("button");
		toggle.type = "button";
		toggle.id = "mokoA11yToggle";
		toggle.className = "a11y-toggle";
		toggle.setAttribute("aria-label", "Accessibility options");
		toggle.setAttribute("aria-expanded", "false");
		toggle.appendChild(faIcon("fa-solid fa-universal-access"));

		// Panel
		var panel = doc.createElement("div");
		panel.id = "mokoA11yPanel";
		panel.className = "a11y-panel";
		panel.hidden = true;

		// --- Text resize controls ---
		if (showResize) {
			var resizeGroup = doc.createElement("div");
			resizeGroup.className = "a11y-group";
			resizeGroup.setAttribute("role", "group");
			resizeGroup.setAttribute("aria-label", "Text size");

			var sizeLabel = doc.createElement("span");
			sizeLabel.className = "a11y-group-label";
			sizeLabel.textContent = "Text size";
			resizeGroup.appendChild(sizeLabel);

			var btnRow = doc.createElement("div");
			btnRow.className = "a11y-btn-row";

			var btnMinus = doc.createElement("button");
			btnMinus.type = "button";
			btnMinus.className = "a11y-btn";
			btnMinus.setAttribute("aria-label", "Decrease text size");
			btnMinus.appendChild(faIcon("fa-solid fa-minus"));

			var sizeDisplay = doc.createElement("span");
			sizeDisplay.className = "a11y-size-display";
			sizeDisplay.setAttribute("aria-live", "polite");
			sizeDisplay.textContent = fontSizeSteps[prefs.fontStep] + "%";

			var btnPlus = doc.createElement("button");
			btnPlus.type = "button";
			btnPlus.className = "a11y-btn";
			btnPlus.setAttribute("aria-label", "Increase text size");
			btnPlus.appendChild(faIcon("fa-solid fa-plus"));

			var btnReset = doc.createElement("button");
			btnReset.type = "button";
			btnReset.className = "a11y-btn a11y-btn-reset";
			btnReset.setAttribute("aria-label", "Reset text size");
			btnReset.appendChild(faIcon("fa-solid fa-rotate-left"));

			btnMinus.addEventListener("click", function () {
				if (prefs.fontStep > 0) {
					prefs.fontStep--;
					applyFontSize(prefs.fontStep);
					sizeDisplay.textContent = fontSizeSteps[prefs.fontStep] + "%";
					saveA11yPrefs(prefs);
				}
			});

			btnPlus.addEventListener("click", function () {
				if (prefs.fontStep < fontSizeSteps.length - 1) {
					prefs.fontStep++;
					applyFontSize(prefs.fontStep);
					sizeDisplay.textContent = fontSizeSteps[prefs.fontStep] + "%";
					saveA11yPrefs(prefs);
				}
			});

			btnReset.addEventListener("click", function () {
				prefs.fontStep = defaultStep;
				applyFontSize(prefs.fontStep);
				sizeDisplay.textContent = fontSizeSteps[prefs.fontStep] + "%";
				saveA11yPrefs(prefs);
			});

			btnRow.appendChild(btnMinus);
			btnRow.appendChild(sizeDisplay);
			btnRow.appendChild(btnPlus);
			btnRow.appendChild(btnReset);
			resizeGroup.appendChild(btnRow);
			panel.appendChild(resizeGroup);
		}

		// --- Helper: build a switch-style toggle button ---
		function addSwitchOption(show, prefKey, icon, label, applyFn) {
			if (!show) return;
			var group = doc.createElement("div");
			group.className = "a11y-group";

			var btn = doc.createElement("button");
			btn.type = "button";
			btn.className = "a11y-btn a11y-btn-wide";
			btn.setAttribute("role", "switch");
			btn.setAttribute("aria-checked", prefs[prefKey] ? "true" : "false");
			btn.setAttribute("aria-label", label);
			btn.appendChild(faIcon(icon));
			btn.appendChild(doc.createTextNode(" " + label));

			if (prefs[prefKey]) btn.classList.add("active");

			btn.addEventListener("click", function () {
				prefs[prefKey] = !prefs[prefKey];
				applyFn(prefs[prefKey]);
				btn.setAttribute("aria-checked", prefs[prefKey] ? "true" : "false");
				btn.classList.toggle("active", prefs[prefKey]);
				saveA11yPrefs(prefs);
			});

			group.appendChild(btn);
			panel.appendChild(group);
		}

		// --- Toggle options ---
		addSwitchOption(showInvert,     "inverted", "fa-solid fa-circle-half-stroke", "Invert colors",      applyInversion);
		addSwitchOption(showContrast,   "contrast", "fa-solid fa-adjust",             "High contrast",      applyContrast);
		addSwitchOption(showLinks,      "links",    "fa-solid fa-link",               "Highlight links",    applyLinks);
		addSwitchOption(showFont,       "font",     "fa-solid fa-font",               "Readable font",      applyFont);
		addSwitchOption(showAnimations, "paused",   "fa-solid fa-pause",              "Pause animations",   applyPaused);

		// Toggle panel open/close
		toggle.addEventListener("click", function () {
			var isOpen = !panel.hidden;
			panel.hidden = isOpen;
			toggle.setAttribute("aria-expanded", isOpen ? "false" : "true");
			toggle.classList.toggle("active", !isOpen);
		});

		// Close on outside click
		doc.addEventListener("click", function (e) {
			if (!toolbar.contains(e.target) && !panel.hidden) {
				panel.hidden = true;
				toggle.setAttribute("aria-expanded", "false");
				toggle.classList.remove("active");
			}
		});

		// Apply saved preferences on load
		if (prefs.fontStep !== defaultStep) applyFontSize(prefs.fontStep);
		if (prefs.inverted) applyInversion(true);
		if (prefs.contrast) applyContrast(true);
		if (prefs.links)    applyLinks(true);
		if (prefs.font)     applyFont(true);
		if (prefs.paused)   applyPaused(true);

		toolbar.appendChild(toggle);
		toolbar.appendChild(panel);
		body.appendChild(toolbar);
	}

	// ========================================================================
	// TEMPLATE UTILITIES
	// ========================================================================

	/**
	 * Utility: smooth scroll to top
	 */
	function backToTop() {
		win.scrollTo({ top: 0, behavior: "smooth" });
	}

	/**
	 * Utility: toggle body class on scroll for sticky header styling
	 */
	function handleScroll() {
		if (win.scrollY > 50) {
			doc.body.classList.add("scrolled");
		} else {
			doc.body.classList.remove("scrolled");
		}
	}

	/**
	 * Initialize offcanvas drawer buttons for left/right drawers.
	 * Bootstrap handles drawers automatically via data-bs-toggle="offcanvas"
	 * This function is kept for backwards compatibility but only runs if drawers exist.
	 */
	function initDrawers() {
		// Check if any drawer buttons exist before initializing
		var hasDrawers = doc.querySelector(".drawer-toggle-left") || doc.querySelector(".drawer-toggle-right");
		if (!hasDrawers) {
			return; // No drawers, skip initialization
		}

		// Bootstrap 5 handles offcanvas automatically via data-bs-toggle attribute
		// No manual initialization needed if Bootstrap is loaded correctly
		// The buttons already have data-bs-toggle="offcanvas" and data-bs-target="#drawer-*"
	}

	/**
	 * Initialize back-to-top link if present
	 */
	function initBackTop() {
		var backTop = doc.getElementById("back-top");
		if (backTop) {
			backTop.addEventListener("click", function (e) {
				e.preventDefault();
				backToTop();
			});
		}
	}

	/**
	 * Initialize theme based on stored preference or system setting
	 */
	function initTheme() {
		var stored = getStored();
		var theme = stored ? stored : systemTheme();
		applyTheme(theme);

		// Listen for system changes only if Auto mode (no stored)
		var onChange = function () {
			if (!getStored()) {
				applyTheme(systemTheme());
			}
		};
		if (typeof mql.addEventListener === "function") {
			mql.addEventListener("change", onChange);
		} else if (typeof mql.addListener === "function") {
			mql.addListener(onChange);
		}

		// Hook toggle UI if present (for inline switch, not FAB)
		var switchEl = doc.getElementById("themeSwitch");
		var autoBtn = doc.getElementById("themeAuto");

		if (switchEl) {
			switchEl.checked = (theme === "dark");
			switchEl.addEventListener("change", function () {
				var choice = switchEl.checked ? "dark" : "light";
				applyTheme(choice);
			});
		}

		if (autoBtn) {
			autoBtn.addEventListener("click", function () {
				clearStored();
				applyTheme(systemTheme());
			});
		}
	}

	/**
	 * Check if theme FAB should be enabled based on body data attribute
	 */
	function shouldEnableThemeFab() {
		return doc.body.getAttribute('data-theme-fab-enabled') === '1';
	}

	/**
	 * Convert sidebar card modules into accordion on mobile.
	 * On screens <= 991px each card collapses; on desktop they revert.
	 */
	function initSidebarAccordion() {
		var BREAKPOINT = 992;
		var sidebars = doc.querySelectorAll(".container-sidebar-left, .container-sidebar-right");
		if (!sidebars.length) return;

		var accordionised = false;

		function apply() {
			var isMobile = win.innerWidth < BREAKPOINT;

			if (isMobile && !accordionised) {
				sidebars.forEach(function (sidebar, si) {
					var accId = "sidebarAcc-" + si;
					sidebar.setAttribute("id", accId);
					sidebar.classList.add("accordion");

					var cards = sidebar.querySelectorAll(":scope > .card");
					cards.forEach(function (card, ci) {
						var collapseId = accId + "-c" + ci;
						card.classList.add("accordion-item");

						var header = card.querySelector(".card-header");
						var body = card.querySelector(".card-body");
						if (!header || !body) return;

						// Turn header into accordion button
						header.classList.add("accordion-header");
						var btn = doc.createElement("button");
						btn.className = "accordion-button collapsed";
						btn.type = "button";
						btn.setAttribute("data-bs-toggle", "collapse");
						btn.setAttribute("data-bs-target", "#" + collapseId);
						btn.setAttribute("aria-expanded", "false");
						btn.setAttribute("aria-controls", collapseId);
						btn.textContent = header.textContent;
						header.textContent = "";
						header.appendChild(btn);
						header.setAttribute("data-moko-original-text", btn.textContent);

						// Wrap body in collapse
						var wrapper = doc.createElement("div");
						wrapper.id = collapseId;
						wrapper.className = "accordion-collapse collapse";
						wrapper.setAttribute("data-bs-parent", "#" + accId);
						card.insertBefore(wrapper, body);
						wrapper.appendChild(body);
						body.classList.add("accordion-body");
					});
				});
				accordionised = true;
			} else if (!isMobile && accordionised) {
				// Revert to plain cards
				sidebars.forEach(function (sidebar) {
					sidebar.classList.remove("accordion");
					sidebar.removeAttribute("id");

					var cards = sidebar.querySelectorAll(":scope > .card");
					cards.forEach(function (card) {
						card.classList.remove("accordion-item");

						var header = card.querySelector(".card-header");
						var btn = header ? header.querySelector(".accordion-button") : null;
						if (header && btn) {
							var text = header.getAttribute("data-moko-original-text") || btn.textContent;
							header.removeAttribute("data-moko-original-text");
							header.classList.remove("accordion-header");
							header.textContent = text;
						}

						var wrapper = card.querySelector(".accordion-collapse");
						if (wrapper) {
							var body = wrapper.querySelector(".card-body");
							if (body) {
								body.classList.remove("accordion-body");
								card.appendChild(body);
							}
							wrapper.parentNode.removeChild(wrapper);
						}
					});
				});
				accordionised = false;
			}
		}

		apply();
		win.addEventListener("resize", apply);
	}

	/**
	 * Run all template JS initializations
	 */
	function init() {
		// Initialize theme first
		initTheme();

		// Build floating theme toggle if enabled
		if (shouldEnableThemeFab()) {
			buildThemeToggle();
		}

		// Build accessibility toolbar if enabled
		if (doc.body.getAttribute("data-a11y-toolbar") === "1") {
			buildA11yToolbar();
		}

		// Sticky header behavior
		handleScroll();
		win.addEventListener("scroll", handleScroll);

		// Init features
		initDrawers();
		initBackTop();
		initSidebarAccordion();
	}

	if (doc.readyState === "loading") {
		doc.addEventListener("DOMContentLoaded", init);
	} else {
		init();
	}
})(window, document);
