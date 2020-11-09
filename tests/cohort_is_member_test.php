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
 * Local plugin "Boost navigation fumbling" - Cohort is member PHP unit tests.
 *
 * @package    local_boostnavigation
 * @copyright  2020 Anupama Dharmajan <anupamadharmajan@catalyst-au.net>
 *             on behalf of Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once(__DIR__ . '/../locallib.php');

global $CFG;

/**
 * Unit tests for cohort is member.
 *
 * @package    local_boostnavigation
 * @copyright  2020 Anupama Dharmajan <anupamadharmajan@catalyst-au.net>
 *             on behalf of Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_boostnavigation_test_cohort_is_member extends advanced_testcase {

    /**
     * Test user cohorts after cohort add member.
     */
    public function test_cohort_add_member() {
        // Initial reset.
        $this->resetAfterTest();

        // Create cohort and user.
        $cohort = $this->getDataGenerator()->create_cohort(array('idnumber' => '01'));
        $user = $this->getDataGenerator()->create_user();

        // Check user is not a member in cohort.
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertFalse($cohortismember);

        // Sleep 1 second.
        sleep(1);

        // Add user to cohort.
        cohort_add_member($cohort->id, $user->id);

        // Check user is a member in cohort (miss).
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertTrue($cohortismember);

        // Check again user is a member in cohort (hit).
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertTrue($cohortismember);
    }

    /**
     * Test user cohorts after cohort remove member.
     */
    public function test_cohort_remove_member() {
        // Initial reset.
        $this->resetAfterTest();

        // Create cohort and user.
        $cohort = $this->getDataGenerator()->create_cohort(array('idnumber' => '01'));
        $user = $this->getDataGenerator()->create_user();

        // Add user to cohort.
        cohort_add_member($cohort->id, $user->id);

        // Check user is a member in cohort.
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertTrue($cohortismember);

        // Sleep 1 second.
        sleep(1);

        // Remove user from cohort.
        cohort_remove_member($cohort->id, $user->id);

        // Check user is not a member in cohort (miss).
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertFalse($cohortismember);

        // Check user is not a member in cohort (hit).
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertFalse($cohortismember);
    }

    /**
     * Test user cohorts after cohort delete.
     */
    public function test_cohort_delete_cohort() {
        // Initial reset.
        $this->resetAfterTest();

        // Create cohort and user.
        $cohort = $this->getDataGenerator()->create_cohort(array('idnumber' => '01'));
        $user = $this->getDataGenerator()->create_user();

        // Add user to cohort.
        cohort_add_member($cohort->id, $user->id);

        // Check user is a member in cohort.
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertTrue($cohortismember);

        // Sleep 1 second.
        sleep(1);

        // Delete cohort.
        cohort_delete_cohort($cohort);

        // Check user is not a member in cohort (miss).
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertFalse($cohortismember);
    }

    /**
     * Test user cohorts after cohort update.
     */
    public function test_cohort_update_cohort() {
        // Initial reset.
        $this->resetAfterTest();

        // Create cohort and user.
        $cohort = $this->getDataGenerator()->create_cohort(array('idnumber' => '01'));
        $user = $this->getDataGenerator()->create_user();

        // Add user to cohort.
        cohort_add_member($cohort->id, $user->id);

        // Check user is a member in cohort.
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertTrue($cohortismember);

        // Sleep 1 second.
        sleep(1);

        // Update cohort idnumber to 02.
        $cohortupdate = (object) array('id' => $cohort->id, 'idnumber' => 02, 'contextid' => $cohort->contextid);
        cohort_update_cohort($cohortupdate);

        // Check user is not a member in cohort with idnumber 01 (miss).
        $cohortismember = local_boostnavigation_cohort_is_member($user->id, $cohort->idnumber);
        $this->assertFalse($cohortismember);
    }
}
