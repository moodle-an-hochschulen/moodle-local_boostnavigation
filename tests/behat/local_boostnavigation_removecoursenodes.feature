@local @local_boostnavigation @local_boostnavigation_removecoursenodes
Feature: The boost navigation fumbling allows admins to remove course nodes from the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to remove course nodes from the nav drawer

  Background:
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | student1 | C1     | student |

  Scenario: Remove course node "Badges" (Badges disabled globally)
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                       | value |
      | enablebadges                 | 0     |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removebadgescoursenode       | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should not see "Badges" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removebadgescoursenode       | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Badges" in the "#nav-drawer" "css_element"

  Scenario: Remove course node "Badges" (Badges enabled globally but no badge in course)
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                       | value |
      | enablebadges                 | 1     |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removebadgescoursenode       | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should see "Badges" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removebadgescoursenode       | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Badges" in the "#nav-drawer" "css_element"

  @_file_upload @javascript
  Scenario: Remove course node "Badges" (Badges enabled globally and one badge in course)
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                       | value |
      | enablebadges                 | 1     |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removebadgescoursenode       | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I navigate to "Badges > Add a new badge" in current page administration
    And I follow "Add a new badge"
    And I set the following fields to these values:
      | Name        | Course Badge 1             |
      | Description | Course badge 1 description |
    And I upload "badges/tests/behat/badge.png" file to "Image" filemanager
    And I press "Create badge"
    And I am on "Course 1" course homepage
    Then I should see "Badges" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removebadgescoursenode       | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Badges" in the "#nav-drawer" "css_element"

  @javascript
  Scenario: Remove course node "Competencies" (Competencies globally disabled)
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | enabled                      | 0     | core_competency       |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removecompetenciescoursenode | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should not see "Competencies" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removecompetenciescoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Competencies" in the "#nav-drawer" "css_element"
    And I click on ".context-header-settings-menu [role=button]" "css_element"
    And I should not see "Competencies" in the ".moodle-actionmenu" "css_element"

  @javascript
  Scenario: Remove course node "Competencies" (Competencies globally enabled but no competency in course)
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | enabled                      | 1     | core_competency       |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removecompetenciescoursenode | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should see "Competencies" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removecompetenciescoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Competencies" in the "#nav-drawer" "css_element"
    And I click on ".context-header-settings-menu [role=button]" "css_element"
    And I choose "Competencies" in the open action menu
    And I should see "Course competencies"

  @javascript
  Scenario: Remove course node "Competencies" (Competencies globally enabled and one competency in course)
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | enabled                      | 1     | core_competency       |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removecompetenciescoursenode | 0     | local_boostnavigation |
    And the following lp "frameworks" exist:
      | shortname | idnumber |
      | Test-Framework | ID-FW1 |
    And the following lp "competencies" exist:
      | shortname | framework |
      | Test-Comp1 | ID-FW1 |
      | Test-Comp2 | ID-FW1 |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I follow "Competencies"
    And I press "Add competencies to course"
    And "Competency picker" "dialogue" should be visible
    And I select "Test-Comp1" of the competency tree
    And I click on "Add" "button" in the "Competency picker" "dialogue"
    And I am on "Course 1" course homepage
    Then I should see "Competencies" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removecompetenciescoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Competencies" in the "#nav-drawer" "css_element"
    And I click on ".context-header-settings-menu [role=button]" "css_element"
    And I choose "Competencies" in the open action menu
    And I should see "Course competencies"

  Scenario: Remove course node "Grades"
    Given the following config values are set as admin:
      | config                       | value | plugin                |
      | removegradescoursenode       | 0     | local_boostnavigation |
    When I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Grades" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removegradescoursenode       | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Grades" in the "#nav-drawer" "css_element"

  Scenario: Remove course node "Participants"
    Given the following config values are set as admin:
      | config                       | value | plugin                |
      | removeparticipantscoursenode | 0     | local_boostnavigation |
    When I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Participants" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removeparticipantscoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Participants" in the "#nav-drawer" "css_element"

  Scenario: User logs are still usable after the course node "Participants" is removed
    Given the following "users" exist:
      | username | firstname | lastname |
      | teacher1 | Teacher   | 1        |
      | student2 | Student   | 2        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | student2 | C1     | student        |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I navigate to course participants
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | removeparticipantscoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Participants" in the "#nav-drawer" "css_element"
    And I follow "Student 2"
    And I follow "All logs"
    Then I should see "Select log reader"
