Feature: I can login with my mail and password into the app

  Scenario: I login in with my data
    Given I use my "iphone-x"
    And I visit "/" page
    When I type "john.doe@nerdbubble.org" in to the mail field
    And I type "password" in to the password field
    And I click the "Anmelden" button
    When the articles are successful loaded
    Then I will see all articles
    And I am logged in
