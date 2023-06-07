import { When, Given } from "@badeball/cypress-cucumber-preprocessor";
import ViewportPreset = Cypress.ViewportPreset;

Given("I use my {string}", (device: ViewportPreset) => {
    cy.viewport(device);
});

Given("I am logged in as {string} and password {string}", (email: string, password: string)  => {
    cy.request('http://localhost/sanctum/csrf-cookie').then((response) => {
        expect(response.status).to.eq(204);
    });

    cy.getCookie('XSRF-TOKEN').then((token) => {
        cy.request({
            method: 'POST',
            url: 'http://localhost/login',
            body: {
                email: email,
                password: password,
            },
            headers: {
                'Accept': 'application/json',
                'X-XSRF-TOKEN': decodeURIComponent(token!.value),
            }
        }).then((response) => {
            if (200 === response.status) {
                window.sessionStorage.setItem('loggedIn', 'true');
            }
        });
    });
});

When("I click the {string} in the navigation", (navigationItem: string) => {
    cy.getByTestId('bottom-navigation').contains(navigationItem).click();
});
