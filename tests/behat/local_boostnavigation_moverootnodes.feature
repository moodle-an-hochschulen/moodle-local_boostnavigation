@local @local_boostnavigation @local_boostnavigation_moverootnodes
Feature: The boost navigation fumbling allows admins to move root nodes in the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to move root nodes in the nav drawer

  Background:
    Given the following "users" exist:
      | username |
      | student1 |

  Scenario: Move root node "Content bank" in course context
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
      | config                          | value  | plugin                |
      | movecontentbankcoursenode       | 1      | local_boostnavigation |
      | movecontentbankcoursenodebefore | grades | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should see "Content bank" in the "#nav-drawer .list-group[aria-label='C1']" "css_element"
    And I should not see "Content bank" in the "#nav-drawer .list-group[aria-label='Site']" "css_element"
    And "a[data-key='contentbank']" "css_element" should appear after "a[data-key='competencies']" "css_element"
    And "a[data-key='contentbank']" "css_element" should appear before "a[data-key='grades']" "css_element"
    And the following config values are set as admin:
      | config                          | value      | plugin                |
      | movecontentbankcoursenodebefore | badgesview | local_boostnavigation |
    And I reload the page
    Then I should see "Content bank" in the "#nav-drawer .list-group[aria-label='C1']" "css_element"
    And I should not see "Content bank" in the "#nav-drawer .list-group[aria-label='Site']" "css_element"
    And "a[data-key='contentbank']" "css_element" should appear after "a[data-key='participants']" "css_element"
    And "a[data-key='contentbank']" "css_element" should appear before "a[data-key='badgesview']" "css_element"
    And the following config values are set as admin:
      | config                          | value        | plugin                |
      | movecontentbankcoursenodebefore | competencies | local_boostnavigation |
    And I reload the page
    Then I should see "Content bank" in the "#nav-drawer .list-group[aria-label='C1']" "css_element"
    And I should not see "Content bank" in the "#nav-drawer .list-group[aria-label='Site']" "css_element"
    And "a[data-key='contentbank']" "css_element" should appear after "a[data-key='badgesview']" "css_element"
    And "a[data-key='contentbank']" "css_element" should appear before "a[data-key='competencies']" "css_element"
