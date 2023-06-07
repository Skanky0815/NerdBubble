/// <reference types="cypress" />

declare namespace Cypress {
    interface Chainable<Subject> {
        getByTestId: typeof getByTestId
    }
}

function getByTestId(selector: string): Cypress.Chainable<JQuery> {
    return cy.get(`[data-testid="${selector}"]`);
}

Cypress.Commands.add('getByTestId', getByTestId)
