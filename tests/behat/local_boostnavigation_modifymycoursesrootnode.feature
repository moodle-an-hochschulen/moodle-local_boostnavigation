@local @local_boostnavigation @local_boostnavigation_modifymycoursesrootnode @javascript
Feature: The boost navigation fumbling allows admins to modify the mycourses root node in the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to modify the mycourses root node in the nav drawer

  Background:
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname         | shortname | category | startdate                   | enddate                    |
      | C1 - Past        | C1        | 0        | ##1 month ago##             | ##15 days ago##            |
      | C2 - In Progress | C2        | 0        | ##yesterday##               | ##tomorrow##               |
      | C3 - Future      | C3        | 0        | ##first day of next month## | ##last day of next month## |
    And the following "course enrolments" exist:
      | user      | course | role    |
      | student1  | C1     | student |
      | student1  | C2     | student |
      | student1  | C3     | student |

  Scenario: Don't show filtered courses if modifymycoursesrootnodeshowfiltered is disabled (i.e. Moodle core behaviour remains untouched)
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 0     | local_boostnavigation |
    When I log in as "student1"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    And I click on "In progress" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"
    And I click on "In progress" "button" in the "Course overview" "block"
    And I click on "Future" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"
    And I click on "Future" "button" in the "Course overview" "block"
    And I click on "Past" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"

  Scenario: Don't show filtered courses if navshowmycoursecategories is globally enabled (i.e. setting modifymycoursesrootnodeshowfiltered is ignored)
    Given the following config values are set as admin:
      | config                    | value |
      | navshowmycoursecategories | 1     |
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
    When I log in as "student1"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    And I click on "In progress" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"
    And I click on "In progress" "button" in the "Course overview" "block"
    And I click on "Future" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"
    And I click on "Future" "button" in the "Course overview" "block"
    And I click on "Past" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"

  Scenario: Show filtered courses, based on course progress (navshowmycoursecategories globally disabled)
    Given the following config values are set as admin:
      | config                    | value |
      | navshowmycoursecategories | 0     |
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
    When I log in as "student1"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    And I click on "In progress" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"
    And I click on "In progress" "button" in the "Course overview" "block"
    And I click on "Future" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should not see "C2" in the "#nav-drawer" "css_element"
    And I should see "C3" in the "#nav-drawer" "css_element"
    And I click on "Future" "button" in the "Course overview" "block"
    And I click on "Past" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And I should not see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"

  Scenario: Show filtered courses, based on starred courses (navshowmycoursecategories globally disabled)
    Given the following config values are set as admin:
      | config                    | value |
      | navshowmycoursecategories | 0     |
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
    When I log in as "student1"
    # This is added to overcome a problem with Chrome 88 temporarily - See https://bugs.chromium.org/p/chromedriver/issues/detail?id=3682
    And I change window size to "small"
    And I click on ".coursemenubtn" "css_element" in the "//div[@class='card dashboard-card' and contains(.,'C1')]" "xpath_element"
    And I click on "Star this course" "link" in the "//div[@class='card dashboard-card' and contains(.,'C1')]" "xpath_element"
    And I click on ".coursemenubtn" "css_element" in the "//div[@class='card dashboard-card' and contains(.,'C3')]" "xpath_element"
    And I click on "Star this course" "link" in the "//div[@class='card dashboard-card' and contains(.,'C3')]" "xpath_element"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    And I click on "Starred" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And I should not see "C2" in the "#nav-drawer" "css_element"
    And I should see "C3" in the "#nav-drawer" "css_element"

  Scenario: Show filtered courses, based on custom course fields (navshowmycoursecategories globally disabled)
    Given the following config values are set as admin:
      | config                    | value |
      | navshowmycoursecategories | 0     |
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
    And the following "custom field categories" exist:
      | name          | component   | area   | itemid |
      | Course fields | core_course | course | 0      |
    And the following "custom fields" exist:
      | name         | category      | type   | shortname   | configdata                       |
      | Select field | Course fields | select | selectfield | {"options":"Option 1\nOption 2"} |
    And the following "courses" exist:
      | fullname | shortname | category | customfield_selectfield |
      | Course 4 | C4        | 0        | 1                       |
      | Course 5 | C5        | 0        | 2                       |
    And the following "course enrolments" exist:
      | user      | course | role    |
      | student1  | C4     | student |
      | student1  | C5     | student |
    And the following config values are set as admin:
      | displaygroupingcustomfield | 1           | block_myoverview |
      | customfiltergrouping       | selectfield | block_myoverview |
    When I log in as "student1"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    When I click on "Option 1" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should not see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"
    And I should see "C4" in the "#nav-drawer" "css_element"
    And I should not see "C5" in the "#nav-drawer" "css_element"
    And I click on "Option 1" "button" in the "Course overview" "block"
    When I click on "Option 2" "link" in the "Course overview" "block"
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should not see "C2" in the "#nav-drawer" "css_element"
    And I should not see "C3" in the "#nav-drawer" "css_element"
    And I should not see "C4" in the "#nav-drawer" "css_element"
    And I should see "C5" in the "#nav-drawer" "css_element"

  Scenario: Add course filter hint node with standard filters (when modifymycoursesrootnodeshowfiltered is enabled)
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
      | modifymycoursesrootnodefilterhint   | 1     | local_boostnavigation |
    When I log in as "student1"
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: All (except removed from view)" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    And I click on "In progress" "link" in the "Course overview" "block"
    And I reload the page
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: In progress" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "In progress" "button" in the "Course overview" "block"
    And I click on "Past" "link" in the "Course overview" "block"
    And I reload the page
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: Past" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"

  Scenario: Add course filter hint node with custom field filter (when modifymycoursesrootnodeshowfiltered is enabled)
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
      | modifymycoursesrootnodefilterhint   | 1     | local_boostnavigation |
    And the following "custom field categories" exist:
      | name          | component   | area   | itemid |
      | Course fields | core_course | course | 0      |
    And the following "custom fields" exist:
      | name         | category      | type   | shortname   | configdata                       |
      | Select field | Course fields | select | selectfield | {"options":"Option 1\nOption 2"} |
    And the following "courses" exist:
      | fullname | shortname | category | customfield_selectfield |
      | Course 4 | C4        | 0        | 1                       |
      | Course 5 | C5        | 0        | 2                       |
    And the following "course enrolments" exist:
      | user      | course | role    |
      | student1  | C4     | student |
      | student1  | C5     | student |
    And the following config values are set as admin:
      | displaygroupingcustomfield | 1           | block_myoverview |
      | customfiltergrouping       | selectfield | block_myoverview |
    When I log in as "student1"
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: All (except removed from view)" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    And I click on "Option 1" "link" in the "Course overview" "block"
    And I reload the page
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: Option 1" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "Option 1" "button" in the "Course overview" "block"
    And I click on "Option 2" "link" in the "Course overview" "block"
    And I reload the page
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: Option 2" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "Option 2" "button" in the "Course overview" "block"
    And I click on "No Select field" "link" in the "Course overview" "block"
    And I reload the page
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: No Select field" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"

  Scenario: Add course filter hint node (when modifymycoursesrootnodeshowfiltered is disabled)
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 0     | local_boostnavigation |
      | modifymycoursesrootnodefilterhint   | 1     | local_boostnavigation |
    When I log in as "student1"
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Course list filtered by: In progress" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "All (except removed from view)" "button" in the "Course overview" "block"
    And I click on "In progress" "link" in the "Course overview" "block"
    And I reload the page
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Course list filtered by: In progress" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "In progress" "button" in the "Course overview" "block"
    And I click on "Past" "link" in the "Course overview" "block"
    And I reload the page
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Course list filtered by: In progress" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"

  Scenario: Add course filter link node
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
      | modifymycoursesrootnodefilterlink   | 1     | local_boostnavigation |
    When I log in as "student1"
    And I am on "C1 - Past" course homepage
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Change filter" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "Change filter" "link" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    Then I should see "Course overview" in the "Course overview" "block"
    And "[data-key='localboostnavigationactivefiltershint']" "css_element" should not exist

  Scenario: Add combined course filter hint and course filter link node
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
      | modifymycoursesrootnodefilterhint   | 1     | local_boostnavigation |
      | modifymycoursesrootnodefilterlink   | 1     | local_boostnavigation |
    When I log in as "student1"
    And I am on "C1 - Past" course homepage
    Then "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: All (except removed from view)" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I should see "Change filter" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I click on "Change filter" "link" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    Then I should see "Course overview" in the "Course overview" "block"
    And "[data-key='localboostnavigationactivefiltershint']" "css_element" should exist
    And I should see "Current course filter: All (except removed from view)" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And I should not see "Change filter" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"

  Scenario: Collapse filter hint node together with root node "My courses"
    Given the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsemycoursesnode               | 0     | local_boostnavigation |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
      | modifymycoursesrootnodefilterhint   | 1     | local_boostnavigation |
    And I log in as "student1"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And I should see "Current course filter" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                | value | plugin                |
      | collapsemycoursesnode | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And I should see "Current course filter" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "div[data-key='mycourses']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I should not see "Current course filter" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "div[data-key='mycourses']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And I should see "Current course filter" in the "[data-key='localboostnavigationactivefiltershint']" "css_element"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "[data-key='localboostnavigationactivefiltershint']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Annul an existing navcourselimit setting when showing filtered courses
    Given the following "users" exist:
      | username |
      | student2 |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 4 | C4        | 0        |
      | Course 5 | C5        | 0        |
      | Course 6 | C6        | 0        |
    And the following "course enrolments" exist:
      | user      | course | role    |
      | student2  | C4     | student |
      | student2  | C5     | student |
      | student2  | C6     | student |
    Given the following config values are set as admin:
      | config                    | value     |
      | navshowmycoursecategories | 0         |
      | navcourselimit            | 2         |
      | navsortmycoursessort      | shortname |
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 0     | local_boostnavigation |
    When I log in as "student2"
    Then "All (except removed from view)" "button" should exist in the "Course overview" "block"
    And I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C4" in the "#nav-drawer" "css_element"
    And I should see "C5" in the "#nav-drawer" "css_element"
    And I should not see "C6" in the "#nav-drawer" "css_element"
    And I should see "More..." in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | modifymycoursesrootnodeshowfiltered | 1     | local_boostnavigation |
    And I reload the page
    Then "All (except removed from view)" "button" should exist in the "Course overview" "block"
    And I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C4" in the "#nav-drawer" "css_element"
    And I should see "C5" in the "#nav-drawer" "css_element"
    And I should see "C6" in the "#nav-drawer" "css_element"
    And I should not see "More..." in the "#nav-drawer" "css_element"
