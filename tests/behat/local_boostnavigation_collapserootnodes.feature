@local @local_boostnavigation @local_boostnavigation_collapserootnodes @javascript
Feature: The boost navigation fumbling allows admins to collapse root nodes within the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to collapse root nodes in the nav drawer

  Scenario: Collapse root node "My courses"
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user  | course | role    |
      | admin | C1     | student |
    And the following config values are set as admin:
      | config                | value | plugin                |
      | collapsemycoursesnode | 0     | local_boostnavigation |
    And I log in as "admin"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                | value | plugin                |
      | collapsemycoursesnode | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "div[data-key='mycourses']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "div[data-key='mycourses']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in root node "My courses"
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | student1 | C1     | student |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 0     | local_boostnavigation |
    And I log in as "student1"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodeicon    | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodeicon    | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodeicon    | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "div[data-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-parent-key='mycourses'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "div[data-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='mycourses']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse root node "My courses" by default
    Given the following "users" exist:
      | username |
      | student1 |
      | student2 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | student1 | C1     | student |
      | student2 | C1     | student |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodedefault | 0     | local_boostnavigation |
    And I log in as "student1"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodedefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "student2"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of root node "My courses" for current session only
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user  | course | role    |
      | admin | C1     | student |
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodedefault | 0     | local_boostnavigation |
      | collapsemycoursesnodesession | 0     | local_boostnavigation |
    And I log in as "admin"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And I click on "div[data-key='mycourses']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodedefault | 0     | local_boostnavigation |
      | collapsemycoursesnodesession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And I click on "div[data-key='mycourses']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should see "C1" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | collapsemycoursesnode        | 1     | local_boostnavigation |
      | collapsemycoursesnodedefault | 1     | local_boostnavigation |
      | collapsemycoursesnodesession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
    And I click on "div[data-key='mycourses']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "My courses" in the "#nav-drawer" "css_element"
    And I should not see "C1" in the "#nav-drawer" "css_element"
