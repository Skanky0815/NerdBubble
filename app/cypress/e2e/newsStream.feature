Feature: News Stream Page

  The News Stream shows all new Articles

  Scenario: Load all articles after enter the page
    Given I visit "/" page
    Then I see the loading animation
    When the articles are successful loaded
    Then I will see all articles

  Scenario: Reload all articles by pressing the reload button
    Given I visit "/" page
    When I click the reload button
    Then I see the loading animation
    When the articles are successful loaded
    Then I will see all articles

  Scenario: Click a article will open the article page
    Given I visit "/" page
    And the articles are successful loaded
    When I click the first article
    Then the article page is loaded