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
 * @module     local_boostnavigation/collapsenavdrawernodes
 * @copyright  2017 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
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
            if (node.hasClass('localboostnavigationcollapsedparent') === false) {
                // Collapse the node.
                collapseNode(node, nodename);

                // If the parent node is currently collapsed.
            } else if (node.hasClass('localboostnavigationcollapsedparent') === true) {
                // Expand the node.
                expandNode(node, nodename);

                // If the parent node is configured to act as accordion.
                var accordionTarget = node.attr('data-localboostnavigation-accordion');
                if (typeof accordionTarget !== "undefined") {
                    // Collapse all sibling parent nodes.
                    $('.list-group-item.localboostnavigationcollapsibleparent[data-key^="' + accordionTarget + '"]')
                            .each(/* @this */function() {
                        // But not the node which has been clicked by the user.
                        if ($(this).attr('data-key') !== node.attr('data-key')) {
                            collapseNode($(this), $(this).attr('data-key'));
                        }
                    });
                }
            }
        });
    }

    /**
     * Helper function to collapse the given nav node.
     * @param {Object} node The nav node which should be toggled.
     * @param {string} nodename The nav node's nodename.
     */
    function collapseNode(node, nodename) {
        // Set the localboostnavigationcollapsedchild class for all elements which have the nodename as their data-parent-key
        // attribute.
        $('.list-group-item[data-parent-key=' + nodename + ']').addClass('localboostnavigationcollapsedchild');
        // Set the localboostnavigationcollapsedparent class of the node itself.
        node.addClass('localboostnavigationcollapsedparent');
        // Change the aria-expanded attribute of the node itself to false.
        node.attr("aria-expanded", "0");
        // Save this state to the user preferences.
        M.util.set_user_preference('local_boostnavigation-collapse_' + nodename + 'node', 1);
     }

    /**
     * Helper function to expand the given nav node.
     * @param {Object} node The nav node which should be toggled.
     * @param {string} nodename The nav node's nodename.
     */
    function expandNode(node, nodename) {
        // Remove the localboostnavigationcollapsedchild class from all elements which have the nodename as their data-parent-key
        // attribute.
        $('.list-group-item[data-parent-key=' + nodename + ']').removeClass('localboostnavigationcollapsedchild');
        // Remove the localboostnavigationcollapsedparent class of the node itself.
        node.removeClass('localboostnavigationcollapsedparent');
        // Change the aria-expanded attribute of the node itself to true.
        node.attr("aria-expanded", "1");
        // Save this state to the user preferences.
        M.util.set_user_preference('local_boostnavigation-collapse_' + nodename + 'node', 0);
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
            // Prefix the id attribute if it wasn't built by us.
            if (id.substring(0, 10) !== 'localboost') {
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
        if (node.hasClass('localboostnavigationcollapsedparent') === false) {
            // Set the aria-expanded attribute of the node itself to false.
            node.attr('aria-expanded', '1');

            // If the parent node is currently collapsed.
        } else if (node.hasClass('localboostnavigationcollapsedparent') === true) {
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

    /**
     * Init function of this AMD module which marks the accordion nodes.
     * @param {string} nodename The nav node's nodename.
     */
    function initAccordionNodes(nodename) {
        // Mark node as accordion.
        $('.list-group-item.localboostnavigationcollapsibleparent[data-key^="' + nodename + '"]')
                .attr('data-localboostnavigation-accordion', nodename);
    }

    return {
        init: function(toggleNodes, accordionNodes) {
            // Initialize toggle nodes.
            for (var i = 0, tLen = toggleNodes.length; i < tLen; i++) {
                initToggleNodes(toggleNodes[i]);
            }
            // Initialize accordion nodes.
            for (var j = 0, aLen = accordionNodes.length; j < aLen; j++) {
                initAccordionNodes(accordionNodes[j]);
            }
        }
    };
});
