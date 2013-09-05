Feature: Does the navigation and routing of the blog function properly?

  Scenario: View the index page
    Given I am on "/blog/"
    Then I should see "Hello world!"