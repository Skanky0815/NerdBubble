import { When, Then, Given, Before } from "@badeball/cypress-cucumber-preprocessor";

Before(() => {
    cy.intercept('/api/articles').as('getArticles');
});

Given("I visit {string} page", (route: string) => {
    cy.visit(route);
})

Then("I see the loading animation", () => {
    cy.get('[data-testid="loading"]').should('exist');
})

When("the articles are successful loaded", () => {
    cy.wait('@getArticles').its('response.statusCode').should('eq', 200);
})

Then("I will see all articles", () => {
    cy.get('article').should('exist');
})

When("I click the reload button", () => {
    cy.get('[data-testid="reload-button"]').click();
})

When("I click the first article",  () => {
    cy.get('article > a').first().invoke('attr', 'href').then(url => {
        cy.request(url).as('articlePageRequest')
    });
})

Then("the article page is loaded", () => {
    cy.get('@articlePageRequest').its('status').should('eq', 200);
})

When("I click on the mark button of the product {string}", (productTitle: string) => {
    cy.intercept('/api/products/*/mark').as('postMarkProduct');
    cy.contains(productTitle).parent().find('[data-testid="mark-button"]').click();
});

Then("the success message {string} is shown", (alertMessage: string) => {
    cy.wait('@postMarkProduct').its('response.statusCode').should('eq', 204);
    cy.get('[data-testid="alert"]').should('have.text', alertMessage);
});

Then("the product {string} is in the list", (productTitle: string) => {
    cy.get('[data-testid="product"]').should('have.text', productTitle);
});
