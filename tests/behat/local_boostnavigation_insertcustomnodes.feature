@local @local_boostnavigation @local_boostnavigation_insertcustomnodes
Feature: The boost navigation fumbling allows admins to insert custom nodes to the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to insert custom nodes to the nav drawer

  Scenario: Insert custom root nodes for all users
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | admin    | C1     | student |
      | student1 | C1     | student |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.org website|http://www.moodle.org
    Our university|http://www.our-university.edu
    """
    And I press "Save changes"
    And I follow "Dashboard" in the user menu
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustomrootusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustomrootusers1']" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustomrootusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustomrootusers1']" "css_element"
    And I log out
    And I log in as "student1"
    And I follow "Dashboard" in the user menu
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustomrootusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustomrootusers1']" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustomrootusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustomrootusers1']" "css_element"

  Scenario: Insert custom root nodes for admins
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | admin    | C1     | student |
      | student1 | C1     | student |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for admins" to multiline:
    """
    Moodle.org website|http://www.moodle.org
    Our university|http://www.our-university.edu
    """
    And I press "Save changes"
    And I follow "Dashboard" in the user menu
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should appear before "a[data-key='localboostnavigationcustomrootadmins2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should appear after "a[data-key='localboostnavigationcustomrootadmins1']" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should appear before "a[data-key='localboostnavigationcustomrootadmins2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should appear after "a[data-key='localboostnavigationcustomrootadmins1']" "css_element"
    And I log out
    And I log in as "student1"
    And I follow "Dashboard" in the user menu
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"
    And I am on "Course 1" course homepage
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"

  Scenario: Insert custom course nodes for all users
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | admin    | C1     | student |
      | student1 | C1     | student |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for all users" to multiline:
    """
    Moodle.org website|http://www.moodle.org
    Our university|http://www.our-university.edu
    """
    And I press "Save changes"
    And I follow "Dashboard" in the user menu
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear before "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustomcourseusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear before "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustomcourseusers1']" "css_element"
    And I log out
    And I log in as "student1"
    And I follow "Dashboard" in the user menu
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear before "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustomcourseusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear before "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustomcourseusers1']" "css_element"

  Scenario: Insert custom course nodes for admins
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | admin    | C1     | student |
      | student1 | C1     | student |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for admins" to multiline:
    """
    Moodle.org website|http://www.moodle.org
    Our university|http://www.our-university.edu
    """
    And I press "Save changes"
    And I follow "Dashboard" in the user menu
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should appear before "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should appear before "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should appear after "a[data-key='grades']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should appear before "a[data-key='myhome']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should appear before "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should appear after "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element"
    And I log out
    And I log in as "student1"
    And I follow "Dashboard" in the user menu
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"
    And I am on "Course 1" course homepage
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"

  Scenario: Insert custom bottom nodes for all users
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | admin    | C1     | student |
      | student1 | C1     | student |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for all users" to multiline:
    """
    Moodle.org website|http://www.moodle.org
    Our university|http://www.our-university.edu
    """
    And I press "Save changes"
    And I follow "Dashboard" in the user menu
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustombottomusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustombottomusers1']" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustombottomusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustombottomusers1']" "css_element"
    And I log out
    And I log in as "student1"
    And I follow "Dashboard" in the user menu
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustombottomusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustombottomusers1']" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should appear before "a[data-key='localboostnavigationcustombottomusers2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should appear after "a[data-key='localboostnavigationcustombottomusers1']" "css_element"

  Scenario: Insert custom bottom nodes for admins
    Given the following "users" exist:
      | username |
      | student1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | admin    | C1     | student |
      | student1 | C1     | student |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for admins" to multiline:
    """
    Moodle.org website|http://www.moodle.org
    Our university|http://www.our-university.edu
    """
    And I press "Save changes"
    And I follow "Dashboard" in the user menu
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should appear before "a[data-key='localboostnavigationcustombottomadmins2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should appear after "a[data-key='localboostnavigationcustombottomadmins1']" "css_element"
    And I am on "Course 1" course homepage
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should appear before "a[data-key='localboostnavigationcustombottomadmins2']" "css_element"
    And I should see "Our university" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should appear after "div[data-key='mycourses']" "css_element"
    And "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should appear before "Site administration" "link"
    And "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should appear after "a[data-key='localboostnavigationcustombottomadmins1']" "css_element"
    And I log out
    And I log in as "student1"
    And I follow "Dashboard" in the user menu
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"
    And I am on "Course 1" course homepage
    And I should not see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I should not see "Our university" in the "#nav-drawer" "css_element"

  Scenario: Custom node link
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.org website|http://www.moodle.org
    """
    And I press "Save changes"
    Then I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "http://www.moodle.org"

  Scenario: Custom node language restriction
    # Please note:
    # The short notation for the settings like
    #     Given the following "users" exist:
    #      | username | lang |
    #      | student1 | de   |
    # does not work since Moodle 3.9 anymore for a currently unknown reason,
    # so the language is set manually after the studen has logged in.
    Given the following "users" exist:
      | username |
      | student1 |
      | student2 |
    When I log in as "admin"
    And I navigate to "Language > Language packs" in site administration
    When I set the field "Available language packs" to "de"
    And I press "Install selected language pack(s)"
    Then I should see "Language pack 'de' was successfully installed"
    And the "Installed language packs" select box should contain "de"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.all website|http://www.moodle.all
    Moodle.de website|http://www.moodle.de|de
    Moodle.com website|http://www.moodle.com|en
    Moodle.org website|http://www.moodle.org|de,en
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I follow "Preferences" in the user menu
    And I click on "Preferred language" "link"
    And I set the field "Preferred language" to "English ‎(en)‎"
    And I press "Save changes"
    Then I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.de website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.com website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "student2"
    And I follow "Preferences" in the user menu
    And I click on "Preferred language" "link"
    And I set the field "Preferred language" to "Deutsch ‎(de)‎"
    And I press "Save changes"
    And I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.de website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.com website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.org website" in the "#nav-drawer" "css_element"

  Scenario: Custom node cohort restriction
    Given the following "users" exist:
      | username |
      | student1 |
      | student2 |
    And the following "cohorts" exist:
      | name     | idnumber |
      | Cohort A | cohortA  |
      | Cohort B | cohortB  |
    And the following "cohort members" exist:
      | user     | cohort  |
      | student1 | cohortA |
      | student2 | cohortB |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.all website|http://www.moodle.all
    Moodle.a website|http://www.moodle.a||cohortA
    Moodle.b website|http://www.moodle.b||cohortB
    Moodle.ab website|http://www.moodle.ab||cohortA,cohortB
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    Then I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.a website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.b website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.ab website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "student2"
    And I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.a website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.b website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.ab website" in the "#nav-drawer" "css_element"

  Scenario: Custom node role restriction
    Given the following "users" exist:
      | username |
      | student1 |
      | teacher1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | student1 | C1     | student        |
      | teacher1 | C1     | editingteacher |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.all website|http://www.moodle.all
    Moodle.student website|http://www.moodle.student|||student
    Moodle.teacher website|http://www.moodle.teacher|||editingteacher
    Moodle.studentteacher website|http://www.moodle.studentteacher|||student,editingteacher
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    Then I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.student website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teacher website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studentteacher website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.student website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teacher website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studentteacher website" in the "#nav-drawer" "css_element"

  Scenario: Custom node system role restriction
    Given the following "users" exist:
      | username |
      | manager1  |
    And the following "system role assigns" exist:
      | user     | role    | contextlevel | reference |
      | manager1 | manager | System       |           |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.all website|http://www.moodle.all
    Moodle.manager website|http://www.moodle.manager||||manager
    Moodle.admin website|http://www.moodle.admin||||admin
    Moodle.manageradmin website|http://www.moodle.manageradmin||||manager,admin
    """
    And I press "Save changes"
    And I log out
    And I log in as "manager1"
    Then I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.manager website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.admin website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.manageradmin website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.manager website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.admin website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.manageradmin website" in the "#nav-drawer" "css_element"

  Scenario: Custom node logical combination operator ALL
    Given the following "users" exist:
      | username |
      | student1 |
      | student2 |
      | teacher1 |
      | teacher2 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | student1 | C1     | student        |
      | student2 | C1     | student        |
      | teacher1 | C1     | editingteacher |
      | teacher2 | C1     | editingteacher |
    And the following "cohorts" exist:
      | name     | idnumber |
      | Cohort A | cohortA  |
      | Cohort B | cohortB  |
    And the following "cohort members" exist:
      | user     | cohort  |
      | student1 | cohortA |
      | student2 | cohortB |
      | teacher1 | cohortB |
      | teacher2 | cohortA |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.all website|http://www.moodle.all
    Moodle.studenta website|http://www.moodle.dea||cohortA|student||ALL
    Moodle.studentb website|http://www.moodle.deb||cohortB|student||ALL
    Moodle.teachera website|http://www.moodle.ena||cohortA|editingteacher||ALL
    Moodle.teacherb website|http://www.moodle.enb||cohortB|editingteacher||ALL
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    And I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teacherb website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "student2"
    And I am on "Course 1" course homepage
    And I should not see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teacherb website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I should not see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teacherb website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "teacher2"
    And I am on "Course 1" course homepage
    And I should not see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teacherb website" in the "#nav-drawer" "css_element"

  Scenario: Custom node logical combination operator OR
    Given the following "users" exist:
      | username |
      | student1 |
      | student2 |
      | teacher1 |
      | teacher2 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | student1 | C1     | student        |
      | student2 | C1     | student        |
      | teacher1 | C1     | editingteacher |
      | teacher2 | C1     | editingteacher |
    And the following "cohorts" exist:
      | name     | idnumber |
      | Cohort A | cohortA  |
      | Cohort B | cohortB  |
    And the following "cohort members" exist:
      | user     | cohort  |
      | student1 | cohortA |
      | student2 | cohortB |
      | teacher1 | cohortB |
      | teacher2 | cohortA |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.all website|http://www.moodle.all
    Moodle.studenta website|http://www.moodle.dea||cohortA|student||OR
    Moodle.studentb website|http://www.moodle.deb||cohortB|student||OR
    Moodle.teachera website|http://www.moodle.ena||cohortA|editingteacher||OR
    Moodle.teacherb website|http://www.moodle.enb||cohortB|editingteacher||OR
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I am on "Course 1" course homepage
    And I should see "Moodle.all website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teacherb website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "student2"
    And I am on "Course 1" course homepage
    And I should see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teacherb website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "teacher1"
    And I am on "Course 1" course homepage
    And I should not see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teacherb website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "teacher2"
    And I am on "Course 1" course homepage
    And I should see "Moodle.studenta website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.studentb website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teachera website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.teacherb website" in the "#nav-drawer" "css_element"

  Scenario: Custom node icon
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.org website|http://www.moodle.org||||||fa-graduation-cap
    """
    And I press "Save changes"
    Then I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-graduation-cap"

  Scenario: Custom node key
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.org website|http://www.moodle.org|||||||my_node
    """
    And I press "Save changes"
    Then I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomrootusersmynode']" "css_element" should exist

  Scenario: Custom node classes
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Moodle.org website|http://www.moodle.org|||||||my_node||text-danger text-right
    """
    And I press "Save changes"
    Then I should see "Moodle.org website" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusersmynode']" "css_element" should contain "text-danger"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusersmynode']" "css_element" should contain "text-right"

  Scenario: Custom node before node key
    Given the following "users" exist:
      | username |
      | teacher1 |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for all users" to multiline:
    """
    {editingtoggle}|/course/view.php?id={courseid}&sesskey={sesskey}&edit={editingtoggle}|||editingteacher|admin,manager|OR|fa-pencil|editing|participants
    """
    And I press "Save changes"
    And I log out
    And I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then I should see "Turn editing on" in the "#nav-drawer" "css_element"
    And "a[data-key='localboostnavigationcustomcourseusersediting']" "css_element" should appear before "a[data-key='participants']" "css_element"

  Scenario: Custom node multilang title
    # Please note:
    # The short notation for the settings like
    #     Given the following "users" exist:
    #      | username | lang |
    #      | student1 | de   |
    # does not work since Moodle 3.9 anymore for a currently unknown reason,
    # so the language is set manually after the studen has logged in.
    Given the following "users" exist:
      | username |
      | student1 |
      | student2 |
    And the "multilang" filter is "on"
    And the "multilang" filter applies to "content and headings"
    When I log in as "admin"
    And I navigate to "Language > Language packs" in site administration
    When I set the field "Available language packs" to "de"
    And I press "Install selected language pack(s)"
    Then I should see "Language pack 'de' was successfully installed"
    And the "Installed language packs" select box should contain "de"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    <span lang="en" class="multilang">Moodle.en website</span><span lang="de" class="multilang">Moodle.de website</span>|http://www.moodle.org
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I follow "Preferences" in the user menu
    And I click on "Preferred language" "link"
    And I set the field "Preferred language" to "English ‎(en)‎"
    And I press "Save changes"
    And I should not see "Moodle.de website" in the "#nav-drawer" "css_element"
    And I should see "Moodle.en website" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "student2"
    And I follow "Preferences" in the user menu
    And I click on "Preferred language" "link"
    And I set the field "Preferred language" to "Deutsch ‎(de)‎"
    And I press "Save changes"
    And I should see "Moodle.de website" in the "#nav-drawer" "css_element"
    And I should not see "Moodle.en website" in the "#nav-drawer" "css_element"

  Scenario: Custom node title placeholder coursefullname
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    {coursefullname}|http://www.moodle.org
    """
    And I press "Save changes"
    And I am on "Course 1" course homepage
    Then I should see "Course 1" in the "a[data-key='localboostnavigationcustomrootusers1']" "css_element"

  Scenario: Custom node title placeholder courseshortname
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    {courseshortname}|http://www.moodle.org
    """
    And I press "Save changes"
    And I am on "Course 1" course homepage
    Then I should see "C1" in the "a[data-key='localboostnavigationcustomrootusers1']" "css_element"

  Scenario: Custom node title and link placeholders editingtoggle, courseid, sesskey
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    {editingtoggle}|/course/view.php?id={courseid}&sesskey={sesskey}&edit={editingtoggle}
    """
    And I press "Save changes"
    And I am on "Course 1" course homepage
    Then I should see "Turn editing on" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "edit=on"
    # Unfortunately, we can't check for the real course id as this is not deterministic across Behat runs
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "id="
    # Unfortunately, we can't check for the real sesskey as this is not available to Behat
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "sesskey="
    And I click on "Turn editing on" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"
    And I should see "Turn editing off" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "edit=off"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "id="
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "sesskey="
    And I click on "Turn editing off" "link" in the "#nav-drawer" "css_element"
    And I should see "Course 1" in the "#page-header" "css_element"
    And I should see "Turn editing on" in the "#nav-drawer" "css_element"

  Scenario: Custom node title placeholder userfullname
    Given the following "users" exist:
      | username | firstname | lastname |
      | student1 | Student   | One      |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    {userfullname}|http://www.moodle.org
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    Then I should see "Student One" in the "#nav-drawer" "css_element"

  Scenario: Custom node title placeholder userusername
    Given the following "users" exist:
      | username |
      | student1 |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    {userusername}|http://www.moodle.org
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    Then I should see "student1" in the "#nav-drawer" "css_element"

  Scenario: Custom node link placeholder courseshortname
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Course frontpage|/course/view.php?name={courseshortname}
    """
    And I press "Save changes"
    And I am on "Course 1" course homepage
    Then I should see "Course frontpage" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "name=C1"

  Scenario: Custom node link placeholder userid
    Given the following "users" exist:
      | username | firstname | lastname |
      | student1 | Student   | One      |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    User profile|/user/profile.php?id={userid}
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    Then I should see "User profile" in the "#nav-drawer" "css_element"
    # Unfortunately, we can't check for the real course id as this is not deterministic across Behat runs
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "/user/profile.php?id="
    # Instead we check what happens when I click the link
    And I click on "User profile" "link" in the "#nav-drawer" "css_element"
    And I should see "Student One" in the "#page-header" "css_element"

  Scenario: Custom node link placeholder userusername
    Given the following "users" exist:
      | username |
      | student1 |
    When I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    User profile|/user/profile.php?name={userusername}
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    Then I should see "User profile" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "name=student1"

  Scenario: Custom node link placeholder pagecontextid
    # This placeholder can't be tested with Behat unfortunately

  Scenario: Custom node link placeholder pagepath
    Given the following "users" exist:
      | username |
      | student1 |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Current page|{pagepath}
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I click on "Calendar" "link" in the "#nav-drawer" "css_element"
    Then I should see "Calendar" in the "#page-header" "css_element"
    And I should see "Current page" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "/calendar/view.php?view=month"
    And I click on "Current page" "link" in the "#nav-drawer" "css_element"
    And I should see "Calendar" in the "#page-header" "css_element"

  Scenario: Custom node hierarchy
    Given the following "users" exist:
      | username |
      | student1 |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Parent node|/admin/index.php
    -Child node A|/admin/user.php
    -Child node B|/course/management.php
    """
    And I press "Save changes"
    Then I should see "Parent node" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "/admin/index.php"
    And the "data-parent-key" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "myhome"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should contain "/admin/user.php"
    And the "data-parent-key" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should contain "localboostnavigationcustomrootusers1"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And the "href" attribute of "a[data-key='localboostnavigationcustomrootusers3']" "css_element" should contain "/course/management.php"
    And the "data-parent-key" attribute of "a[data-key='localboostnavigationcustomrootusers3']" "css_element" should contain "localboostnavigationcustomrootusers1"

  Scenario: Custom node hierarchy inheritance
    # Please note:
    # The short notation for the settings like
    #     Given the following "users" exist:
    #      | username | lang |
    #      | student1 | de   |
    # does not work since Moodle 3.9 anymore for a currently unknown reason,
    # so the language is set manually after the studen has logged in.
    Given the following "users" exist:
      | username |
      | student1 |
      | student2 |
    When I log in as "admin"
    And I navigate to "Language > Language packs" in site administration
    When I set the field "Available language packs" to "de"
    And I press "Install selected language pack(s)"
    Then I should see "Language pack 'de' was successfully installed"
    And the "Installed language packs" select box should contain "de"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Parent node|/admin/index.php|en
    -Child node A|/admin/user.php
    -Child node B|/course/management.php
    Elternknoten|/admin/index.php|de
    -Kindknoten A|/admin/user.php
    -Kindknoten B|/course/management.php
    """
    And I press "Save changes"
    And I log out
    And I log in as "student1"
    And I follow "Preferences" in the user menu
    And I click on "Preferred language" "link"
    And I set the field "Preferred language" to "English ‎(en)‎"
    And I press "Save changes"
    Then I should see "Parent node" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I should not see "Elternknoten" in the "#nav-drawer" "css_element"
    And I should not see "Kindknoten A" in the "#nav-drawer" "css_element"
    And I should not see "Kindknoten B" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "student2"
    And I follow "Preferences" in the user menu
    And I click on "Preferred language" "link"
    And I set the field "Preferred language" to "Deutsch ‎(de)‎"
    And I press "Save changes"
    And I should not see "Parent node" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I should see "Elternknoten" in the "#nav-drawer" "css_element"
    And I should see "Kindknoten A" in the "#nav-drawer" "css_element"
    And I should see "Kindknoten B" in the "#nav-drawer" "css_element"

  Scenario: Custom node classes for first bottom nodes
    Given the following "users" exist:
      | username |
      | student1 |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for all users" to multiline:
    """
    Bottom node for all users 1 |/admin/index.php
    Bottom node for all users 2 |/admin/index.php
    """
    And I set the field "Insert custom bottom nodes for admins" to multiline:
    """
    Bottom node for admins 1 |/admin/index.php
    Bottom node for admins 2 |/admin/index.php
    """
    And I press "Save changes"
    Then I should see "Bottom node for all users 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should contain "localboostnavigationfirstcustombuttomusers"
    And I should see "Bottom node for all users 2" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationfirstcustombuttomusers"
    And I should see "Bottom node for admins 1" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should contain "localboostnavigationfirstcustombuttomadmins"
    And I should see "Bottom node for admins 2" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationfirstcustombuttomadmins"
