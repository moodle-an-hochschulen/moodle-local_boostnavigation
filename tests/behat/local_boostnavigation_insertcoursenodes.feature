@local @local_boostnavigation @local_boostnavigation_insertcoursenodes
Feature: The boost navigation fumbling allows admins to insert course nodes to the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to insert course nodes to the nav drawer

  Background:
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |

  Scenario: Insert course node "Sections" (linkcoursesections globally disabled)
    Given the following config values are set as admin:
      | config                         | value |
      | linkcoursesections             | 0     |
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertcoursesectionscoursenode | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I add a "Page" to section "2" and I fill the form with:
      | Name         | Page 2 |
      | Description  | Test   |
      | Page content | Test   |
    And I add a "Page" to section "3" and I fill the form with:
      | Name         | Page 3 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    Then I should not see "Sections" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertcoursesectionscoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Sections" in the "#nav-drawer" "css_element"

  Scenario: Insert course node "Sections" (linkcoursesections globally enabled)
    Given the following config values are set as admin:
      | config                         | value |
      | linkcoursesections             | 1     |
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertcoursesectionscoursenode | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I add a "Page" to section "2" and I fill the form with:
      | Name         | Page 2 |
      | Description  | Test   |
      | Page content | Test   |
    And I add a "Page" to section "3" and I fill the form with:
      | Name         | Page 3 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    Then I should not see "Sections" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertcoursesectionscoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcoursesections']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationcoursesections']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should contain "/course/view.php?id="
    And I click on "Sections" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"

  Scenario: Insert course node "Activities" but not "Resources" (No activities and no resources exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    And I reload the page
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"

  Scenario: Insert course node "Activities" but not "Resources" (Some activities but no resources exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I should see "Forums" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivityassign']" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "/course/view.php?id="
    And I click on "Activities" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"
    And I click on "Assignments" "link" in the "#nav-drawer" "css_element"
    And "Assignments" "text" should exist in the ".breadcrumb" "css_element"
    And I am on "Course 1" course homepage
    And I click on "Forums" "link" in the "#nav-drawer" "css_element"
    And "Forums" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Insert course node "Activities" but not "Resources" (Some resources but no activities exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "/course/view.php?id="
    And I click on "Activities" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"
    And I click on "Resources" "link" in the "#nav-drawer" "css_element"
    And "Resources" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Insert course node "Activities" but not "Resources" (Some resources and activities exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I should see "Forums" in the "#nav-drawer" "css_element"
    And I should see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivityassign']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear after "a[data-key='localboostnavigationactivityassign']" "css_element"
    And "a[data-key='localboostnavigationactivityresources']" "css_element" should appear after "a[data-key='localboostnavigationactivityassign']" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "/course/view.php?id="
    And I click on "Activities" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"
    And I click on "Assignments" "link" in the "#nav-drawer" "css_element"
    And "Assignments" "text" should exist in the ".breadcrumb" "css_element"
    And I am on "Course 1" course homepage
    And I click on "Forums" "link" in the "#nav-drawer" "css_element"
    And "Forums" "text" should exist in the ".breadcrumb" "css_element"
    And I am on "Course 1" course homepage
    And I click on "Resources" "link" in the "#nav-drawer" "css_element"
    And "Resources" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Insert course node "Resources" but not "Activities" (No activities and no resources exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"

  Scenario: Insert course node "Resources" but not "Activities" (Some activities but no resources exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"

  Scenario: Insert course node "Resources" but not "Activities" (Some resources but no activities exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And I click on "Resources" "link" in the "#nav-drawer" "css_element"
    And "Resources" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Insert course node "Resources" but not "Activities" (Some resources and activities exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And I click on "Resources" "link" in the "#nav-drawer" "css_element"
    And "Resources" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Insert course node "Activities" and "Resources" (No activities and no resources exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"

  Scenario: Insert course node "Activities" and "Resources" (Some activities but no resources exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I should see "Forums" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivityassign']" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "/course/view.php?id="
    And I click on "Activities" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"
    And I click on "Assignments" "link" in the "#nav-drawer" "css_element"
    And "Assignments" "text" should exist in the ".breadcrumb" "css_element"
    And I am on "Course 1" course homepage
    And I click on "Forums" "link" in the "#nav-drawer" "css_element"
    And "Forums" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Insert course node "Activities" and "Resources" (Some resources but no activities exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And I click on "Resources" "link" in the "#nav-drawer" "css_element"
    And "Resources" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Insert course node "Activities" and "Resources" (Some resources and activities exist in the course)
    Given the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 0     | local_boostnavigation |
      | insertresourcescoursenode      | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I turn editing mode off
    Then I should not see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Resources" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | insertactivitiescoursenode     | 1     | local_boostnavigation |
      | insertresourcescoursenode      | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I should see "Forums" in the "#nav-drawer" "css_element"
    And I should see "Resources" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationresources']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivities']" "css_element" should appear after "a[data-key='localboostnavigationresources']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='localboostnavigationresources']" "css_element"
    And "a[data-key='localboostnavigationactivityassign']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationresources']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivities']" "css_element"
    And "a[data-key='localboostnavigationactivityforum']" "css_element" should appear after "a[data-key='localboostnavigationactivityassign']" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "/course/view.php?id="
    And I click on "Activities" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"
    And I click on "Resources" "link" in the "#nav-drawer" "css_element"
    And "Resources" "text" should exist in the ".breadcrumb" "css_element"
    And I am on "Course 1" course homepage
    And I click on "Assignments" "link" in the "#nav-drawer" "css_element"
    And "Assignments" "text" should exist in the ".breadcrumb" "css_element"
    And I am on "Course 1" course homepage
    And I click on "Forums" "link" in the "#nav-drawer" "css_element"
    And "Forums" "text" should exist in the ".breadcrumb" "css_element"

  Scenario: Use indeividual activity icons
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | insertactivitiescoursenoderealicons | 0     | local_boostnavigation |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I add a "Forum" to section "1" and I fill the form with:
      | Forum name  | Test forum name                |
      | Forum type  | Standard forum for general use |
      | Description | Test forum description         |
    And I turn editing mode off
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I should see "Forums" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivityforum'] i.icon" "css_element" should contain "fa-share-alt"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenoderealicons | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I should see "Forums" in the "#nav-drawer" "css_element"
    And the "src" attribute of "a[data-key='localboostnavigationactivityassign'] img.icon" "css_element" should contain "boost/assign"
    And the "src" attribute of "a[data-key='localboostnavigationactivityforum'] img.icon" "css_element" should contain "boost/forum"
