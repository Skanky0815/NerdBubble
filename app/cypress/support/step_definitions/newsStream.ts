import { When, Then, Given, Before } from "@badeball/cypress-cucumber-preprocessor";

Before(() => {
    cy.intercept('/api/articles').as('getArticles');
    cy.intercept('/api/marked-products').as('getMargetProducts');
});

Given("I visit {string} page", (route: string) => {
    cy.visit(route);
})

Then("I see the loading animation", () => {
    cy.getByTestId('loading').should('exist');
})

When("the articles are successful loaded", () => {
    cy.wait('@getArticles').its('response.statusCode').should('eq', 200);
})

Then("I will see all articles", () => {
    cy.get('article').should('exist');
})

When("I click the reload button", () => {
    cy.getByTestId('reload-button').click();
})

When("I click the {string} article",  (articleTitle: string) => {
    cy.getByTestId('article-external-link')
        .invoke('attr', 'href')
        .then(url => {
            cy.log(url + '');
            cy.request(url as string).as('articlePageRequest')
            cy.wait('@articlePageRequest').its('status').should('eq', 404);
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
    cy.getByTestId('alert').should('have.text', alertMessage);
});

Then("the product {string} is in the list", (productTitle: string) => {
    cy.getByTestId('product').should('contain.text', productTitle);
});

When("The marked products are successful loaded", () => {
    cy.wait('@getMargetProducts').its('response.statusCode').should('equal', 200);
});
