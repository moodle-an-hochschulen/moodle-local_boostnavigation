@local @local_boostnavigation @local_boostnavigation_collapsecoursenodes @javascript
Feature: The boost navigation fumbling allows admins to collapse course nodes within the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to collapse course nodes in the nav drawer

  Scenario: Collapse root node "Sections"
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user  | course | role    |
      | admin | C1     | student |
    And the following config values are set as admin:
      | config                           | value | plugin                |
      | insertcoursesectionscoursenode   | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                           | value | plugin                |
      | insertcoursesectionscoursenode   | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "a[data-key='localboostnavigationcoursesections']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should not see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "a[data-key='localboostnavigationcoursesections']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "#nav-drawer a[href$='section-1']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in course node "Sections"
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
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-folder"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-folder-o"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodeicon    | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should not contain "fa-folder"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-folder-o"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodeicon    | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should not contain "fa-folder"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-folder-o"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodeicon    | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-folder"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-folder-o"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-parent-key='localboostnavigationcoursesections']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse course node "Sections" by default
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
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodedefault | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodedefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "student2"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should not see "Topic 1" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of course node "Sections" for current session only
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user  | course | role    |
      | admin | C1     | student |
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodedefault | 0     | local_boostnavigation |
      | collapsecoursesectionscoursenodesession | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Page" to section "1" and I fill the form with:
      | Name         | Page 1 |
      | Description  | Test   |
      | Page content | Test   |
    And I turn editing mode off
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And I click on "a[data-key='localboostnavigationcoursesections']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should not see "Topic 1" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodedefault | 0     | local_boostnavigation |
      | collapsecoursesectionscoursenodesession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And I click on "a[data-key='localboostnavigationcoursesections']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should see "Topic 1" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | insertcoursesectionscoursenode          | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenode        | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodedefault | 1     | local_boostnavigation |
      | collapsecoursesectionscoursenodesession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should not see "Topic 1" in the "#nav-drawer" "css_element"
    And I click on "a[data-key='localboostnavigationcoursesections']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Sections" in the "#nav-drawer" "css_element"
    And I should not see "Topic 1" in the "#nav-drawer" "css_element"

  Scenario: Collapse root node "Activities"
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user  | course | role    |
      | admin | C1     | student |
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 0     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I turn editing mode off
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                       | value | plugin                |
      | insertactivitiescoursenode   | 1     | local_boostnavigation |
      | collapseactivitiescoursenode | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "a[data-key='localboostnavigationactivities']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "a[data-key='localboostnavigationactivities']" "css_element" in the "#nav-drawer" "css_element"
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in course node "Activities"
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
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I turn editing mode off
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 0     | local_boostnavigation |
      | collapseactivitiescoursenodeicon    | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should not contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 0     | local_boostnavigation |
      | collapseactivitiescoursenodeicon    | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should not contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 0     | local_boostnavigation |
      | collapseactivitiescoursenodeicon    | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivities'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-share-alt"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationactivities']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationactivityassign']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse course node "Activities" by default
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
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I turn editing mode off
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "student2"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Assignments" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of course node "Activities" for current session only
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user  | course | role    |
      | admin | C1     | student |
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 0     | local_boostnavigation |
      | collapseactivitiescoursenodesession | 0     | local_boostnavigation |
    And I log in as "admin"
    And I am on "Course 1" course homepage
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name                     | Test assignment name    |
      | Description                         | Submit your online text |
      | assignsubmission_onlinetext_enabled | 1                       |
      | assignsubmission_file_enabled       | 0                       |
    And I turn editing mode off
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I click on "a[data-key='localboostnavigationactivities']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Assignments" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 0     | local_boostnavigation |
      | collapseactivitiescoursenodesession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And I click on "a[data-key='localboostnavigationactivities']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should see "Assignments" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | insertactivitiescoursenode          | 1     | local_boostnavigation |
      | collapseactivitiescoursenode        | 1     | local_boostnavigation |
      | collapseactivitiescoursenodedefault | 1     | local_boostnavigation |
      | collapseactivitiescoursenodesession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Assignments" in the "#nav-drawer" "css_element"
    And I click on "a[data-key='localboostnavigationactivities']" "css_element" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Activities" in the "#nav-drawer" "css_element"
    And I should not see "Assignments" in the "#nav-drawer" "css_element"
