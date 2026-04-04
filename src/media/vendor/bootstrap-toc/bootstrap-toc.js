/*!
 * Bootstrap Table of Contents v1.0.1 (https://afeld.github.io/bootstrap-toc/)
 * Copyright 2015 Aidan Feldman
 * Licensed under MIT (https://github.com/afeld/bootstrap-toc/blob/gh-pages/LICENSE.md)
 */
(function($) {
  'use strict';

  window.Toc = {
    helpers: {
      // return all matching elements in the set, or their descendants
      findOrFilter: function($el, selector) {
        // http://danielnouri.org/notes/2011/03/14/a-jquery-find-that-also-finds-the-root-element/
        // http://stackoverflow.com/a/12731439/358804
        var $descendants = $el.find(selector);
        return $el.filter(selector).add($descendants).filter(':not([data-toc-skip])');
      },

      generateUniqueIdBase: function(el) {
        var text = $(el).text();

        // adapted from
        // https://github.com/bryanbraun/anchorjs/blob/5a7f01cbd56f8aa8413084a64e7d1cbb1d4b0e56/anchor.js#L237-L257
        // and
        // https://github.com/twbs/bootstrap/blob/b8a84c3e48ce62e5d1954c52d3796b3fcbeab8a9/site/docs/4.1/assets/js/src/application.js#L47-L53
        // Remove punctuation and spaces
        var base = text
          .toLowerCase()
          .replace(/[^\w\s-]/g, '')
          .replace(/[\s]+/g, '-');

        return base || el.tagName.toLowerCase();
      },

      generateUniqueId: function(el) {
        var anchorBase = this.generateUniqueIdBase(el);
        for (var i = 0; ; i++) {
          var anchor = anchorBase;
          if (i > 0) {
            // add suffix
            anchor += '-' + i;
          }
          // check if ID already exists
          if (!document.getElementById(anchor)) {
            return anchor;
          }
        }
      },

      generateAnchor: function(el) {
        if (el.id) {
          return el.id;
        } else {
          var anchor = this.generateUniqueId(el);
          el.id = anchor;
          return anchor;
        }
      },

      createNavList: function() {
        return $('<ul class="nav"></ul>');
      },

      createChildNavList: function($parent) {
        var $childList = this.createNavList();
        $parent.append($childList);
        return $childList;
      },

      generateNavEl: function(anchor, text) {
        var $a = $('<a class="nav-link"></a>');
        $a.attr('href', '#' + anchor);
        $a.text(text);
        var $li = $('<li class="nav-item"></li>');
        $li.append($a);
        return $li;
      },

      generateNavItem: function(headingEl) {
        var anchor = this.generateAnchor(headingEl);
        var $heading = $(headingEl);
        var text = $heading.data('toc-text') || $heading.text();
        return this.generateNavEl(anchor, text);
      },

      // Find the highest (lowest-numbered) heading level present in the scope.
      // Returns the tag number of the first heading found (e.g. 2 for <h2>).
      getTopLevel: function($scope) {
        for (var i = 1; i <= 6; i++) {
          var $headings = this.findOrFilter($scope, 'h' + i);
          if ($headings.length >= 1) {
            return i;
          }
        }

        return 1;
      },

      // Returns elements for the top level and up to two levels below it.
      // e.g. if topLevel is 2 → h2, h3, h4
      getHeadings: function($scope, topLevel) {
        var selectors = [];
        for (var i = topLevel; i <= Math.min(topLevel + 2, 6); i++) {
          selectors.push('h' + i);
        }

        return this.findOrFilter($scope, selectors.join(','));
      },

      getNavLevel: function(el) {
        return parseInt(el.tagName.charAt(1), 10);
      },

      populateNav: function($topContext, topLevel, $headings) {
        var $contexts = {};
        $contexts[topLevel] = $topContext;
        var $prevNavByLevel = {};

        var helpers = this;
        $headings.each(function(i, el) {
          var $newNav = helpers.generateNavItem(el);
          var navLevel = helpers.getNavLevel(el);

          if (navLevel === topLevel) {
            // Top level — append directly
            $topContext.append($newNav);
            $prevNavByLevel = {};
            $prevNavByLevel[topLevel] = $newNav;
            // Reset deeper contexts so next child creates a fresh sublist
            $contexts = {};
            $contexts[topLevel] = $topContext;
          } else {
            // Child level — ensure parent context exists
            var parentLevel = navLevel - 1;
            if (!$contexts[navLevel] && $prevNavByLevel[parentLevel]) {
              $contexts[navLevel] = helpers.createChildNavList($prevNavByLevel[parentLevel]);
            }
            var $ctx = $contexts[navLevel] || $topContext;
            $ctx.append($newNav);
            $prevNavByLevel[navLevel] = $newNav;
            // Reset deeper contexts
            for (var l = navLevel + 1; l <= 6; l++) {
              delete $contexts[l];
              delete $prevNavByLevel[l];
            }
          }
        });
      },

      parseOps: function(arg) {
        var opts;
        if (arg.jquery) {
          opts = {
            $nav: arg
          };
        } else {
          opts = arg;
        }
        opts.$scope = opts.$scope || $(document.body);
        return opts;
      }
    },

    // accepts a jQuery object, or an options object
    init: function(opts) {
      opts = this.helpers.parseOps(opts);

      // ensure that the data attribute is in place for styling
      opts.$nav.attr('data-toggle', 'toc');

      var $topContext = this.helpers.createChildNavList(opts.$nav);
      var topLevel = this.helpers.getTopLevel(opts.$scope);
      var $headings = this.helpers.getHeadings(opts.$scope, topLevel);
      this.helpers.populateNav($topContext, topLevel, $headings);
    }
  };

  $(function() {
    $('nav[data-toggle="toc"]').each(function(i, el) {
      var $nav = $(el);
      var $scope = $('[data-toc-scope]');
      Toc.init({ $nav: $nav, $scope: $scope.length ? $scope : $(document.body) });
    });
  });
})(jQuery);
