<?php
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
 * Local plugin "Boost navigation fumbling" - Privacy provider
 *
 * @package    local_boostnavigation
 * @copyright  2018 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_boostnavigation\privacy;

use \core_privacy\local\request\writer;
use \core_privacy\local\metadata\collection;
use \core_privacy\local\request\transform;

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy Subsystem implementing provider.
 *
 * @package    local_boostnavigation
 * @copyright  2018 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements \core_privacy\local\metadata\provider,
        \core_privacy\local\request\user_preference_provider {

    /**
     * Returns meta data about this system.
     *
     * @param collection $collection The initialised item collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection) : collection {
        $collection->add_user_preference('local_boostnavigation-collapse_', 'privacy:metadata:preference:collapse');

        return $collection;
    }

    /**
     * Store all user preferences for the plugin.
     *
     * @param int $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        $preferences = get_user_preferences();
        foreach ($preferences as $name => $value) {
            $descriptionidentifier = null;
            $nodename = null;
            if (strpos($name, 'local_boostnavigation-collapse_') === 0) {
                $descriptionidentifier = 'privacy:request:preference:collapse';
                $nodename = substr($name, strlen('local_boostnavigation-collapse_'));
            }

            if ($descriptionidentifier !== null) {
                writer::export_user_preference(
                        'local_boostnavigation',
                        $name,
                        $value,
                        get_string($descriptionidentifier, 'local_boostnavigation', (object) [
                                'nodename' => $nodename,
                                'collapse' => $value,
                        ])
                );
            }
        }
    }
}
