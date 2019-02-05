// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local plugin "Boost navigation fumbling" - JS code for collapsing nav drawer nodes
 *
 * @package    local_boostnavigation
 * @copyright  2017 Kathrin Osswald, Ulm University <kathrin.osswald@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery'], function($) {
    "use strict";

    /**
     * Click handler to toggle the given nav node.
     * @param {Object} node The nav node which should be toggled.
     * @param {string} nodename The nav node's nodename.
     */
    function toggleClickHandler(node, nodename) {
        node.click(function(e) {
            // Prevent that the browser opens the node's default action link (if existing).
            e.preventDefault();

            // If the parent node is currently expanded.
            if (node.attr('data-collapse') == 0) {
                // Set the hidden attribute to true for all elements which have the nodename as their data-parent-key attribute.
                $('.list-group-item[data-parent-key=' + nodename + ']').attr("data-hidden", "1");
                // Change the collapse attribute of the node itself to true.
                node.attr("data-collapse", "1");
                // Change the aria-expanded attribute of the node itself to false.
                node.attr("aria-expanded", "0");
                // Save this state to the user preferences.
                M.util.set_user_preference('local_boostnavigation-collapse_' + nodename + 'node', 1);

                // If the parent node is currently collapsed.
            } else if (node.attr('data-collapse') == 1) {
                // Set the hidden attribute to false for all elements which have the nodename as their data-parent-key attribute.
                $('.list-group-item[data-parent-key=' + nodename + ']').attr("data-hidden", "0");
                // Change the collapse attribute of the node itself to false.
                node.attr("data-collapse", "0");
                // Change the aria-expanded attribute of the node itself to true.
                node.attr("aria-expanded", "1");
                // Save this state to the user preferences.
                M.util.set_user_preference('local_boostnavigation-collapse_' + nodename + 'node', 0);
            }
        });
    }

    /**
     * Add aria-attributes to a parent node.
     * @param {Object} node The nav node which should get the aria-attributes.
     * @param {string} nodename The nav node's nodename.
     */
    function addAriaToParent(node, nodename) {
        // Add ids to the child nodes for referencing in aria-controls.
        // Initialize string variable to remember the child node ids.
        var ids = '';
        // Get the elements which have the nodename as their data-parent-key attribute.
        $('.list-group-item[data-parent-key=' + nodename + ']').each(function(index, element) {
            // Get its data-key attribute (which should be unique) to be used as id attribute.
            var id = $(element).attr('data-key');
            // Prefix the id attribute if it wasn't built by us (or by our companion plugin local_boostcoc).
            if (!id.startsWith('localboost')) {
                id = 'localboostnavigation' + id;
            }
            // Set the id attribute.
            $(element).attr('id', id);
            // Remember the id attribute for later use.
            ids = ids + id + ' ';
        });

        // Add aria-controls attribute if we have ids to reference.
        if (ids !== '') {
            node.attr('aria-controls', ids.trim());
        }

        // Add aria-expanded attribute.
        // If the parent node is currently expanded.
        if (node.attr('data-collapse') == 0) {
            // Set the aria-expanded attribute of the node itself to false.
            node.attr('aria-expanded', '1');

            // If the parent node is currently collapsed.
        } else if (node.attr('data-collapse') == 1) {
            // Set the aria-expanded attribute of the node itself to true.
            node.attr('aria-expanded', '0');
        }
    }

    /**
     * Add accessibility to a div node which doesn't behave like an a node.
     * @param {Object} node The nav node which should be made tabbable.
     */
    function tabbableDiv(node) {
        // Add tabindex attribute so that it will be respected by the browser when the user tabs through the page's elements.
        node.attr('tabindex', '0');

        // Also call the click handler when the user presses the Enter button.
        node.keydown(function(e) {
            if (e.which === 13) {
                e.currentTarget.click();
            }
        });

        // As we added a tabindex attribute, the element gets an element focus outline as soon as it's clicked, too.
        // Try to prevent this hereby.
        node.mousedown(function() {
            node.css('outline', 'none');
        });
        node.mouseup(function() {
            node.css('outline', '');
            node.blur();
        });
    }

    /**
     * Init function of this AMD module which initializes the click handlers.
     * @param {string} nodename The nav node's nodename.
     */
    function initToggleNodes(nodename) {
        // Search node to be collapsible.
        var node = $('.list-group-item[data-key="' + nodename + '"]');

        // Add a click handler to this node.
        toggleClickHandler(node, nodename);

        // Add aria-attributes to this node.
        addAriaToParent(node, nodename);

        // Make the mycourses node accessible (all other nodes are fine).
        if (nodename == 'mycourses') {
            tabbableDiv(node);
        }
    }

    return {
        init: function(params) {
            for (var i = 0, len = params.length; i < len; i++) {
                initToggleNodes(params[i]);
            }
        }
    };
});
