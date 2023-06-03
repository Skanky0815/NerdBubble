import { When, Then, Given } from "@badeball/cypress-cucumber-preprocessor";

Given("I am logged in as {string} and password {string}", (email: string, password: string)  => {
    cy.request('http://localhost/sanctum/csrf-cookie')
        .then((response) => {
            expect(response.status).to.eq(204);
        });

    cy.getCookie('XSRF-TOKEN').then((token) => {
        cy.request({
            method: 'POST',
            url: 'http://localhost/login',
            body: {
                email:email,
                password: password,
            },
            headers: {
                'X-XSRF-TOKEN': token.value,
            }
        }).then((res) => {
            if (res.status === 200) {
                window.sessionStorage.setItem('loggedIn', 'true');
                cy.log('loggedin');
            }
        });
    });
});
