import { When, Then, Given } from "@badeball/cypress-cucumber-preprocessor";

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
                'X-XSRF-TOKEN': decodeURIComponent(token.value),
            }
        }).then((response) => {
            if (200 === response.status) {
                window.sessionStorage.setItem('loggedIn', 'true');
            }
        });
    });
});
