@local @local_boostnavigation @local_boostnavigation_collapsecustomnodes @javascript
Feature: The boost navigation fumbling allows admins to collapse custom nodes within the Boost nav drawer
  In order to configure the nav drawer to my needs
  As an admin
  I need to collapse custom nodes in the nav drawer

  Scenario: Collapse custom root nodes for all users
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                   | value | plugin                |
      | collapsecustomnodesusers | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                   | value | plugin                |
      | collapsecustomnodesusers | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in custom root nodes for all users
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php||||||fa-graduation-cap
    -Child node A|/admin/user.php||||||fa-star
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersicon    | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersicon    | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersicon    | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse custom root nodes for all users by default
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersdefault | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersdefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of custom root nodes for all users for current session only
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersdefault | 0     | local_boostnavigation |
      | collapsecustomnodesuserssession | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersdefault | 0     | local_boostnavigation |
      | collapsecustomnodesuserssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesusers        | 1     | local_boostnavigation |
      | collapsecustomnodesusersdefault | 1     | local_boostnavigation |
      | collapsecustomnodesuserssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom root nodes for all users as accordion
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    Parent node B|/admin/index.php
    -Child node B|/course/management.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                            | value | plugin                |
      | collapsecustomnodesusers          | 1     | local_boostnavigation |
      | collapsecustomnodesusersaccordion | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                            | value | plugin                |
      | collapsecustomnodesusers          | 1     | local_boostnavigation |
      | collapsecustomnodesusersaccordion | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom root nodes for admins
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                    | value | plugin                |
      | collapsecustomnodesadmins | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                    | value | plugin                |
      | collapsecustomnodesadmins | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in custom root nodes for admins
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php||||||fa-graduation-cap
    -Child node A|/admin/user.php||||||fa-star
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesadmins       | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesadmins       | 1     | local_boostnavigation |
      | collapsecustomnodesadminsicon   | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesadmins       | 1     | local_boostnavigation |
      | collapsecustomnodesadminsicon   | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomnodesadmins       | 1     | local_boostnavigation |
      | collapsecustomnodesadminsicon   | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomrootadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse custom root nodes for admins by default
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                           | value | plugin                |
      | collapsecustomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustomnodesadminsdefault | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                           | value | plugin                |
      | collapsecustomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustomnodesadminsdefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of custom root nodes for admins for current session only
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                           | value | plugin                |
      | collapsecustomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustomnodesadminsdefault | 0     | local_boostnavigation |
      | collapsecustomnodesadminssession | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                           | value | plugin                |
      | collapsecustomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustomnodesadminsdefault | 0     | local_boostnavigation |
      | collapsecustomnodesadminssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                           | value | plugin                |
      | collapsecustomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustomnodesadminsdefault | 1     | local_boostnavigation |
      | collapsecustomnodesadminssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom root nodes for admins as accordion
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom root nodes" in site administration
    And I set the field "Insert custom root nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    Parent node B|/admin/index.php
    -Child node B|/course/management.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustomnodesadmins          | 1     | local_boostnavigation |
      | collapsecustomnodesadminsaccordion | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustomnodesadmins          | 1     | local_boostnavigation |
      | collapsecustomnodesadminsaccordion | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom course nodes for all users
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | collapsecustomcoursenodesusers | 0     | local_boostnavigation |
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | collapsecustomcoursenodesusers | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in custom course nodes for all users
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php||||||fa-graduation-cap
    -Child node A|/admin/user.php||||||fa-star
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustomcoursenodesusers     | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustomcoursenodesusers     | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersicon | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustomcoursenodesusers     | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersicon | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustomcoursenodesusers     | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersicon | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse custom course nodes for all users by default
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustomcoursenodesusers        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersdefault | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustomcoursenodesusers        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersdefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of custom course nodes for all users for current session only
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustomcoursenodesusers        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersdefault | 0     | local_boostnavigation |
      | collapsecustomcoursenodesuserssession | 0     | local_boostnavigation |
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustomcoursenodesusers        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersdefault | 0     | local_boostnavigation |
      | collapsecustomcoursenodesuserssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustomcoursenodesusers        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersdefault | 1     | local_boostnavigation |
      | collapsecustomcoursenodesuserssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom course nodes for all users as accordion
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    Parent node B|/admin/index.php
    -Child node B|/course/management.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | collapsecustomcoursenodesusers          | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersaccordion | 0     | local_boostnavigation |
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | collapsecustomcoursenodesusers          | 1     | local_boostnavigation |
      | collapsecustomcoursenodesusersaccordion | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom course nodes for admins
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomcoursenodesadmins | 0     | local_boostnavigation |
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustomcoursenodesadmins | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in custom course nodes for admins
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php||||||fa-graduation-cap
    -Child node A|/admin/user.php||||||fa-star
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustomcoursenodesadmins     | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustomcoursenodesadmins     | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsicon | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustomcoursenodesadmins     | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsicon | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustomcoursenodesadmins     | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsicon | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustomcourseadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse custom course nodes for admins by default
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustomcoursenodesadmins        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsdefault | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustomcoursenodesadmins        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsdefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of custom course nodes for admins for current session only
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustomcoursenodesadmins        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsdefault | 0     | local_boostnavigation |
      | collapsecustomcoursenodesadminssession | 0     | local_boostnavigation |
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustomcoursenodesadmins        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsdefault | 0     | local_boostnavigation |
      | collapsecustomcoursenodesadminssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustomcoursenodesadmins        | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsdefault | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom course nodes for admins as accordion
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom course nodes" in site administration
    And I set the field "Insert custom course nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    Parent node B|/admin/index.php
    -Child node B|/course/management.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | collapsecustomcoursenodesadmins          | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsaccordion | 0     | local_boostnavigation |
    And I am on "Course 1" course homepage
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | collapsecustomcoursenodesadmins          | 1     | local_boostnavigation |
      | collapsecustomcoursenodesadminsaccordion | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom bottom nodes for all users
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | collapsecustombottomnodesusers | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                         | value | plugin                |
      | collapsecustombottomnodesusers | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in custom bottom nodes for all users
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php||||||fa-graduation-cap
    -Child node A|/admin/user.php||||||fa-star
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustombottomnodesusers     | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustombottomnodesusers     | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersicon | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustombottomnodesusers     | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersicon | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                             | value | plugin                |
      | collapsecustombottomnodesusers     | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersicon | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomusers2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse custom bottom nodes for all users by default
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustombottomnodesusers        | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersdefault | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustombottomnodesusers        | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersdefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of custom bottom nodes for all users for current session only
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustombottomnodesusers        | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersdefault | 0     | local_boostnavigation |
      | collapsecustombottomnodesuserssession | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustombottomnodesusers        | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersdefault | 0     | local_boostnavigation |
      | collapsecustombottomnodesuserssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                | value | plugin                |
      | collapsecustombottomnodesusers        | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersdefault | 1     | local_boostnavigation |
      | collapsecustombottomnodesuserssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom bottom nodes for all users as accordion
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for all users" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    Parent node B|/admin/index.php
    -Child node B|/course/management.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | collapsecustombottomnodesusers          | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersaccordion | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                  | value | plugin                |
      | collapsecustombottomnodesusers          | 1     | local_boostnavigation |
      | collapsecustombottomnodesusersaccordion | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom bottom nodes for admins
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustombottomnodesadmins | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the following config values are set as admin:
      | config                          | value | plugin                |
      | collapsecustombottomnodesadmins | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should contain "localboostnavigationcollapsedchild"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsedchild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsedparent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should contain "localboostnavigationcollapsiblechild"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsedchild"

  Scenario: Display parent node icons in custom bottom nodes for admins
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php||||||fa-graduation-cap
    -Child node A|/admin/user.php||||||fa-star
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustombottomnodesadmins     | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustombottomnodesadmins     | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsicon | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustombottomnodesadmins     | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsicon | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should not contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the following config values are set as admin:
      | config                              | value | plugin                |
      | collapsecustombottomnodesadmins     | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsicon | 2     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should contain "fa-graduation-cap"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2'] i.icon" "css_element" should contain "fa-star"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2'] i.icon" "css_element" should contain "fa-fw"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins1']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"
    And the "class" attribute of "a[data-key='localboostnavigationcustombottomadmins2']" "css_element" should not contain "localboostnavigationcollapsibleparentforcenoindent"

  Scenario: Collapse custom bottom nodes for admins by default
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustombottomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsdefault | 0     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustombottomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsdefault | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Remember collapse status of custom bottom nodes for admins for current session only
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustombottomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsdefault | 0     | local_boostnavigation |
      | collapsecustombottomnodesadminssession | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustombottomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsdefault | 0     | local_boostnavigation |
      | collapsecustombottomnodesadminssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                 | value | plugin                |
      | collapsecustombottomnodesadmins        | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsdefault | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminssession | 1     | local_boostnavigation |
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    And I log out
    And I log in as "admin"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"

  Scenario: Collapse custom bottom nodes for admins as accordion
    Given I log in as "admin"
    And I navigate to "Appearance > Boost navigation fumbling > Custom bottom nodes" in site administration
    And I set the field "Insert custom bottom nodes for admins" to multiline:
    """
    Parent node A|/admin/index.php
    -Child node A|/admin/user.php
    Parent node B|/admin/index.php
    -Child node B|/course/management.php
    """
    And I press "Save changes"
    And the following config values are set as admin:
      | config                                   | value | plugin                |
      | collapsecustombottomnodesadmins          | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsaccordion | 0     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And the following config values are set as admin:
      | config                                   | value | plugin                |
      | collapsecustombottomnodesadmins          | 1     | local_boostnavigation |
      | collapsecustombottomnodesadminsaccordion | 1     | local_boostnavigation |
    And I reload the page
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node B" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
    And I click on "Parent node A" "link" in the "#nav-drawer" "css_element"
    Then I should see "Parent node A" in the "#nav-drawer" "css_element"
    And I should not see "Child node A" in the "#nav-drawer" "css_element"
    And I should see "Parent node B" in the "#nav-drawer" "css_element"
    And I should not see "Child node B" in the "#nav-drawer" "css_element"
