@local @local_boostnavigation @local_boostnavigation_removerootnodes
Feature: The boost navigation fumbling allows admins to remove root nodes from the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to remove root nodes from the nav drawer

  Background:
    Given the following "users" exist:
      | username |
      | student1 |

  Scenario: Remove root node "Dashboard"
    Given the following config values are set as admin:
      | config                 | value | plugin                |
      | removemyhomenode       | 0     | local_boostnavigation |
    When I log in as "student1"
    Then I should see "Dashboard" in the "#nav-drawer" "css_element"
    # The following steps will detect a PHP notice and will therefore fail.
    # They are disabled until https://github.com/moodleuulm/moodle-local_boostnavigation/issues/40 is fixed.
    # And the following config values are set as admin:
    #   | config                 | value | plugin                |
    #   | removemyhomenode       | 1     | local_boostnavigation |
    # And I reload the page
    # Then I should not see "Dashboard" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "Home"
    Given the following config values are set as admin:
      | config                 | value | plugin                |
      | removehomenode         | 0     | local_boostnavigation |
    When I log in as "student1"
    Then I should see "Site home" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                 | value | plugin                |
      | removehomenode         | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Site home" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "Calendar"
    Given the following config values are set as admin:
      | config                 | value | plugin                |
      | removecalendarnode     | 0     | local_boostnavigation |
    When I log in as "student1"
    Then I should see "Calendar" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                 | value | plugin                |
      | removecalendarnode     | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Calendar" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "Private files"
    Given the following config values are set as admin:
      | config                 | value | plugin                |
      | removeprivatefilesnode | 0     | local_boostnavigation |
    When I log in as "student1"
    Then I should see "Private files" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                 | value | plugin                |
      | removeprivatefilesnode | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Private files" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "Content bank" neither in course context nor in non-course context
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | removecontentbankcoursenode    | 0     | local_boostnavigation |
      | removecontentbanknoncoursenode | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should see "Content bank" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I follow "Dashboard" in the user menu
    Then I should see "Content bank" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "Content bank" in course context but not in non-course context
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | removecontentbankcoursenode    | 1     | local_boostnavigation |
      | removecontentbanknoncoursenode | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should not see "Content bank" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I follow "Dashboard" in the user menu
    Then I should see "Content bank" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "Content bank" in non-course context but not in course context
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | removecontentbankcoursenode    | 0     | local_boostnavigation |
      | removecontentbanknoncoursenode | 1     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should see "Content bank" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I follow "Dashboard" in the user menu
    Then I should not see "Content bank" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "Content bank" in course context and in non-course context
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | removecontentbankcoursenode    | 1     | local_boostnavigation |
      | removecontentbanknoncoursenode | 1     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should not see "Content bank" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I follow "Dashboard" in the user menu
    Then I should not see "Content bank" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "My courses" (navshowmycoursecategories globally disabled)
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | student1 | C1     | student |
    And the following config values are set as admin:
      | config                    | value |
      | navshowmycoursecategories | 0     |
    And the following config values are set as admin:
      | config                 | value | plugin                |
      | removemycoursesnode    | 0     | local_boostnavigation |
    When I log in as "student1"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                 | value | plugin                |
      | removemycoursesnode    | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "Course 1" in the "#nav-drawer" "css_element"

  Scenario: Remove root node "My courses" (navshowmycoursecategories globally enabled)
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | student1 | C1     | student |
    And the following config values are set as admin:
      | config                    | value |
      | navshowmycoursecategories | 1     |
    And the following config values are set as admin:
      | config                 | value | plugin                |
      | removemycoursesnode    | 0     | local_boostnavigation |
    When I log in as "student1"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                 | value | plugin                |
      | removemycoursesnode    | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "Course 1" in the "#nav-drawer" "css_element"
