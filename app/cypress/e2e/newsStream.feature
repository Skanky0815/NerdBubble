Feature: News Stream Page

  The News Stream shows all new Articles

  Background:
    Given I am logged in as "rico-schulz@web.de" and password "password"

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

 Scenario: Add a product to the wishlist
   Given I visit "/" page
    And the article page is loaded
    When I click on the mark button of the product "X-Wing"
    Then the success message "Produkt gemerkt" is shown
    When I click the "Merkliste" in the navigation
    Then the product "X-Wing" is in the list
