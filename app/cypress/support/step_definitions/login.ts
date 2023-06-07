import { When, Then } from "@badeball/cypress-cucumber-preprocessor";

beforeEach(() => {
    cy.intercept('/login').as('login');
    cy.intercept('/sanctum/csrf-cookie').as('csrfCookie');
});

When("I type {string} in to the mail field", (emailAddress: string) => {
    cy.getByTestId('email').type(emailAddress);
});

When("I type {string} in to the password field", (password: string) =>  {
    cy.getByTestId('password').type(password);
});

When("I click the {string} button", (buttonLabel: string) => {
    cy.get('button').contains(buttonLabel).click();
    cy.wait(['@csrfCookie', '@login'])
});

Then("I am logged in",  () => {
    cy.window().then((window) => {
        const sessionStorage = window.sessionStorage;

        cy.wrap(sessionStorage.getItem('loggedIn')).should('eq', 'true');
    });
});
